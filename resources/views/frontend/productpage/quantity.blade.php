<section class="bg-black text-white py-8 px-8 sm:px-4">

    <div class="max-w-[50rem] mx-auto flex justify-end">

        <!-- RIGHT PANEL -->
        <div class="w-full max-w-[380px]">

            <!-- Logo creation -->
            <div class="mb-7">
                <h3 class="text-[15px] font-medium text-white mb-1">
                    Don't have a print-ready logo?
                </h3>

                <p class="text-[12px] text-white/45 mb-3">
                    Request our logo creation/vectorization service
                </p>

                <!-- CLICK CONTAINER -->
                <div id="serviceBox" onclick="toggleLogoRequest()" class="rounded-[10px] border border-white/40 px-4 py-3 flex justify-between mb-3 cursor-pointer 
    transition-all duration-300 hover:bg-white/10">

                    <div>
                        <p class="text-[13px] text-white">Service Cost</p>
                        <p class="text-[11px] text-white/50">Based on complexity</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <p class="text-[18px] font-semibold text-white">₹199 – ₹499</p>

                        <svg id="logoArrow" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 text-white transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- SLIDE DOWN AREA -->
                <div id="logoRequestBox"
                    class="max-h-0 overflow-hidden opacity-0 transition-all duration-300 ease-in-out mb-4">

                    <button onclick="event.stopPropagation(); openPopup()"
                        class="w-full h-[42px] rounded-[10px] bg-white/10 hover:bg-white/20 text-[13px] text-white flex items-center justify-center gap-2">
                        ✦ Request Logo Creation
                    </button>
                </div>
            </div>


            <!-- POPUP -->
            <div id="logoPopup" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-[9999] px-8">

                <!-- BOX -->
                <div id="popupBox" class="relative w-full max-w-[580px] 
    rounded-[20px] bg-[#f5f5f5] p-4 sm:p-[15px]
    transform scale-95 opacity-0 transition duration-300">

                    <!-- CLOSE -->
                    <button onclick="closePopup()"
                        class="absolute top-4 right-4 w-8 h-8 rounded-full bg-black/10 text-black text-[18px] flex items-center justify-center hover:bg-black/15 transition">
                        ×
                    </button>

                    <!-- TITLE -->
                    <h2 class="text-[18px] sm:text-[20px] font-medium text-black mb-4">
                        Request Logo Creation
                    </h2>

                    <!-- Upload -->
                    <div class="max-h-[75vh] overflow-y-auto">
                        <div class="mb-4">
                            <p class="text-[14px] text-black mb-3">
                                Upload Reference Image <span class="text-black">*</span>
                            </p>

                            <label
                                class="w-full max-h-[70px] sm:max-h-[105px] rounded-[20px] border border-dashed border-black/15 bg-transparent flex flex-col items-center p-3 justify-center cursor-pointer hover:bg-black/[0.02] transition">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-black/25" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4-4a3 3 0 014 0l4 4m0 0l4-4M12 12V4m0 0l-3 3m3-3l3 3" />
                                </svg>

                                <p class="text-[12px] sm:text-[13px] text-black/60 text-center">
                                    Upload PNG/JPG logo screenshot
                                </p>

                                <input type="file" class="hidden" accept=".png,.jpg,.jpeg">
                            </label>
                        </div>

                        <!-- Instructions -->
                        <div class="mb-[10px]">
                            <p class="text-[14px] text-black mb-3">
                                Additional Instructions
                            </p>

                            <textarea rows="5" placeholder="Examples:
• Make logo 5 cm wider
• Place logo on left sleeve
• Use bold text for tagline
• Match Pantone color code..."
                                class="w-full rounded-[10px] border border-black/5 bg-black/[0.04] px-3 py-3 text-[14px] text-black placeholder:text-black/25 outline-none resize-none"></textarea>
                        </div>

                        <!-- Estimated Cost -->
                        <div
                            class="mb-4 rounded-[16px] border border-black/15 bg-transparent px-4 sm:px-4 py-4 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-[16px] font-medium text-black">
                                    Estimated Cost
                                </p>
                                <p class="text-[12px] text-black/45 mt-1">
                                    Final price depends on complexity. Delivery in 24-48 hours.
                                </p>
                            </div>

                            <p class="text-[20px] sm:text-[18px] font-semibold text-black whitespace-nowrap">
                                ₹199 – ₹499
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button onclick="closePopup()"
                                class="w-full sm:w-1/2 h-[46px] rounded-full border border-black/30 text-[16px] text-black hover:bg-black/[0.03] transition">
                                Cancel
                            </button>

                            <button
                                class="w-full sm:w-1/2 h-[46px] rounded-full bg-[#1d1d1f] text-[16px] text-white hover:bg-black transition">
                                Submit Request
                            </button>
                        </div>
                    </div>


                </div>
            </div>

            <!-- SIZE -->
            @if ($variantMatrix)
            <div class="mb-6">

                <div class="flex justify-between mb-3">
                    <p class="text-[12px] uppercase text-white/70">
                        Choose Size Quantities:
                    </p>

                    <button class="text-[12px] bg-white/10 px-3 py-1 rounded-full">
                        Size chart
                    </button>
                </div>

                <div class="bg-white/10 rounded-xl p-4">
                    <div class="overflow-x-auto">
                        <table id="sizeQuantityTable" class="min-w-full text-center border-separate border-spacing-y-1">
                            <thead>
                                <tr>
                                    <th class="text-left text-[11px] text-white/70 uppercase px-2 pb-2">Size</th>
                                    @foreach ($variantMatrix['cols'] as $col)
                                    <th class="text-[11px] text-white/70 lowercase px-2 pb-2 whitespace-nowrap">{{ $col->value }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($variantMatrix['rows'] as $row)
                                <tr>
                                    <td class="text-[11px] text-white lowercase px-2 py-1">{{ $row->value }}</td>
                                    @foreach ($variantMatrix['cols'] as $col)
                                        @php
                                            $cell = $variantMatrix['cells']["{$row->id}_{$col->id}"] ?? null;
                                            $isBulk = $variantMatrix['type'] === 'bulk';
                                            // "variant" cells carry stock/price for one specific combo;
                                            // "bulk" cells are just `true` — every combo is orderable and
                                            // priced later by the grand-total tier lookup, not per cell.
                                            $available = $cell && ($isBulk || $cell['stock'] > 0);
                                        @endphp
                                        <td class="px-2 py-1">
                                            @if ($available)
                                            <input type="number" min="0"
                                                @if (!$isBulk) max="{{ $cell['stock'] }}" data-price="{{ $cell['price'] }}" @endif
                                                value="0"
                                                data-col-id="{{ $col->id }}"
                                                class="qty-input w-[60px] h-[28px] rounded bg-white text-black text-[12px] px-2 text-center"
                                                name="{{ $isBulk ? "bulk_quantities[{$row->id}][{$col->id}]" : "quantities[{$cell['variant_id']}]" }}">
                                            @else
                                            <input type="text" value="—" disabled
                                                title="{{ $cell ? 'Out of stock' : 'Not available' }}"
                                                class="w-[60px] h-[28px] rounded bg-white/20 text-white/30 text-[12px] px-2 text-center cursor-not-allowed">
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t border-white/20">
                                    <td class="text-[11px] text-white font-semibold px-2 pt-2">Total</td>
                                    @foreach ($variantMatrix['cols'] as $col)
                                    <td class="col-total text-[12px] text-white font-semibold px-2 pt-2" data-col-id="{{ $col->id }}">0</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="text-[11px] text-white/70 px-2 pt-1">Grand Total</td>
                                    <td class="text-[12px] text-white px-2 pt-1" colspan="{{ $variantMatrix['cols']->count() }}">
                                        <span id="grandTotalQty">0</span> units
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- QUANTITY + PRICE -->
            <div class="mb-5">

                <!-- TITLE -->
                <p class="text-[11px] text-white/80 mb-2 uppercase">
                    Quantity (MOQ: {{ $moq }} {{ Str::plural('Unit', $moq) }})
                </p>

                <!-- ROW -->
                <div class="flex items-center gap-20">

                    <!-- NUMBER INPUT -->
                    <input type="number" id="orderQtyInput" value="{{ $moq }}" min="{{ $moq }}"
                        @if ($variantMatrix) readonly title="Set quantities in the table above" @endif
                        class="w-[140px] h-[40px] bg-black border border-white/50 rounded-lg px-3 text-white text-[13px] outline-none appearance-none
            [appearance:textfield]
            [&::-webkit-inner-spin-button]:opacity-100
            [&::-webkit-inner-spin-button]:cursor-pointer
            [&::-webkit-outer-spin-button]:opacity-100">

                    <!-- PRICE -->
                    <div>
                        <p class="text-[30px] font-semibold leading-none" id="orderPriceDisplay">
                            {{ $displayPrice ? '₹' . number_format($displayPrice * $moq, 2) : 'Get a Quote' }}
                        </p>
                        <p class="text-[11px] text-white/60 mt-1">
                            Inclusive of all taxes
                        </p>
                    </div>

                </div>
            </div>

            @if ($variantMatrix)
            <script>
                window.__productPricing = {
                    type: @json($variantMatrix['type']),
                    tiers: @json($variantMatrix['type'] === 'bulk' ? $variantMatrix['tiers'] : []),
                };
            </script>
            @endif

            <!-- BUTTONS -->
            <div class="flex gap-3 mb-6">

                <button
                    class="w-1/2 h-[44px] border border-white/60 rounded-lg text-white text-[14px] hover:bg-white/10 transition">
                    Add to Cart
                </button>

                <a href="/order"
                    class="w-1/2 h-[44px] bg-white text-black rounded-lg text-[14px] font-medium hover:bg-white/90 transition flex items-center justify-center">
                    Proceed
                </a>

            </div>

            <!-- FEATURES -->
            <div class="flex gap-[4rem] mb-6">

                <div class="flex gap-2 items-center">
                    <img src="{{ asset('assets/images/guaranteed.svg') }}" class="w-6 h-6 object-contain">

                    <p class="text-[12px] text-white/90">
                        100% Satisfaction<br>Guaranteed
                    </p>
                </div>

                <div class="flex gap-2 items-center">
                    <img src="{{ asset('assets/images/shipping.svg') }}" class="w-6 h-6 object-contain">

                    <p class="text-[12px] text-white/90">
                        Free shipping on<br>all orders
                    </p>
                </div>

            </div>

            <!-- SPEC -->
            <div>
                <h4 class="text-[14px] mb-2">
                    Specifications:
                </h4>

                <ul class="text-[12px] text-white/70 space-y-1 list-disc pl-4">
                    <li>Material: Mixed cotton</li>
                    <li>Print type: full color or single</li>
                    <li>4 color options are available – white, red, green, and blue</li>
                    <li>Sizes include S, M, L, XL, XXL</li>
                    <li>Customizable with image, text, company, and logo</li>
                    <li>Double stitching on the sleeve, neck, and bottom</li>

                </ul>
            </div>

        </div>

    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const DISPLAY_PRICE = {{ $displayPrice ?? 'null' }};
    const pricing = window.__productPricing || null; // { type, tiers } — only set when a size/color matrix exists
    const qtyInput = document.getElementById('orderQtyInput');
    const priceDisplay = document.getElementById('orderPriceDisplay');

    function formatCurrency(n) {
        return '₹' + n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateOrderSummary(totalQty, totalPrice) {
        if (qtyInput) qtyInput.value = totalQty;
        if (priceDisplay) priceDisplay.textContent = totalPrice !== null ? formatCurrency(totalPrice) : 'Get a Quote';
    }

    // Bulk pricing is tiered by total quantity ordered, not per cell.
    function bulkUnitPriceForQty(totalQty) {
        if (!pricing || !pricing.tiers.length) return null;
        if (totalQty < pricing.tiers[0].minimum) return pricing.tiers[0].price;
        const tier = pricing.tiers.find(function (t) {
            return totalQty >= t.minimum && (t.maximum === null || totalQty <= t.maximum);
        });
        // Above the highest tier's max: keep billing at the best (last) tier's rate.
        return tier ? tier.price : pricing.tiers[pricing.tiers.length - 1].price;
    }

    const table = document.getElementById('sizeQuantityTable');

    if (table) {
        const grandTotalEl = document.getElementById('grandTotalQty');

        function recalcTotals() {
            const totals = {};
            let grandTotal = 0;
            let variantTotalPrice = 0;
            let hasPricedItem = false;

            table.querySelectorAll('.qty-input').forEach(function (input) {
                const colId = input.dataset.colId;
                const qty = parseInt(input.value, 10) || 0;
                totals[colId] = (totals[colId] || 0) + qty;
                grandTotal += qty;

                if (pricing && pricing.type === 'variant' && qty > 0 && input.dataset.price) {
                    variantTotalPrice += qty * parseFloat(input.dataset.price);
                    hasPricedItem = true;
                }
            });

            table.querySelectorAll('.col-total').forEach(function (cell) {
                cell.textContent = totals[cell.dataset.colId] || 0;
            });
            if (grandTotalEl) grandTotalEl.textContent = grandTotal;

            if (pricing && pricing.type === 'bulk') {
                const unitPrice = grandTotal > 0 ? bulkUnitPriceForQty(grandTotal) : null;
                updateOrderSummary(grandTotal, unitPrice !== null ? unitPrice * grandTotal : null);
            } else {
                updateOrderSummary(grandTotal, hasPricedItem ? variantTotalPrice : null);
            }
        }

        table.addEventListener('input', function (e) {
            if (!e.target.classList.contains('qty-input')) return;

            const max = parseInt(e.target.max, 10);
            let val = parseInt(e.target.value, 10) || 0;
            if (val < 0) val = 0;
            if (!isNaN(max) && val > max) val = max;
            e.target.value = val;

            recalcTotals();
        });

        recalcTotals();
    } else if (qtyInput && DISPLAY_PRICE !== null) {
        // No size/color matrix (a "single" product) — the quantity box drives its own price.
        qtyInput.addEventListener('input', function () {
            const min = parseInt(qtyInput.min, 10) || 1;
            let val = parseInt(qtyInput.value, 10) || 0;
            if (val < min) val = min;
            qtyInput.value = val;
            updateOrderSummary(val, val * DISPLAY_PRICE);
        });
    }
});
</script>

<script>
function toggleLogoRequest() {
    const box = document.getElementById('logoRequestBox');
    const arrow = document.getElementById('logoArrow');

    if (box.classList.contains('max-h-0')) {
        box.classList.remove('max-h-0', 'opacity-0');
        box.classList.add('max-h-[100px]', 'opacity-100');
        arrow.classList.add('rotate-180');
    } else {
        box.classList.remove('max-h-[100px]', 'opacity-100');
        box.classList.add('max-h-0', 'opacity-0');
        arrow.classList.remove('rotate-180');
    }
}
</script>

<script>
function openPopup() {
    const popup = document.getElementById('logoPopup');
    const box = document.getElementById('popupBox');

    popup.classList.remove('hidden');
    popup.classList.add('flex');

    setTimeout(() => {
        box.classList.remove('scale-95', 'opacity-0');
        box.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closePopup() {
    const popup = document.getElementById('logoPopup');
    const box = document.getElementById('popupBox');

    box.classList.remove('scale-100', 'opacity-100');
    box.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
    }, 300);
}

document.getElementById('logoPopup').addEventListener('click', function(e) {
    if (e.target.id === 'logoPopup') {
        closePopup();
    }
});
</script>