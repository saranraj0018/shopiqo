<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Customers log in via the "user" guard (see UserLoginController::userAuthenticate),
        // not the default "web" guard — must check the same guard login uses.
        if (!Auth::guard('user')->check()) {
    $this->data['cartItems'] = collect();
            $this->data['totals'] = $this->emptyTotals();
            $this->data['appliedCoupon'] = null;
            $this->data['coupons'] = $this->activeCoupons();
            $this->data['products'] = $this->suggestedProducts();
            return view('frontend.cart', $this->data);
        }

        $cartItems = Cart::with(['product.product_gallery_image', 'variant'])
            ->where('user_id', Auth::guard('user')->id())
            ->latest()
            ->get();

        $this->data['cartItems'] = $cartItems;
        $this->data['totals'] = $this->computeTotals($cartItems);
        $this->data['appliedCoupon'] = $this->sessionCoupon();
        $this->data['coupons'] = $this->activeCoupons();
        $this->data['products'] = $this->suggestedProducts($cartItems->pluck('product_id'));

        return view('frontend.cart', $this->data);
    }

    public function store(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'print_type'       => 'nullable|string|max:255',
            'logo_side'        => 'nullable|in:front,back,both',
            'logo_position_x'  => 'nullable|integer|min:0|max:100',
            'logo_position_y'  => 'nullable|integer|min:0|max:100',
            'design_logo'      => 'nullable|image|max:5120',
            'quantity'         => 'nullable|integer|min:1',
            'quantities'       => 'nullable|array',
            'quantities.*'     => 'nullable|integer|min:0',
            'bulk_quantities'  => 'nullable|array',
        ]);

        $product = Product::with(['product_variant', 'bulkProducts'])->findOrFail($request->product_id);

        $logoPath = null;
        if ($request->hasFile('design_logo')) {
            $imgName = time() . '_' . $request->file('design_logo')->getClientOriginalName();
            $request->file('design_logo')->storeAs('cart-logos', $imgName, 'public');
            $logoPath = 'cart-logos/' . $imgName;
        }

        $customization = [
            'print_type'      => $request->print_type,
            'logo_path'       => $logoPath,
            'logo_side'       => $request->logo_side,
            'logo_position_x' => $request->logo_position_x,
            'logo_position_y' => $request->logo_position_y,
        ];

        if ($request->filled('quantities')) {
            $added = $this->addVariantLines($guard->id(), $product, $request->quantities, $customization);
        } elseif ($request->filled('bulk_quantities')) {
            $added = $this->addBulkLines($guard->id(), $product, $request->bulk_quantities, $customization);
        } else {
            $qty = max((int) $request->quantity, 1);
            $this->addLine($guard->id(), array_merge($customization, [
                'product_id'          => $product->id,
                'product_variant_id'  => null,
                'quantity'            => $qty,
                'unit_price'          => $product->sale_price ?: $product->regular_price,
            ]));
            $added = 1;
        }

        if ($added === 0) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Please choose at least one quantity before adding to cart.',
            ], 422);
        }

        return response()->json([
            'status'     => 'added',
            'message'    => 'Added to cart',
            'cart_count' => Cart::where('user_id', $guard->id())->count(),
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate([
            'id'       => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('id', $request->id)->where('user_id', $guard->id())->firstOrFail();

        $quantity = (int) $request->quantity;
        if ($cart->product_variant_id && $cart->variant && $cart->variant->stock !== null) {
            $quantity = min($quantity, max((int) $cart->variant->stock, 1));
        }
        $cart->quantity = $quantity;
        $cart->save();

        $cartItems = Cart::where('user_id', $guard->id())->get();

        return response()->json([
            'status'     => 'updated',
            'line_total' => number_format($cart->line_total, 2),
            'totals'     => $this->computeTotals($cartItems),
        ]);
    }

    public function destroy(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate(['id' => 'required|exists:carts,id']);

        Cart::where('id', $request->id)->where('user_id', $guard->id())->delete();

        $cartItems = Cart::where('user_id', $guard->id())->get();
        if ($cartItems->isEmpty()) {
            session()->forget(['cart_coupon_id', 'cart_coupon_code']);
        }

        return response()->json([
            'status' => 'removed',
            'totals' => $this->computeTotals($cartItems),
            'empty'  => $cartItems->isEmpty(),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('coupon_code', $request->code)->where('status', true)->first();
        if (!$coupon || ($coupon->expires_at && \Carbon\Carbon::parse($coupon->expires_at)->isPast())) {
            return response()->json(['status' => 'error', 'message' => 'Invalid or expired coupon code.'], 422);
        }

        $cartItems = Cart::where('user_id', $guard->id())->get();
        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->unit_price);

        if ($coupon->min_price > 0 && $subtotal < $coupon->min_price) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Add ₹' . number_format($coupon->min_price, 2) . ' or more to use this coupon.',
            ], 422);
        }

        session([
            'cart_coupon_id'   => $coupon->id,
            'cart_coupon_code' => $coupon->coupon_code,
        ]);

        return response()->json([
            'status'  => 'applied',
            'message' => 'Coupon applied successfully.',
            'totals'  => $this->computeTotals($cartItems),
        ]);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget(['cart_coupon_id', 'cart_coupon_code']);

        $guard = Auth::guard('user');
        $cartItems = $guard->check() ? Cart::where('user_id', $guard->id())->get() : collect();

        return response()->json([
            'status' => 'removed',
            'totals' => $this->computeTotals($cartItems),
        ]);
    }

    /**
     * "variant" products: the qty table submits one input per specific
     * size+color combo, named by its ProductVariant id directly.
     */
    private function addVariantLines(int $userId, Product $product, array $quantities, array $customization): int
    {
        $variants = $product->product_variant->keyBy('id');
        $added = 0;

        foreach ($quantities as $variantId => $qty) {
            $qty = (int) $qty;
            if ($qty < 1) {
                continue;
            }
            $variant = $variants->get((int) $variantId);
            if (!$variant) {
                continue;
            }
            if ($variant->stock !== null) {
                $qty = min($qty, (int) $variant->stock);
            }
            if ($qty < 1) {
                continue;
            }

            [$sizeLabel, $colorLabel] = $this->variantLabels($variant);

            $this->addLine($userId, array_merge($customization, [
                'product_id'         => $product->id,
                'product_variant_id' => $variant->id,
                'quantity'           => $qty,
                'unit_price'         => $variant->sale_price ?: $variant->regular_price,
                'size_label'         => $sizeLabel,
                'color_label'        => $colorLabel,
            ]));
            $added++;
        }

        return $added;
    }

    /**
     * "bulk" products: the qty table submits bulk_quantities[size_id][color_id],
     * and price is a single tier rate applied to the grand total across every cell.
     */
    private function addBulkLines(int $userId, Product $product, array $bulkQuantities, array $customization): int
    {
        $tiers = $product->bulkProducts
            ->map(fn ($tier) => [
                'minimum' => $tier->minimum,
                'maximum' => $tier->maximum,
                'price'   => $tier->sale_price ?: $tier->regular_price,
            ])
            ->sortBy('minimum')
            ->values();

        $grandTotal = 0;
        foreach ($bulkQuantities as $cols) {
            foreach ((array) $cols as $qty) {
                $grandTotal += (int) $qty;
            }
        }
        if ($grandTotal < 1) {
            return 0;
        }

        $unitPrice = $this->bulkUnitPriceForQty($tiers, $grandTotal, $product->per_piece_price);

        $valueIds = array_unique(array_merge(
            array_keys($bulkQuantities),
            collect($bulkQuantities)->flatMap(fn ($cols) => array_keys((array) $cols))->all()
        ));
        $valueIds = array_filter($valueIds, 'is_numeric');
        $labels = AttributeValue::whereIn('id', $valueIds)->pluck('value', 'id');

        $added = 0;
        foreach ($bulkQuantities as $rowId => $cols) {
            foreach ((array) $cols as $colId => $qty) {
                $qty = (int) $qty;
                if ($qty < 1) {
                    continue;
                }

                $this->addLine($userId, array_merge($customization, [
                    'product_id'         => $product->id,
                    'product_variant_id' => null,
                    'quantity'           => $qty,
                    'unit_price'         => $unitPrice,
                    'size_label'         => $labels[$rowId] ?? null,
                    'color_label'        => $labels[$colId] ?? null,
                ]));
                $added++;
            }
        }

        return $added;
    }

    /**
     * A quantity that doesn't land inside any admin-defined tier (too small
     * for the lowest minimum, or bigger than the highest maximum) bills at
     * the product's own mandatory per-piece price — mirrors the same
     * fallback used client-side in productpage/quantity.blade.php.
     */
    private function bulkUnitPriceForQty($tiers, int $totalQty, ?float $basePrice): ?float
    {
        if ($tiers->isEmpty()) {
            return $basePrice;
        }
        $tier = $tiers->first(fn ($t) => $totalQty >= $t['minimum'] && ($t['maximum'] === null || $totalQty <= $t['maximum']));

        return $tier['price'] ?? $basePrice;
    }

    private function variantLabels($variant): array
    {
        $sizeLabel = null;
        $colorLabel = null;

        foreach ($variant->variantValues()->with('attribute_value.get_attribute')->get() as $vv) {
            $attrValue = $vv->attribute_value;
            if (!$attrValue) {
                continue;
            }
            if ($sizeLabel === null && $attrValue->get_attribute && stripos($attrValue->get_attribute->name, 'size') !== false) {
                $sizeLabel = $attrValue->value;
            } else {
                $colorLabel = $colorLabel ?? $attrValue->value;
            }
        }

        // Whichever attribute wasn't matched as "size" is the row label if size was never found.
        if ($sizeLabel === null && $colorLabel !== null) {
            $sizeLabel = $colorLabel;
            $colorLabel = null;
        }

        return [$sizeLabel, $colorLabel];
    }

    /**
     * Re-adding the same product/variant/size/color combo bumps the existing
     * line's quantity (and refreshes its customization) instead of piling up
     * duplicate rows.
     */
    private function addLine(int $userId, array $attributes): void
    {
        $matchKey = [
            'user_id'            => $userId,
            'product_id'         => $attributes['product_id'],
            'product_variant_id' => $attributes['product_variant_id'],
            'size_label'         => $attributes['size_label'] ?? null,
            'color_label'        => $attributes['color_label'] ?? null,
        ];

        $existing = Cart::where($matchKey)->first();
        if ($existing) {
            $existing->quantity += $attributes['quantity'];
            $existing->unit_price = $attributes['unit_price'];
            $existing->print_type = $attributes['print_type'];
            if (!empty($attributes['logo_path'])) {
                $existing->logo_path = $attributes['logo_path'];
            }
            $existing->logo_side = $attributes['logo_side'];
            $existing->logo_position_x = $attributes['logo_position_x'];
            $existing->logo_position_y = $attributes['logo_position_y'];
            $existing->save();
            return;
        }

        Cart::create(array_merge($matchKey, $attributes));
    }

    private function computeTotals($cartItems): array
    {
        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->unit_price);
        $itemCount = $cartItems->sum('quantity');

        $discount = 0;
        $coupon = $this->sessionCoupon();
        if ($coupon && $subtotal > 0 && (!$coupon->min_price || $subtotal >= $coupon->min_price)) {
            $discount = $coupon->discount_type == 1
                ? $subtotal * ($coupon->discount_value / 100)
                : $coupon->discount_value;
            if ($coupon->max_price > 0) {
                $discount = min($discount, $coupon->max_price);
            }
            $discount = min($discount, $subtotal);
        }

        $shipping = $subtotal > 0 ? 0 : 0; // Free shipping site-wide, per the storefront's "Free shipping on all orders" badge.
        $total = max($subtotal - $discount + $shipping, 0);

        return [
            'item_count' => $itemCount,
            'subtotal'   => round($subtotal, 2),
            'discount'   => round($discount, 2),
            'shipping'   => round($shipping, 2),
            'total'      => round($total, 2),
        ];
    }

    private function emptyTotals(): array
    {
        return ['item_count' => 0, 'subtotal' => 0, 'discount' => 0, 'shipping' => 0, 'total' => 0];
    }

    private function sessionCoupon(): ?Coupon
    {
        $couponId = session('cart_coupon_id');
        return $couponId ? Coupon::find($couponId) : null;
    }

    private function activeCoupons()
    {
        return Coupon::where('status', true)
            ->where(fn ($q) => $q->whereNull('expires_at')->orWhereDate('expires_at', '>=', now()))
            ->latest()
            ->get();
    }

    private function suggestedProducts($excludeProductIds = null)
    {
        return Product::with(['product_variant', 'product_gallery_image', 'wishlists', 'reviews', 'leastPricedVariant', 'leastPricedBulkTier'])
            ->where('status', 'active')
            ->when($excludeProductIds && $excludeProductIds->isNotEmpty(), fn ($q) => $q->whereNotIn('id', $excludeProductIds))
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }
}
