<div class="min-h-screen bg-black text-white px-6 pt-[5rem] sm:pt-10 py-10">
    <div class="max-w-[1050px] mx-auto grid grid-cols-1 lg:grid-cols-[1.7fr_0.8fr] gap-6">
        <div class="space-y-4">
            <div class="rounded-[16px] border border-white/40 bg-black px-5 py-4">
                <h2 class="text-[18px] font-medium leading-none mb-5">Review Your Order</h2>
                <div class="flex items-start gap-4">
                    <div class="w-[96px] h-[96px] rounded-[12px] bg-white overflow-hidden shrink-0">
                        <img src="{{ asset('assets/images/jacket.png') }}" alt="Product"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] text-white/70 mb-1">Brand: Polo</p>
                        <h3 class="text-[16px] leading-[1.2] font-normal">Unisex Highneck Jacket</h3>
                        <div class="mt-3 flex items-end gap-1">
                            <span class="text-[20px] leading-none font-medium">₹120</span>
                            <span class="text-[12px] text-white/80">/piece</span>
                        </div>
                        <div class="mt-2 flex items-center gap-6 text-[12px] text-white/90">
                            <p>Quantity: 50 units</p>
                            <p>Color: Black</p>
                        </div>
                    </div>
                </div>
                <div class="my-5 border-t border-white/30"></div>
                <div>
                    <h4 class="text-[18px] font-normal mb-4">Packaging Options</h4>
                    <div class="grid grid-cols-3 gap-4 mb-5">
                        <button onclick="selectUnit(10, this)"
                            class="unit-btn active w-full rounded-full bg-white text-black text-[12px] font-medium py-2">
                            10 Units
                        </button>
                        <button onclick="selectUnit(20, this)"
                            class="unit-btn w-full rounded-full border border-white text-white text-[15px] font-medium py-2">
                            20 Units
                        </button>
                        <button onclick="selectUnit(50, this)"
                            class="unit-btn w-full rounded-full border border-white text-white text-[15px] font-medium py-2">
                            50 Units
                        </button>
                    </div>
                    <div
                        class="rounded-[16px] border border-white/30 bg-[linear-gradient(90deg,rgba(255,255,255,0.12),rgba(255,255,255,0.03))] px-5 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-[12px] text-white/70 mb-1">Total Packs</p>
                            <h5 id="totalPacks" class="text-[24px] leading-none font-medium">1 pack</h5>
                        </div>
                        <div class="text-right">
                            <p class="text-[12px] text-white/70 mb-1">Summary</p>
                            <p id="summaryText" class="text-[16px] font-medium">10 pcs → 1 pack</p>
                        </div>
                    </div>
                </div>
                <div class="my-5 border-t border-white/30"></div>
                <div>
                    <h4 class="text-[18px] font-normal mb-4">Production Timeline</h4>
                    <div class="space-y-3 text-[12px] text-white/90">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8.25L12 3l9 5.25M4.5 10.5v7.125L12 21l7.5-3.375V10.5M12 21v-7.5" />
                            </svg>
                            <p>Sample: 3 days</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                            </svg>
                            <p>Bulk Production: 7-10 days days</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-[16px] border border-white/30 px-5 py-4 
    bg-gradient-to-r from-[#0a0a0a] via-[#1c1c1c] to-[#0a0a0a]">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div class="flex flex-col justify-center">
                        <h3 class="text-[19px] font-medium leading-none text-white mb-2">
                            Select Sample Type
                        </h3>
                        <p class="text-[13px] text-white/50">
                            Digital / Physical
                        </p>
                    </div>
                    <button onclick="openPopup()"
                        class="w-full md:w-[307px] h-[42px] rounded-[8px] bg-[#f1f1f1] text-black text-[14px] font-medium">
                        Proceed
                    </button>
                </div>
            </div>
        </div>
        <div id="popup"
            class="fixed inset-0 bg-black/70 flex items-center justify-center z-[9999] opacity-0 invisible transition-all duration-300">
            <div id="popupBox"
                class="bg-[#f3f3f3] p-5 rounded-[18px] scale-95 translate-y-4 transition-all duration-300"
                onclick="event.stopPropagation()">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-[320px] bg-[#1a1a1a] rounded-[16px] p-6 text-center text-white">
                        <div
                            class="w-[56px] h-[56px] mx-auto mb-4 rounded-full bg-white/10 flex items-center justify-center">
                            <img src="assets/images/Frame.svg" class="w-6 h-6" alt="Digital">
                        </div>
                        <h3 class="text-[16px] font-medium">Digital Sample Preview</h3>
                        <p class="text-[12px] text-white/60 mt-2">
                            Instant mockups for quick approval
                        </p>
                        <button class="mt-5 w-full bg-white text-black py-2 rounded-full text-[13px] font-medium">
                            Use Digital Sample
                        </button>
                    </div>
                    <div class="w-full md:w-[320px] bg-[#1a1a1a] rounded-[16px] p-6 text-center text-white">
                        <div
                            class="w-[56px] h-[56px] mx-auto mb-4 rounded-full bg-white/10 flex items-center justify-center">
                            <img src="assets/images/Frame1.svg" class="w-6 h-6" alt="Physical">
                        </div>
                        <h3 class="text-[16px] font-medium">Physical Sample Delivery</h3>
                        <p class="text-[12px] text-white/60 mt-2">
                            Check material, print quality, finishing.
                        </p>
                        <button class="mt-5 w-full bg-white text-black py-2 rounded-full text-[13px] font-medium">
                            Request Physical Sample
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:sticky md:top-[20px] self-start">
            <div class="rounded-[16px] bg-[#f2f2f2] text-black px-5 py-5 mx-[20px] sm:mx-0">
                <h3 class="text-[16px] font-medium mb-4">Order Summary</h3>
                <div class="space-y-3 text-[12px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Total Order Value</span>
                        <span class="font-medium">₹6,000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/45">50 units × ₹120</span>
                        <span class="font-medium">₹6,000</span>
                    </div>
                </div>
                <div class="my-5 border-t border-black/15"></div>
                <div class="space-y-3 text-[12px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/75">Advance Payment (50%)</span>
                        <span class="font-medium">₹3,000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/75">Remaining (50%)</span>
                        <span class="font-medium">₹3,000</span>
                    </div>
                    <p class="text-[10px] text-black/35">Remaining amount due after sample approval</p>
                </div>
                <div class="my-4 border-t border-black/15"></div>
                <div>
                    <h4 class="text-[14px] font-medium mb-2">What happens next?</h4>
                    <ol class="space-y-2 text-[12px] text-black/35">
                        <li>1. Pay 50% advance</li>
                        <li>2. Sample in 3 days</li>
                        <li>3. Approve sample</li>
                        <li>4. Bulk production starts</li>
                        <li>5. Pay remaining & receive</li>
                    </ol>
                </div>
            </div>
        </div>
        {{-- ✅ SHIPPING DETAILS INCLUDE --}}
        <div>
            @include('frontend.order.orderreviewaddress')
        </div>
    </div>
</div>

<script>
function selectUnit(unit, btn) {

    const totalPieces = 50

    const packs = Math.floor(totalPieces / unit);

    document.getElementById('totalPacks').innerText = packs + ' pack' + (packs > 1 ? 's' : '');
    document.getElementById('summaryText').innerText =
        totalPieces + ' pcs → ' + packs + ' pack' + (packs > 1 ? 's' : '') + ' of ' + unit;

    document.querySelectorAll('.unit-btn').forEach(b => {
        b.classList.remove('bg-white', 'text-black');
        b.classList.add('border', 'border-white', 'text-white');
    });

    btn.classList.add('bg-white', 'text-black');
    btn.classList.remove('border', 'border-white', 'text-white');
}

// POPUP SECTION

function openPopup() {
    const popup = document.getElementById('popup');
    const popupBox = document.getElementById('popupBox');

    popup.classList.remove('invisible', 'opacity-0');
    popup.classList.add('opacity-100');

    popupBox.classList.remove('scale-95', 'translate-y-4');
    popupBox.classList.add('scale-100', 'translate-y-0');
}

function closePopup() {
    const popup = document.getElementById('popup');
    const popupBox = document.getElementById('popupBox');

    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');

    popupBox.classList.remove('scale-100', 'translate-y-0');
    popupBox.classList.add('scale-95', 'translate-y-4');

    setTimeout(() => {
        popup.classList.add('invisible');
    }, 300);
}

document.getElementById('popup').addEventListener('click', closePopup);
</script>