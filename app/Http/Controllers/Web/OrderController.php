<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderSampleStageLog;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        // Customers log in via the "user" guard (see UserLoginController::userAuthenticate),
        // not the default "web" guard.
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return redirect()->route('login');
        }

        $cartItems = Cart::with('product.product_gallery_image')->where('user_id', $guard->id())->latest()->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $this->data['cartItems']   = $cartItems;
        $this->data['totals']      = $this->computeTotals($cartItems);
        $this->data['currentStep'] = 1;
        $this->data['title']       = 'Customize & Order';

        return view('frontend.order', $this->data);
    }

    public function store(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'address'      => 'required|string|max:1000',
            'city'         => 'required|string|max:255',
            'state'        => 'required|string|max:255',
            'pincode'      => 'required|string|max:20',
            'sample_type'  => 'required|in:digital,physical',
            'packaging'    => 'nullable|array',
            'packaging.*.unit'  => 'nullable|integer|min:1',
            'packaging.*.packs' => 'nullable|integer|min:0',
        ]);

        $cartItems = Cart::with('product')->where('user_id', $guard->id())->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Your cart is empty.'], 422);
        }

        $totals = $this->computeTotals($cartItems);
        $coupon = $this->sessionCoupon();

        $order = DB::transaction(function () use ($request, $guard, $cartItems, $totals, $coupon) {
            $order = new Order();
            // Placeholder until we have the auto-increment id to build a real order number from.
            $order->order_id = 'PENDING';
            $order->user_id = (string) $guard->id();
            $order->address_id = json_encode([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'company_name' => $request->company_name,
                'address'      => $request->address,
                'city'         => $request->city,
                'state'        => $request->state,
                'pincode'      => $request->pincode,
            ]);
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->status = '1';
            $order->net_amount = $totals['subtotal'];
            $order->gross_amount = $totals['total'];
            $order->sample_type = $request->sample_type;
            $order->coupon_id = $coupon?->id;
            $order->coupon_amount = $totals['discount'] ?: null;
            $order->created_by = $guard->id();
            $order->save();

            $order->order_id = '#' . now()->format('Ymd') . str_pad($order->id, 6, '0', STR_PAD_LEFT);
            $order->save();

            $packaging = $request->input('packaging', []);

            foreach ($cartItems as $item) {
                $itemPackaging = $packaging[$item->id] ?? null;

                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $item->product_id;
                $detail->category_id = $item->product->category_id ?? null;
                // Null for "single"/"bulk" cart lines — only "variant" products
                // map to one specific ProductVariant row.
                $detail->variant_id = $item->product_variant_id;
                $detail->product_name = $item->product->name ?? 'Product';
                $detail->product_image = $item->product->main_image;
                $detail->product_size = $item->size_label;
                $detail->quantity = $item->quantity;
                $detail->unit_price = $item->unit_price;
                $detail->net_amount = round($item->quantity * $item->unit_price, 2);
                $detail->packaging_unit = $itemPackaging['unit'] ?? null;
                $detail->total_packs = $itemPackaging['packs'] ?? null;
                $detail->save();
            }

            // No payment gateway is wired up yet — this records the advance
            // due and leaves it PENDING rather than pretending it was paid.
            $payment = new Payment();
            $payment->order_id = $order->order_id;
            $payment->amount = $totals['advance'];
            $payment->user_id = $guard->id();
            $payment->status = 'PENDING';
            $payment->type = 'order';
            $payment->save();

            Cart::where('user_id', $guard->id())->delete();
            session()->forget(['cart_coupon_id', 'cart_coupon_code']);

            Notification::notifyUser(
                $guard->id(),
                'Order Placed',
                "Your order {$order->order_id} has been placed and is awaiting advance payment."
            );

            return $order;
        });

        session(['pending_order_id' => $order->id]);

        return response()->json([
            'status'   => 'placed',
            'message'  => 'Order placed — advance payment pending.',
            'order_id' => $order->order_id,
            'redirect' => route('order.advancepayment'),
        ]);
    }

    public function advancePayment(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return redirect()->route('login');
        }

        $order = Order::with(['payment', 'orderDetails'])
            ->where('id', session('pending_order_id'))
            ->where('created_by', $guard->id())
            ->first();

        // No pending order in this session (fresh visit, already paid, etc.)
        // — nothing to pay here, so send them somewhere useful instead of a blank page.
        if (!$order || !$order->payment) {
            return redirect()->route('cart.index');
        }
        if ($order->payment->status === 'PAID') {
            return redirect()->route('order.sampleprocess');
        }

        $this->data['order']       = $order;
        $this->data['currentStep'] = 2;
        $this->data['title']       = 'Advance Payment';

        return view('frontend.order.advancepayment', $this->data);
    }

    public function confirmPayment(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $order = Order::with('payment')
            ->where('id', session('pending_order_id'))
            ->where('created_by', $guard->id())
            ->first();

        if (!$order || !$order->payment) {
            return response()->json(['status' => 'error', 'message' => 'No pending payment found.'], 404);
        }

        // Simulated — no payment gateway is wired up yet. This just marks the
        // advance as paid so the flow can continue; swap in a real gateway
        // callback here before taking this live.
        $order->payment->status = 'PAID';
        $order->payment->transaction_id = 'SIMULATED-' . strtoupper(uniqid());
        $order->payment->save();

        Notification::notifyUser(
            $guard->id(),
            'Advance Payment Received',
            "Advance payment for order {$order->order_id} has been received — production sampling starts now."
        );

        return response()->json([
            'status'   => 'paid',
            'message'  => 'Advance payment received.',
            'redirect' => route('order.sampleprocess'),
        ]);
    }

    public function sampleProcess(Request $request)
    {
        $order = $this->pendingOrderForUser();
        if (!$order) {
            return redirect()->route('cart.index');
        }

        $this->data['order']       = $order;
        $this->data['currentStep'] = 3;
        $this->data['title']       = 'Sample Process';

        return view('frontend.order.sampleprocess', $this->data);
    }

    public function sampleReview(Request $request)
    {
        $order = $this->pendingOrderForUser();
        if (!$order) {
            return redirect()->route('cart.index');
        }

        $this->data['order']       = $order;
        $this->data['currentStep'] = 4;
        $this->data['title']       = 'Sample Review';

        return view('frontend.order.samplereview', $this->data);
    }

    /**
     * "Request Changes" on the Sample Process/Review pages — files a support
     * ticket for admin visibility and drops the order back to the "Working
     * on Changes" stage so the timeline reflects the customer's request.
     */
    public function requestSampleChanges(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['success' => false, 'message' => 'Please log in again.'], 401);
        }

        $request->validate([
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|max:5120',
        ]);

        $order = $this->pendingOrderForUser();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }

        $ticket = new Ticket();
        $ticket->user_id = $guard->id();
        $ticket->description = "Sample change request for order {$order->order_id}: {$request->description}";
        $ticket->status = 'pending';

        if ($request->hasFile('image')) {
            $imgName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('sample-change-requests', $imgName, 'public');
            $ticket->image = 'sample-change-requests/' . $imgName;
        }
        $ticket->save();

        $order->sample_stage = 4;
        $order->save();

        OrderSampleStageLog::create([
            'order_id' => $order->id,
            'stage'    => 4,
            'note'     => 'Customer requested changes: ' . Str::limit($request->description, 200),
        ]);

        return response()->json([
            'success' => true,
            'message' => "Request submitted — we'll review and update your sample.",
        ]);
    }

    public function approveSample(Request $request)
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return response()->json(['success' => false, 'message' => 'Please log in again.'], 401);
        }

        $order = $this->pendingOrderForUser();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }

        if ((int) $order->sample_stage !== 5) {
            return response()->json(['success' => false, 'message' => 'Your sample is not ready for approval yet.'], 422);
        }

        $order->sample_approved_at = now();
        $order->save();

        return response()->json([
            'success'  => true,
            'message'  => 'Sample approved — production will begin shortly.',
            'redirect' => route('order.ordersuccess'),
        ]);
    }

    private function pendingOrderForUser(): ?Order
    {
        $guard = Auth::guard('user');
        if (!$guard->check()) {
            return null;
        }

        return Order::with(['orderDetails', 'sampleStageLogs'])
            ->where('id', session('pending_order_id'))
            ->where('created_by', $guard->id())
            ->first();
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

        $total = max($subtotal - $discount, 0);
        $advance = round($total * 0.5, 2);

        return [
            'item_count' => $itemCount,
            'subtotal'   => round($subtotal, 2),
            'discount'   => round($discount, 2),
            'total'      => round($total, 2),
            'advance'    => $advance,
            'remaining'  => round($total - $advance, 2),
        ];
    }

    private function sessionCoupon(): ?Coupon
    {
        $couponId = session('cart_coupon_id');
        return $couponId ? Coupon::find($couponId) : null;
    }
}
