@php
$timeline = [
['title' => 'Product Selection', 'date' => 'Dec 8, 2025', 'status' => 'done'],
['title' => 'Design Approved', 'date' => 'Dec 9-10, 2025', 'status' => 'current'],
['title' => 'Mould View', 'date' => 'Dec 18, 2025', 'status' => 'pending'],
['title' => 'Pre-Production', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Mass Production Started', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Mass Production Completed', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Ready for Shipment', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Final Payment', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Shipment in Transit', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Delivered & Review', 'date' => 'Dec 20, 2025', 'status' => 'pending'],
];
@endphp

<section class="relative min-h-screen pt-[150px] bg-black text-white py-8 px-4 sm:px-6 lg:px-10">
    <!-- Background glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute left-0 top-10 h-[280px] w-[280px] rounded-full bg-white/5 blur-[120px]"></div>
        <div class="absolute right-0 top-20 h-[240px] w-[240px] rounded-full bg-white/5 blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/3 h-[280px] w-[280px] rounded-full bg-white/5 blur-[140px]"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-5xl">
        <h2
            class="mb-6 text-[20px] sm:text-[22px] font-semibold text-white flex justify-center lg:block lg:justify-start">
            Production Timeline
        </h2>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[300px_minmax(0,1fr)_300px] lg:items-start">

            <!-- Left product card -->
            <div class="md:sticky md:top-[30px] self-start">
                <div class="mx-auto w-full max-w-[320px] rounded-2xl bg-white shadow-lg lg:mx-0">
                    <img src="{{ asset('assets/images/jacket.png') }}" alt="Jacket"
                        class="h-[320px] w-full object-contain">
                </div>
            </div>

            <!-- Timeline -->
            <div class="relative left-[60px] md:left-[20px] lg:left-[40px] w-[80%] sm:w-auto">
                <div class="space-y-8">
                    @foreach($timeline as $index => $item)
                    <div class="relative flex gap-4 sm:gap-5">
                        <!-- Timeline dot and line -->
                        <div class="relative flex w-6 shrink-0 flex-col items-center">
                            @if($item['status'] === 'done')
                            <div
                                class="z-10 flex h-5 w-5 items-center justify-center rounded-full border border-white bg-black">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            @elseif($item['status'] === 'current')
                            <div
                                class="z-10 flex h-5 w-5 items-center justify-center rounded-full border border-white bg-black">
                                <div class="h-2.5 w-2.5 rounded-full bg-white"></div>
                            </div>
                            @else
                            <div class="z-10 h-5 w-5 rounded-full border border-white bg-black"></div>
                            @endif

                            @if(!$loop->last)
                            <div class="absolute top-5 h-[58px] w-px bg-white/40"></div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="pb-2">
                            <h3 class="text-[13px] sm:text-[14px] font-medium text-white">
                                {{ $item['title'] }}
                            </h3>
                            <p class="mt-1 text-[11px] sm:text-[12px] text-white/60">
                                {{ $item['date'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment card -->
            <div class="md:sticky md:top-[30px] self-start">
                <div class="mx-auto w-full max-w-[280px] rounded-2xl bg-white p-4 text-black shadow-lg lg:mx-0">
                    <p class="mb-4 text-[11px] font-medium text-gray-500">Remaining Payment</p>

                    <div class="border-b border-gray-200 pb-4 text-center">
                        <h3 class="text-[28px] font-semibold leading-none">₹25,000</h3>
                        <p class="mt-1 text-[11px] text-gray-500">50% Balance Payment</p>
                    </div>

                    <div class="mt-4 space-y-3 text-[11px] text-gray-400">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" disabled class="h-3.5 w-3.5 rounded border-gray-300">
                            <span>Production in progress</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" disabled class="h-3.5 w-3.5 rounded border-gray-300">
                            <span>Pay before shipment</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" disabled class="h-3.5 w-3.5 rounded border-gray-300">
                            <span>Ships after payment</span>
                        </label>
                    </div>

                    <button
                        class="mt-5 h-[40px] w-full rounded-lg bg-[#1f1f1f] text-[12px] font-medium text-white transition hover:bg-black">
                        Pay Remaining Amount
                    </button>

                    <p class="mt-5 text-[10px] leading-5 text-gray-400">
                        Payment required before final shipment. Your order will be dispatched immediately after payment
                        confirmation.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>