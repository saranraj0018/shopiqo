@extends('frontend.app')

@section('content')

@include('frontend.order.index')

<div class="min-h-screen bg-black text-white px-6 pt-[5rem] sm:pt-10 py-10">
    <div class="max-w-[650px] mx-auto">
        <div class="rounded-[16px] border border-white/40 bg-black px-6 py-6">
            <h2 class="text-[18px] font-medium mb-1">Advance Payment</h2>
            <p class="text-[13px] text-white/50 mb-6">
                Order {{ $order->order_id }} — pay 50% now to start production, the rest once you approve your sample.
            </p>

            <div class="space-y-3 mb-6">
                @foreach ($order->orderDetails as $detail)
                <div class="flex items-center justify-between text-[13px] border-b border-white/10 pb-3">
                    <div>
                        <p class="text-white">{{ $detail->product_name }}</p>
                        <p class="text-white/50 text-[11px]">
                            Qty: {{ $detail->quantity }}
                            @if($detail->product_size) &middot; Size: {{ $detail->product_size }} @endif
                        </p>
                    </div>
                    <p class="font-medium">₹{{ number_format($detail->net_amount, 2) }}</p>
                </div>
                @endforeach
            </div>

            <div class="rounded-[14px] bg-white/5 border border-white/10 p-5 space-y-3 text-[13px] mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-white/60">Order Total</span>
                    <span>₹{{ number_format($order->gross_amount, 2) }}</span>
                </div>
                <div class="flex items-center justify-between text-white font-medium text-[15px]">
                    <span>Advance Due Now (50%)</span>
                    <span>₹{{ number_format($order->payment->amount, 2) }}</span>
                </div>
                <div class="flex items-center justify-between text-white/40 text-[11px]">
                    <span>Remaining after sample approval</span>
                    <span>₹{{ number_format($order->gross_amount - $order->payment->amount, 2) }}</span>
                </div>
            </div>

            <p class="text-[11px] text-white/35 mb-4">
                No payment gateway is connected yet — clicking below simulates a successful payment so you can continue through the flow.
            </p>

            <button type="button" id="payNowBtn"
                class="w-full h-[46px] rounded-full bg-white text-black text-[14px] font-semibold hover:bg-white/90 transition">
                Pay ₹{{ number_format($order->payment->amount, 2) }} Now
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('payNowBtn');
    if (!btn) return;

    btn.addEventListener('click', function () {
        btn.disabled = true;
        showLoader();

        sendRequest('/order/advance-payment/pay', {}, 'POST', function (res) {
            hideLoader();

            if (res.status === 'unauthenticated') {
                showToast('Please sign in to continue.', 'error', 2500);
                btn.disabled = false;
                return;
            }
            if (res.status === 'paid') {
                showToast(res.message, 'success', 1500);
                setTimeout(function () { window.location.href = res.redirect; }, 500);
            }
        }, function (err) {
            hideLoader();
            btn.disabled = false;
            showToast(err.message || 'Payment failed.', 'error', 2000);
        });
    });
});
</script>

@endsection
