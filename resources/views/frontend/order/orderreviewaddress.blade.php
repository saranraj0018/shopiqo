<div class="bg-black flex items-center justify-center">
    <div class="w-full max-w-full">
        <div class="mb-6">
            <p class="text-white text-[14px] font-medium mb-3">
                Upload Your Original Logo File for Best Output
                <span class="text-white/50">(Optional)</span>
            </p>
            <div class="relative w-full h-[180px] rounded-[16px] border border-dashed border-white/30 flex flex-col items-center justify-center text-center bg-[#050505]
        shadow-[inset_0_1px_0_rgba(255,255,255,0.03),inset_0_-40px_80px_rgba(255,255,255,0.02)]">
                <input type="file" class="absolute inset-0 opacity-0 cursor-pointer">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white/70" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5V17a2 2 0 002 2h14a2 2 0 002-2v-.5M7 10l5-5m0 0l5 5m-5-5v12" />
                    </svg>
                </div>
                <p class="text-[13px] text-white/60 mb-2">
                    Drop logo here or click to upload
                </p>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[11px] text-white/40">Best quality formats:</span>

                    <span class="text-[10px] border border-white/30 text-white px-2 py-[2px] rounded">
                        CDR
                    </span>
                    <span class="text-[10px] border border-white/30 text-white px-2 py-[2px] rounded">
                        AI
                    </span>
                    <span class="text-[10px] border border-white/30 text-white px-2 py-[2px] rounded">
                        PDF
                    </span>
                </div>
                <p class="text-[11px] text-white/40">
                    💡 Vector files (CDR/AI) recommended
                </p>
            </div>
        </div>
        <div class="rounded-[18px] border border-white/70 bg-black px-6 py-6 sm:px-7 sm:py-7">
            <h2 class="text-white text-[22px] sm:text-[22px] font-medium leading-none mb-8">
                Shipping Details
            </h2>
            <form id="shippingForm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-9 gap-y-6 mb-4">
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            Full Name <span class="text-white">*</span>
                        </label>
                        <input type="text" id="shipName" value="{{ auth('user')->user()->name ?? '' }}" placeholder="Enter Your Name" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            Email <span class="text-white">*</span>
                        </label>
                        <input type="email" id="shipEmail" value="{{ auth('user')->user()->email ?? '' }}" placeholder="Enter Your Email" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-9 gap-y-6 mb-4">
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            Phone <span class="text-white">*</span>
                        </label>
                        <input type="text" id="shipPhone" value="{{ auth('user')->user()->phone ?? '' }}" placeholder="Enter Your Phone Number" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>

                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            Company Name <span class="font-normal">(Optional)</span>
                        </label>
                        <input type="text" id="shipCompany" value="{{ auth('user')->user()->company_name ?? '' }}" placeholder="Enter Your Company Name" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                        Address <span class="text-white">*</span>
                    </label>
                    <textarea rows="4" id="shipAddress" placeholder="Street address, building, floor" class="w-full rounded-[10px] border border-white/20 bg-[#050505] px-4 py-4 text-[13px] text-white placeholder:text-white/35 outline-none resize-none
                shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-20px_35px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                focus:border-white/30"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-9 gap-y-6 mb-4">
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            City <span class="text-white">*</span>
                        </label>
                        <input type="text" id="shipCity" placeholder="Enter Your City" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            State <span class="text-white">*</span>
                        </label>
                        <input type="text" id="shipState" placeholder="Enter Your State" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                    <div>
                        <label class="block text-white text-[13px] sm:text-[14px] font-medium mb-3">
                            Pincode <span class="text-white">*</span>
                        </label>
                        <input type="text" id="shipPincode" placeholder="Enter Your Pincode" class="w-full h-[44px] rounded-[10px] border border-white/20 bg-[#050505] px-4 text-[13px] text-white placeholder:text-white/35 outline-none
                    shadow-[inset_0_1px_0_rgba(255,255,255,0.05),inset_0_-14px_30px_rgba(255,255,255,0.04),0_0_0_1px_rgba(255,255,255,0.02)]
                    focus:border-white/30">
                    </div>
                </div>
                <p id="shippingFormError" class="text-[12px] text-red-400 mb-4 hidden"></p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('cart.index') }}"
                        class="w-full h-[44px] rounded-[10px] border border-white text-white text-[14px] font-normal hover:bg-white hover:text-black transition duration-300 flex items-center justify-center">
                        Cancel
                    </a>
                    <button type="button" id="makePaymentBtn"
                        class="w-full h-[44px] rounded-[10px] bg-white text-black text-[14px] font-medium hover:bg-white/90 transition duration-300 flex items-center justify-center">
                        Make Payment
                    </button>
                </div>
            </form>

            <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btn = document.getElementById('makePaymentBtn');
                const errorEl = document.getElementById('shippingFormError');
                if (!btn) return;

                const fields = {
                    name: document.getElementById('shipName'),
                    email: document.getElementById('shipEmail'),
                    phone: document.getElementById('shipPhone'),
                    company_name: document.getElementById('shipCompany'),
                    address: document.getElementById('shipAddress'),
                    city: document.getElementById('shipCity'),
                    state: document.getElementById('shipState'),
                    pincode: document.getElementById('shipPincode'),
                };

                btn.addEventListener('click', function () {
                    errorEl.classList.add('hidden');

                    const sampleTypeInput = document.getElementById('sampleTypeInput');
                    const sampleTypeError = document.getElementById('sampleTypeError');
                    if (sampleTypeInput && !sampleTypeInput.value) {
                        if (sampleTypeError) sampleTypeError.classList.remove('hidden');
                        document.getElementById('sampleTypeGroup').scrollIntoView({ behavior: 'smooth', block: 'center' });
                        return;
                    }

                    const required = ['name', 'email', 'phone', 'address', 'city', 'state', 'pincode'];
                    for (const key of required) {
                        if (!fields[key].value.trim()) {
                            errorEl.textContent = 'Please fill in all required shipping fields.';
                            errorEl.classList.remove('hidden');
                            fields[key].focus();
                            return;
                        }
                    }

                    const payload = {};
                    Object.keys(fields).forEach(function (key) { payload[key] = fields[key].value.trim(); });
                    payload.sample_type = sampleTypeInput ? sampleTypeInput.value : null;

                    // Each cart line item has its own packaging picker (see orderreview.blade.php).
                    const packaging = {};
                    @foreach($cartItems as $cartItem)
                    packaging['{{ $cartItem->id }}'] = {
                        unit: document.getElementById('packagingUnitInput_{{ $cartItem->id }}').value,
                        packs: document.getElementById('totalPacksInput_{{ $cartItem->id }}').value,
                    };
                    @endforeach
                    payload.packaging = packaging;

                    btn.disabled = true;
                    showLoader();

                    sendRequest('/order', payload, 'POST', function (res) {
                        hideLoader();
                        btn.disabled = false;

                        if (res.status === 'unauthenticated') {
                            showToast('Please sign in to place an order.', 'error', 2500);
                            return;
                        }
                        if (res.status === 'placed') {
                            showToast('Order placed!', 'success', 1500);
                            setTimeout(function () { window.location.href = res.redirect; }, 600);
                        }
                    }, function (err) {
                        hideLoader();
                        btn.disabled = false;
                        if (err.errors) {
                            errorEl.textContent = Object.values(err.errors)[0][0];
                        } else {
                            errorEl.textContent = err.message || 'Something went wrong.';
                        }
                        errorEl.classList.remove('hidden');
                    });
                });
            });
            </script>
        </div>
    </div>
</div>