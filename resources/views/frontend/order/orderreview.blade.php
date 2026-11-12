@php
$maxSampleDays = $cartItems->max(fn ($i) => $i->product->sample_days ?? null) ?? 3;
@endphp
<div class="min-h-screen bg-black text-white px-6 pt-[5rem] sm:pt-10 py-10">
    <div class="max-w-[1050px] mx-auto grid grid-cols-1 lg:grid-cols-[1.7fr_0.8fr] gap-6">
        <div class="space-y-4">
            <div class="rounded-[16px] border border-white/40 bg-black px-5 py-4">
                <h2 class="text-[18px] font-medium leading-none mb-5">Review Your Order</h2>

                <div class="space-y-6">
                    @foreach ($cartItems as $item)
                    @php
                        $product = $item->product;
                        $packagingOptions = $product?->packaging_units_array ?? [10, 20, 50];
                        $defaultUnit = $packagingOptions[0] ?? 10;
                        $defaultPacks = $defaultUnit > 0
                            ? max((int) floor($item->quantity / $defaultUnit), $item->quantity > 0 ? 1 : 0)
                            : 0;
                    @endphp
                    <div class="{{ !$loop->last ? 'pb-6 border-b border-white/10' : '' }}">

                        <div class="flex items-start gap-4">
                            <div class="w-[96px] h-[96px] rounded-[12px] bg-white overflow-hidden shrink-0">
                                @if($product && $product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="Product"
                                    class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                @if($product && $product->get_category)
                                <p class="text-[10px] text-white/70 mb-1">{{ $product->get_category->name }}</p>
                                @endif
                                <h3 class="text-[16px] leading-[1.2] font-normal">{{ $product->name ?? 'Product unavailable' }}</h3>
                                <div class="mt-3 flex items-end gap-1">
                                    <span class="text-[20px] leading-none font-medium">₹{{ number_format($item->unit_price, 2) }}</span>
                                    <span class="text-[12px] text-white/80">/piece</span>
                                </div>
                                <div class="mt-2 flex flex-wrap items-center gap-x-6 gap-y-1 text-[12px] text-white/90">
                                    <p>Quantity: {{ $item->quantity }} units</p>
                                    @if($item->size_label)<p>Size: {{ $item->size_label }}</p>@endif
                                    @if($item->color_label)<p>Color: {{ $item->color_label }}</p>@endif
                                    @if($item->print_type)<p>Print: {{ $item->print_type }}</p>@endif
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-[14px] font-medium">₹{{ number_format($item->quantity * $item->unit_price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Packaging Options (per product) -->
                        <div class="mt-5">
                            <p class="text-[11px] uppercase text-white/70 mb-3">Packaging Options</p>
                            <div class="grid gap-3 mb-4" style="grid-template-columns: repeat({{ min(count($packagingOptions), 4) }}, minmax(0, 1fr));">
                                @foreach ($packagingOptions as $index => $unit)
                                <button type="button" onclick="selectUnit({{ $item->id }}, {{ $unit }}, {{ $item->quantity }}, this)"
                                    class="unit-btn-{{ $item->id }} w-full rounded-full text-[12px] font-medium py-2 transition
                                        {{ $index === 0 ? 'bg-white text-black' : 'border border-white text-white' }}">
                                    {{ $unit }} Units
                                </button>
                                @endforeach
                            </div>
                            <div class="rounded-[16px] border border-white/30 bg-[linear-gradient(90deg,rgba(255,255,255,0.12),rgba(255,255,255,0.03))] px-5 py-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[12px] text-white/70 mb-1">Total Packs</p>
                                    <h5 id="totalPacks_{{ $item->id }}" class="text-[24px] leading-none font-medium">
                                        {{ $defaultPacks }} pack{{ $defaultPacks !== 1 ? 's' : '' }}
                                    </h5>
                                </div>
                                <div class="text-right">
                                    <p class="text-[12px] text-white/70 mb-1">Summary</p>
                                    <p id="summaryText_{{ $item->id }}" class="text-[16px] font-medium">
                                        {{ $item->quantity }} pcs → {{ $defaultPacks }} pack{{ $defaultPacks !== 1 ? 's' : '' }} of {{ $defaultUnit }}
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" id="packagingUnitInput_{{ $item->id }}" value="{{ $defaultUnit }}">
                            <input type="hidden" id="totalPacksInput_{{ $item->id }}" value="{{ $defaultPacks }}">
                        </div>

                        <!-- Production Timeline (per product) -->
                        @if($product && ($product->sample_days || $product->production_min_days || $product->production_max_days))
                        <div class="mt-5">
                            <p class="text-[11px] uppercase text-white/70 mb-3">Production Timeline</p>
                            <div class="space-y-3 text-[12px] text-white/90">
                                @if($product->sample_days)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8.25L12 3l9 5.25M4.5 10.5v7.125L12 21l7.5-3.375V10.5M12 21v-7.5" />
                                    </svg>
                                    <p>Sample: {{ $product->sample_days }} {{ Str::plural('day', $product->sample_days) }}</p>
                                </div>
                                @endif
                                @if($product->production_min_days || $product->production_max_days)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                    </svg>
                                    <p>
                                        Bulk Production:
                                        {{ $product->production_min_days ?? $product->production_max_days }}–{{ $product->production_max_days ?? $product->production_min_days }}
                                        days
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="rounded-[16px] border border-white/30 px-5 py-4
    bg-gradient-to-r from-[#0a0a0a] via-[#1c1c1c] to-[#0a0a0a]">
                <h3 class="text-[19px] font-medium leading-none text-white mb-1">
                    Select Sample Type <span class="text-red-400">*</span>
                </h3>
                <p class="text-[13px] text-white/50 mb-5">
                    Required — choose how you'd like to review your sample before bulk production.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="sampleTypeGroup">
                    <button type="button" data-value="digital" onclick="selectSampleType('digital', this)"
                        class="sample-type-btn text-left rounded-[16px] border border-white/15 bg-[#1a1a1a] p-5 transition hover:border-white/40">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="text-[15px] font-medium text-white">Digital Sample Preview</h4>
                                <p class="text-[12px] text-white/50 mt-1">Instant mockups for quick approval</p>
                            </div>
                            <span class="sample-type-check shrink-0 w-5 h-5 rounded-full border border-white/30 flex items-center justify-center"></span>
                        </div>
                    </button>
                    <button type="button" data-value="physical" onclick="selectSampleType('physical', this)"
                        class="sample-type-btn text-left rounded-[16px] border border-white/15 bg-[#1a1a1a] p-5 transition hover:border-white/40">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="text-[15px] font-medium text-white">Physical Sample Delivery</h4>
                                <p class="text-[12px] text-white/50 mt-1">Check material, print quality, finishing</p>
                            </div>
                            <span class="sample-type-check shrink-0 w-5 h-5 rounded-full border border-white/30 flex items-center justify-center"></span>
                        </div>
                    </button>
                </div>
                <input type="hidden" id="sampleTypeInput" value="">
                <p id="sampleTypeError" class="text-[12px] text-red-400 mt-3 hidden">Please select a sample type.</p>
            </div>
        </div>

        <div class="md:sticky md:top-[20px] self-start">
            <div class="rounded-[16px] bg-[#f2f2f2] text-black px-5 py-5 mx-[20px] sm:mx-0">
                <h3 class="text-[16px] font-medium mb-4">Order Summary</h3>
                <div class="space-y-3 text-[12px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Total Order Value</span>
                        <span class="font-medium">₹{{ number_format($totals['subtotal'], 2) }}</span>
                    </div>
                    @if($totals['discount'] > 0)
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Coupon Discount</span>
                        <span class="font-medium">-₹{{ number_format($totals['discount'], 2) }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="text-black/45">{{ $totals['item_count'] }} units total</span>
                        <span class="font-medium">₹{{ number_format($totals['total'], 2) }}</span>
                    </div>
                </div>
                <div class="my-5 border-t border-black/15"></div>
                <div class="space-y-3 text-[12px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/75">Advance Payment (50%)</span>
                        <span class="font-medium">₹{{ number_format($totals['advance'], 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/75">Remaining (50%)</span>
                        <span class="font-medium">₹{{ number_format($totals['remaining'], 2) }}</span>
                    </div>
                    <p class="text-[10px] text-black/35">Remaining amount due after sample approval</p>
                </div>
                <div class="my-4 border-t border-black/15"></div>
                <div>
                    <h4 class="text-[14px] font-medium mb-2">What happens next?</h4>
                    <ol class="space-y-2 text-[12px] text-black/35">
                        <li>1. Pay 50% advance</li>
                        <li>2. Sample in {{ $maxSampleDays }} {{ Str::plural('day', $maxSampleDays) }}</li>
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
function selectUnit(cartId, unit, quantity, btn) {
    const packs = unit > 0 ? Math.max(Math.floor(quantity / unit), quantity > 0 ? 1 : 0) : 0;

    document.getElementById('totalPacks_' + cartId).innerText = packs + ' pack' + (packs !== 1 ? 's' : '');
    document.getElementById('summaryText_' + cartId).innerText =
        quantity + ' pcs → ' + packs + ' pack' + (packs !== 1 ? 's' : '') + ' of ' + unit;
    document.getElementById('packagingUnitInput_' + cartId).value = unit;
    document.getElementById('totalPacksInput_' + cartId).value = packs;

    document.querySelectorAll('.unit-btn-' + cartId).forEach(function (b) {
        b.classList.remove('bg-white', 'text-black');
        b.classList.add('border', 'border-white', 'text-white');
    });

    btn.classList.add('bg-white', 'text-black');
    btn.classList.remove('border', 'border-white', 'text-white');
}

function selectSampleType(value, btn) {
    document.getElementById('sampleTypeInput').value = value;
    document.getElementById('sampleTypeError').classList.add('hidden');

    document.querySelectorAll('.sample-type-btn').forEach(function (b) {
        b.classList.remove('border-white', 'bg-white/10');
        b.classList.add('border-white/15');
        b.querySelector('.sample-type-check').classList.remove('border-white', 'bg-white');
    });

    btn.classList.remove('border-white/15');
    btn.classList.add('border-white', 'bg-white/10');
    btn.querySelector('.sample-type-check').classList.add('border-white', 'bg-white');
}
</script>
