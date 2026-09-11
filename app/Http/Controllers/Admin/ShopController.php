<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Print techniques offered site-wide. Kept as one source of truth so the
     * "Print Type" dropdown and the spec accordion never drift out of sync.
     */
    private const PRINT_TYPES = ['Embroidery', 'Screen Print'];

    public function index(Request $request)
    {
        // Fetch products with all necessary relations
        $this->data['products'] = Product::with([
            'product_variant',
            'product_variant.variantValues',
            'product_gallery_image',
            'admin',
            'wishlists',
            'reviews',
            'leastPricedVariant'
        ])->where('status', 'active')->limit(6)->get();
        return view('frontend.shop')->with($this->data);
    }

    public function show($id)
    {
        $decryptedId = decrypt($id);
        $product = Product::with([
            'product_variant',
            'product_variant.variantValues.attribute_value.get_attribute',
            'product_gallery_image',
            'admin',
            'wishlists',
            'reviews.user',
            'leastPricedVariant'
        ])->where('id', $decryptedId)->first();

        $variantMatrix = $this->buildVariantMatrix($product);
        $approvedReviews = $product->reviews->where('status', 1)->sortByDesc('created_at')->values();

        $this->data['product']         = $product;
        $this->data['variantMatrix']   = $variantMatrix;
        $this->data['printTypes']      = self::PRINT_TYPES;
        $this->data['moq']             = $this->resolveMoq($variantMatrix);
        $this->data['displayPrice']    = $this->resolveDisplayPrice($product, $variantMatrix);
        // Customers log in via the "user" guard, not the default "web" guard.
        $this->data['isWishlisted'] = Auth::guard('user')->check()
            && $product->wishlists->contains('user_id', Auth::guard('user')->id());
        $this->data['approvedReviews'] = $approvedReviews;
        $this->data['reviewStats']     = $this->buildReviewStats($approvedReviews);

        return view('frontend.productpage', $this->data);
    }

    /**
     * Minimum order quantity. Only "bulk" products have a real MOQ (the
     * lowest quantity tier); everything else can be ordered one at a time.
     */
    private function resolveMoq(?array $variantMatrix): int
    {
        if ($variantMatrix && $variantMatrix['type'] === 'bulk' && $variantMatrix['tiers']->isNotEmpty()) {
            return (int) $variantMatrix['tiers']->first()['minimum'];
        }
        return 1;
    }

    /**
     * The headline "starting from" price shown near the product title.
     */
    private function resolveDisplayPrice(Product $product, ?array $variantMatrix): ?float
    {
        return match ($product->product_type) {
            'bulk'    => $variantMatrix && $variantMatrix['tiers']->isNotEmpty()
                ? $variantMatrix['tiers']->first()['price']
                : null,
            'variant' => $product->leastPricedVariant
                ? ($product->leastPricedVariant->sale_price ?: $product->leastPricedVariant->regular_price)
                : null,
            default   => $product->sale_price ?: $product->regular_price,
        };
    }

    /**
     * Average rating, review count, and a per-star percentage breakdown
     * (share of all reviews that gave that star count) for the rating bars.
     */
    private function buildReviewStats($approvedReviews): array
    {
        $count = $approvedReviews->count();
        $breakdown = [];
        for ($star = 5; $star >= 1; $star--) {
            $starCount = $approvedReviews->where('rating', $star)->count();
            $breakdown[$star] = $count ? (int) round($starCount / $count * 100) : 0;
        }

        return [
            'count'     => $count,
            'average'   => $count ? round($approvedReviews->avg('rating'), 1) : 0,
            'breakdown' => $breakdown,
        ];
    }

    /**
     * Build a size (rows) x color (columns) quantity matrix for the storefront.
     *
     * - "variant" products: each ProductVariant row IS one specific size+color
     *   combo, with its own price/stock. Cells only exist for combos an admin
     *   actually created.
     * - "bulk" products: ProductVariant rows are quantity price TIERS (e.g.
     *   4-8 units, 40-80 units), and every color/size an admin tagged applies
     *   to the whole product, not to a single combo. So every row x col
     *   combination is available, and price instead depends on the grand
     *   total quantity across the matrix (the returned "tiers" list).
     *
     * Returns null when there's nothing to show (no variants, or a "single"
     * product with no attributes at all).
     */
    private function buildVariantMatrix(?Product $product): ?array
    {
        if (!$product || !in_array($product->product_type, ['variant', 'bulk']) || $product->product_variant->isEmpty()) {
            return null;
        }

        $sizeTypeId = null;
        $seenTypeIds = [];
        foreach ($product->product_variant as $variant) {
            foreach ($variant->variantValues as $vv) {
                $type = $vv->attribute_value?->get_attribute;
                if (!$type) {
                    continue;
                }
                $seenTypeIds[$type->id] = true;
                if ($sizeTypeId === null && stripos($type->name, 'size') !== false) {
                    $sizeTypeId = $type->id;
                }
            }
        }

        if ($sizeTypeId === null) {
            // No attribute is literally named "Size". "variant" products always
            // have a chosen primary attribute to fall back on; "bulk" products
            // don't, so just pick whichever attribute type was seen first.
            $sizeTypeId = $product->product_variant->first()->pri_attribute_id
                ?? array_key_first($seenTypeIds);
        }

        $sortValues = fn ($values) => collect($values)
            ->sortBy([['sort_order', 'asc'], ['id', 'asc']])
            ->values();

        return $product->product_type === 'bulk'
            ? $this->buildBulkMatrix($product, $sizeTypeId, $sortValues)
            : $this->buildPerComboMatrix($product, $sizeTypeId, $sortValues);
    }

    private function buildPerComboMatrix(Product $product, ?int $sizeTypeId, \Closure $sortValues): ?array
    {
        $rowValues = [];
        $colValues = [];
        $cells = [];

        foreach ($product->product_variant as $variant) {
            $rowValue = null;
            $colValue = null;

            foreach ($variant->variantValues as $vv) {
                $attrValue = $vv->attribute_value;
                if (!$attrValue || !$attrValue->get_attribute) {
                    continue;
                }
                if ($attrValue->get_attribute->id === $sizeTypeId) {
                    $rowValue = $attrValue;
                } else {
                    $colValue = $attrValue;
                }
            }

            if (!$rowValue) {
                continue;
            }

            $rowValues[$rowValue->id] = $rowValue;
            $colId = $colValue?->id ?? 'default';
            if ($colValue) {
                $colValues[$colValue->id] = $colValue;
            }

            $cells["{$rowValue->id}_{$colId}"] = [
                'variant_id' => $variant->id,
                'stock'      => $variant->stock,
                'price'      => $variant->sale_price ?: $variant->regular_price,
            ];
        }

        if (empty($rowValues)) {
            return null;
        }

        return [
            'type'  => 'variant',
            'rows'  => $sortValues($rowValues),
            'cols'  => $colValues ? $sortValues($colValues) : collect([(object) ['id' => 'default', 'value' => 'Qty']]),
            'cells' => $cells,
        ];
    }

    private function buildBulkMatrix(Product $product, ?int $sizeTypeId, \Closure $sortValues): ?array
    {
        $rowValues = [];
        $colValues = [];

        // Every tier is tagged with the same set of attribute values, so any
        // one tier's values represent the whole product's available options.
        foreach ($product->product_variant->first()->variantValues as $vv) {
            $attrValue = $vv->attribute_value;
            if (!$attrValue || !$attrValue->get_attribute) {
                continue;
            }
            if ($attrValue->get_attribute->id === $sizeTypeId) {
                $rowValues[$attrValue->id] = $attrValue;
            } else {
                $colValues[$attrValue->id] = $attrValue;
            }
        }

        if (empty($rowValues)) {
            return null;
        }

        $rows = $sortValues($rowValues);
        $cols = $colValues ? $sortValues($colValues) : collect([(object) ['id' => 'default', 'value' => 'Qty']]);

        // Every row x col combination is orderable for a bulk product.
        $cells = [];
        foreach ($rows as $row) {
            foreach ($cols as $col) {
                $cells["{$row->id}_{$col->id}"] = true;
            }
        }

        $tiers = $product->product_variant
            ->map(fn ($tier) => [
                'minimum' => $tier->minimum,
                'maximum' => $tier->maximum,
                'price'   => $tier->sale_price ?: $tier->regular_price,
            ])
            ->sortBy('minimum')
            ->values();

        return [
            'type'  => 'bulk',
            'rows'  => $rows,
            'cols'  => $cols,
            'cells' => $cells,
            'tiers' => $tiers,
        ];
    }
}
