<div class="bg-black px-4 pt-36 pb-8 text-white">

    <!-- Breadcrumb -->
    <div class="text-center text-[13px] text-white/70 mb-8">
        <span>Home</span>

        @if(Request::segment(1))
        <span class="mx-1">/</span>
        <span class="text-white capitalize">
            {{ Request::segment(1) }}
        </span>
        @endif
    </div>

    <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 lg:grid-cols-[1fr_340px]">

    @if($cartItems->isNotEmpty())
    <div>
        <div
            class="hidden md:grid grid-cols-[30px_1.8fr_0.6fr_0.6fr_0.6fr] items-center rounded-xl bg-[#f3f3f3] px-6 py-4 text-[14px] font-medium text-black">
            <p></p>
            <p>Product</p>
            <p class="text-center">Price</p>
            <p class="text-center">Quantity</p>
            <p class="text-center">Subtotal</p>
        </div>

        <div id="cartItemsList" class="h-[75vh] overflow-auto mt-4 hide-scrollbar">

            @foreach($cartItems as $cartItem)
            <div class="cart-row border-b border-white/20 py-4 sm:py-5" data-cart-id="{{ $cartItem->id }}">

                <div class="grid grid-cols-[30px_1fr] md:grid-cols-[30px_1.8fr_0.6fr_0.6fr_0.6fr] items-center gap-4">

                    <button type="button" data-id="{{ $cartItem->id }}"
                        class="cart-remove-btn flex h-8 w-8 items-center justify-center text-2xl text-white hover:text-white/70 transition">
                        &times;
                    </button>

                    <a href="{{ route('shop.single-product', ['id' => encrypt($cartItem->product_id)]) }}"
                        class="flex items-center gap-4 min-w-0">
                        <div class="h-[48px] w-[48px] shrink-0 rounded-md bg-white overflow-hidden">
                            @if($cartItem->product && $cartItem->product->main_image)
                            <img src="{{ asset('storage/' . $cartItem->product->main_image) }}"
                                class="h-full w-full object-cover">
                            @endif
                        </div>

                        <div class="min-w-0">
                            @if($cartItem->size_label || $cartItem->color_label)
                            <p class="text-[10px] text-white/60 uppercase">
                                {{ collect([$cartItem->size_label, $cartItem->color_label])->filter()->implode(' / ') }}
                            </p>
                            @endif
                            <h3 class="text-[15px] font-medium text-white truncate">
                                {{ $cartItem->product->name ?? 'Product unavailable' }}
                            </h3>
                            @if($cartItem->print_type)
                            <p class="text-[10px] text-white/45">{{ $cartItem->print_type }}</p>
                            @endif
                        </div>
                    </a>

                    <div class="text-left md:text-center pl-[46px] md:pl-0 text-[13px] text-white/80">
                        ₹{{ number_format($cartItem->unit_price, 2) }}
                    </div>

                    <div class="text-left md:text-center pl-[46px] md:pl-0">
                        <input type="number" min="1" value="{{ $cartItem->quantity }}" data-id="{{ $cartItem->id }}"
                            class="cart-qty-input w-[70px] h-[32px] rounded bg-white text-black text-[12px] px-2 text-center">
                    </div>

                    <div class="text-left md:text-center pl-[46px] md:pl-0 cart-line-total text-[14px] font-medium"
                        data-id="{{ $cartItem->id }}">
                        ₹{{ number_format($cartItem->line_total, 2) }}
                    </div>

                </div>

            </div>
            @endforeach

        </div>
    </div>

        <div class="space-y-4 px-6">

            <div class="rounded-[20px] border border-white/20 bg-white/95 p-4 sm:p-4 text-black">
                <h3 class="text-[14px] sm:text-[14px] font-semibold">Apply Coupon</h3>

                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center">
                    <input type="text" id="couponCodeInput" placeholder="Enter coupon code"
                        value="{{ $appliedCoupon->coupon_code ?? '' }}"
                        class="h-[48px] sm:h-[40px] w-full rounded-[14px] border border-black/70 bg-transparent px-4 text-[13px] text-black placeholder:text-[#6b7280] outline-none" />

                    <button id="applyCouponBtn"
                        class="h-[48px] sm:h-[40px] rounded-full bg-black px-6 text-[14px] font-medium text-white transition hover:bg-gray shrink-0">
                        {{ $appliedCoupon ? 'Remove' : 'Apply' }}
                    </button>
                </div>
                <p id="couponError" class="text-[11px] text-red-600 mt-2 hidden"></p>
                @if($appliedCoupon)
                <p id="couponSuccess" class="text-[11px] text-green-700 mt-2">"{{ $appliedCoupon->coupon_code }}" applied.</p>
                @else
                <p id="couponSuccess" class="text-[11px] text-green-700 mt-2 hidden"></p>
                @endif
            </div>

            @if($coupons ?? false)
            <div onclick="openCouponPopup()"
                class="cursor-pointer rounded-[16px] border border-white/20 bg-white/95 px-4 py-4 text-black hover:bg-white transition">

                <div class="flex items-center justify-between gap-4">
                    <span class="text-[14px] font-medium">View Available Coupons</span>
                    <span class="text-[14px] font-medium text-black">{{ $coupons->count() }} Available</span>
                </div>
            </div>
            @endif

            <div class="h-fit rounded-2xl bg-[#f3f3f3] p-5 text-black shadow-sm">
                <h3 class="text-[14px] font-medium">Price details</h3>

                <div class="my-4 border-t border-black/10"></div>

                <div class="space-y-3 text-[13px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Items</span>
                        <span id="cartItemCount">{{ $totals['item_count'] }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Sub Total</span>
                        <span id="cartSubtotal">₹{{ number_format($totals['subtotal'], 2) }}</span>
                    </div>

                    <div class="flex items-center justify-between" id="cartDiscountRow"
                        style="{{ $totals['discount'] > 0 ? '' : 'display:none' }}">
                        <span class="text-black/60">Coupon Discount</span>
                        <span id="cartDiscount">-₹{{ number_format($totals['discount'], 2) }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Shipping</span>
                        <span id="cartShipping">Free</span>
                    </div>
                </div>

                <div class="my-4 border-t border-black/10"></div>

                <div class="flex items-center justify-between text-[15px] font-medium">
                    <span class="text-black/70">Total</span>
                    <span id="cartTotal">₹{{ number_format($totals['total'], 2) }}</span>
                </div>

                <a href="/order"
                    class="mt-5 flex items-center justify-center h-[44px] rounded-full bg-black text-white text-[14px] font-medium hover:opacity-90 transition">
                    Proceed to Checkout
                </a>
            </div>

        </div>

    @else

    <div class="lg:col-span-2">

        <div
            class="flex flex-col items-center justify-center text-center">

            <img src="{{ asset('assets/images/ordericons/cartempty.png') }}"
                alt="No Orders"
                class="w-[240px] sm:w-[350px] object-contain">

            <h3 class="mt-6 text-white text-[20px] font-medium">
                No Orders yet
            </h3>

            <p class="mt-2 text-white/55 text-[13px] leading-relaxed">
                Start shopping now to fill is up.
            </p>

            <a href="/shop"
                class="mt-6 mb-6 h-[42px] px-6 rounded-full bg-white text-black text-[14px] font-medium flex items-center justify-center">
                Start Shopping
            </a>

        </div>

    </div>

    @endif

</div>


    <h2 class=" flex justify-center mb-8 mt-4 text-[24px] sm:text-[34px] md:text-[30px] font-light leading-[1.15]
    bg-gradient-to-r from-white via-white/80 to-white/40
    bg-clip-text text-transparent">
        You may also try
    </h2>

    <div class="w-full flex justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-4 px-[30px] lg:px-0 max-w-5xl">
            @forelse ($products as $item)
            @include('frontend.components.homeproductcard', ['item' => $item])
            @empty
            <p class="text-white/50 col-span-full text-center">No products available yet.</p>
            @endforelse
        </div>
    </div>
</div>

@if($coupons->isNotEmpty())
<div id="couponPopup" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-[9999] px-6">

    <div class="bg-white w-[90%] max-w-[400px] rounded-xl p-5 relative">

        <button onclick="closeCouponPopup()" class="absolute top-3 right-3 text-xl text-black">×</button>

        <h3 class="text-[16px] font-semibold text-black mb-4">
            Available Coupons
        </h3>

        <div class="space-y-3">

            @foreach($coupons as $coupon)
            <div class="border rounded-lg p-3 flex justify-between items-center">

                <div>
                    <p class="font-medium text-[14px] text-black">
                        {{ $coupon->coupon_code }}
                    </p>

                    <p class="text-[12px] text-black/60">
                        {{ $coupon->description }}
                    </p>
                </div>

                <button onclick="applyCouponFromPopup('{{ $coupon->coupon_code }}')"
                    class="text-sm text-black font-medium hover:underline">
                    Apply
                </button>

            </div>
            @endforeach

        </div>
    </div>
</div>
@endif

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const subtotalEl = document.getElementById('cartSubtotal');
    const discountEl = document.getElementById('cartDiscount');
    const discountRow = document.getElementById('cartDiscountRow');
    const totalEl = document.getElementById('cartTotal');
    const itemCountEl = document.getElementById('cartItemCount');

    function applyTotals(totals) {
        if (!totals) return;
        subtotalEl.textContent = '₹' + Number(totals.subtotal).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        totalEl.textContent = '₹' + Number(totals.total).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        itemCountEl.textContent = totals.item_count;
        if (totals.discount > 0) {
            discountEl.textContent = '-₹' + Number(totals.discount).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            discountRow.style.display = '';
        } else {
            discountRow.style.display = 'none';
        }
    }

    // Quantity change — recompute this line's subtotal plus the whole cart's totals.
    document.querySelectorAll('.cart-qty-input').forEach(function (input) {
        let lastValue = input.value;
        input.addEventListener('change', function () {
            let qty = parseInt(input.value, 10);
            if (!qty || qty < 1) qty = 1;
            input.value = qty;
            if (String(qty) === lastValue) return;

            showLoader();
            sendRequest('/cart/update', { id: input.dataset.id, quantity: qty }, 'POST', function (res) {
                hideLoader();
                lastValue = String(qty);
                const lineTotalEl = document.querySelector('.cart-line-total[data-id="' + input.dataset.id + '"]');
                if (lineTotalEl) lineTotalEl.textContent = '₹' + res.line_total;
                applyTotals(res.totals);
            }, function (err) {
                hideLoader();
                input.value = lastValue;
                showToast(err.message || 'Could not update quantity.', 'error', 2000);
            });
        });
    });

    // Remove a line item.
    document.querySelectorAll('.cart-remove-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            showLoader();
            sendRequest('/cart/remove', { id: btn.dataset.id }, 'POST', function (res) {
                hideLoader();
                const row = document.querySelector('.cart-row[data-cart-id="' + btn.dataset.id + '"]');
                if (row) row.remove();
                applyTotals(res.totals);
                if (res.empty) {
                    setTimeout(function () { window.location.reload(); }, 300);
                }
            }, function (err) {
                hideLoader();
                showToast(err.message || 'Could not remove item.', 'error', 2000);
            });
        });
    });

    // Apply / remove coupon.
    const applyCouponBtn = document.getElementById('applyCouponBtn');
    const couponInput = document.getElementById('couponCodeInput');
    const couponError = document.getElementById('couponError');
    const couponSuccess = document.getElementById('couponSuccess');

    function runApplyCoupon(code) {
        couponError.classList.add('hidden');
        if (!code) {
            couponError.textContent = 'Enter a coupon code.';
            couponError.classList.remove('hidden');
            return;
        }

        showLoader();
        sendRequest('/cart/apply-coupon', { code: code }, 'POST', function (res) {
            hideLoader();
            applyTotals(res.totals);
            couponInput.value = code;
            applyCouponBtn.textContent = 'Remove';
            couponSuccess.textContent = '"' + code + '" applied.';
            couponSuccess.classList.remove('hidden');
            showToast('Coupon applied!', 'success', 1500);
            closeCouponPopup();
        }, function (err) {
            hideLoader();
            couponError.textContent = err.message || 'Invalid coupon code.';
            couponError.classList.remove('hidden');
        });
    }

    window.applyCouponFromPopup = function (code) {
        runApplyCoupon(code);
    };

    if (applyCouponBtn) {
        applyCouponBtn.addEventListener('click', function () {
            couponError.classList.add('hidden');
            const isRemoving = applyCouponBtn.textContent.trim() === 'Remove';

            if (isRemoving) {
                showLoader();
                sendRequest('/cart/remove-coupon', {}, 'POST', function (res) {
                    hideLoader();
                    applyTotals(res.totals);
                    applyCouponBtn.textContent = 'Apply';
                    couponInput.value = '';
                    couponSuccess.classList.add('hidden');
                }, function () {
                    hideLoader();
                });
                return;
            }

            runApplyCoupon(couponInput.value.trim());
        });
    }
});

function openCouponPopup() {
    const popup = document.getElementById('couponPopup');
    if (!popup) return;
    popup.classList.remove('hidden');
    popup.classList.add('flex');
}

function closeCouponPopup() {
    const popup = document.getElementById('couponPopup');
    if (!popup) return;
    popup.classList.add('hidden');
    popup.classList.remove('flex');
}

document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('couponPopup');
    if (!popup) return;
    popup.addEventListener('click', function (e) {
        if (e.target.id === 'couponPopup') {
            closeCouponPopup();
        }
    });
});
</script>
