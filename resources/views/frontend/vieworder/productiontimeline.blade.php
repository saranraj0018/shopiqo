@php
$timeline = [
['title' => 'Order Confirmed, Feb 07', 'date' => 'Dec 8, 2025', 'status' => 'done'],
['title' => 'Product Selection', 'date' => 'Dec 8, 2025', 'status' => 'done'],
['title' => 'Design Approved', 'date' => 'Dec 9-10, 2025', 'status' => 'current'],
['title' => 'Mould View', 'date' => 'Dec 18, 2025', 'status' => 'pending'],
['title' => 'Pre-Production', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Mass Production Started', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Mass Production Completed', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Ready for Shipment', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Final Payment', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Shipment in Transit', 'date' => 'Dec 19, 2025', 'status' => 'pending'],
['title' => 'Delivered & Review', 'date' => 'Dec 20, 2025', 'status' => 'done'],
];
@endphp

<section class="relative overflow-hidden bg-black text-white pt-[150px] pb-10 px-4 sm:px-6 lg:px-8">
    <!-- Background glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute left-0 top-10 h-[260px] w-[260px] rounded-full bg-white/5 blur-[120px]"></div>
        <div class="absolute right-0 top-20 h-[240px] w-[240px] rounded-full bg-white/5 blur-[120px]"></div>
        <div class="absolute bottom-0 left-1/3 h-[280px] w-[280px] rounded-full bg-white/5 blur-[140px]"></div>
    </div>

    <div class="relative z-10 mx-auto w-full max-w-[1100px] px-10 sm:px-4">
        <h2
            class="mb-6 text-[20px] sm:text-[22px] font-semibold text-white flex pt-4 justify-center lg:block lg:pt-0 lg:justify-start">
            Production
            Timeline</h2>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[auto_1fr_auto] xl:grid-cols-[auto_1fr_auto] lg:items-start">

            <!-- Left Product Card -->
            <div class="w-full max-w-[340px] rounded-[14px] mx-auto lg:mx-0">
                <img src="{{ asset('assets/images/jacket.png') }}" alt="Jacket"
                    class="h-[270px] sm:h-[300px] w-full object-contain">
            </div>

            <!-- Timeline Section -->
            <div class="w-full h-[30vh] sm:h-[55vh] overflow-auto pl-[50px] custom-scroll">
                <div id="timelineWrapper" class="overflow-hidden transition-all duration-500">
                    <div class="space-y-8">
                        @foreach($timeline as $index => $item)
                        <div
                            class="timeline-item relative flex gap-4 {{ ($index !== 0 && !$loop->last) ? 'extra-item hidden' : '' }}">

                            <!-- Dot and line -->
                            <div class="relative flex w-6 shrink-0 flex-col items-center">
                                @if($item['status'] === 'done')
                                <div
                                    class="z-10 flex h-6 w-6 items-center justify-center rounded-full border border-white bg-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                @elseif($item['status'] === 'current')
                                <div
                                    class="z-10 flex h-6 w-6 items-center justify-center rounded-full border border-white bg-black">
                                    <div class="h-2.5 w-2.5 rounded-full bg-white"></div>
                                </div>
                                @else
                                <div class="z-10 h-6 w-6 rounded-full border border-white bg-black"></div>
                                @endif

                                @if(!$loop->last)
                                <div class="absolute top-6 h-[62px] w-px bg-white/30"></div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="pb-1">
                                <h3 class="text-[14px] sm:text-[15px] font-medium text-white leading-[1.3]">
                                    {{ $item['title'] }}
                                </h3>
                                <p class="mt-1 text-[12px] text-white/60">
                                    {{ $item['date'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Toggle button -->
                <div class="mt-6">
                    <button id="toggleTimeline"
                        class="inline-flex items-center gap-2 text-[14px] sm:text-[15px] font-medium text-white hover:text-white/80 transition">
                        <span id="toggleText">See All Updates</span>
                        <svg id="toggleArrow" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Price Details Card -->
            <div class="w-full min-w-[300px] rounded-[16px] bg-[#f3f3f3] p-5 text-black mx-auto lg:mx-0">
                <h3 class="text-[14px] font-medium text-black/80">Price details</h3>

                <div class="my-4 h-px bg-black/10"></div>

                <div class="space-y-3 text-[14px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Items</span>
                        <span class="font-medium">9</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Sub Total</span>
                        <span class="font-medium">₹200.00</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Shipping</span>
                        <span class="font-medium">₹200.00</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Taxes</span>
                        <span class="font-medium">₹200.00</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-black/55">Coupon Discount</span>
                        <span class="font-medium">- ₹10.00</span>
                    </div>
                </div>

                <div class="my-4 h-px bg-black/10"></div>

                <div class="flex items-center justify-between text-[15px]">
                    <span class="text-black/60">Total</span>
                    <span class="font-semibold">₹200.00</span>
                </div>

                <div
                    class="mt-4 rounded-[10px] bg-[#e9e9e9] px-4 py-3 text-[14px] text-black/45 flex items-center justify-between">
                    <span>Payment method</span>
                    <span>UPI</span>
                </div>

                <button
                    class="mt-4 h-[44px] w-full rounded-full bg-[#1f1f1f] text-[14px] font-medium text-white transition hover:bg-black">
                    Download Invoice
                </button>
            </div>
        </div>
    </div>
</section>

<style>
/* Chrome, Edge, Safari */
.custom-scroll::-webkit-scrollbar {
    width: 6px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
    /* clean dark bg */
}

.custom-scroll::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Firefox */
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById("toggleTimeline");
    const toggleText = document.getElementById("toggleText");
    const toggleArrow = document.getElementById("toggleArrow");
    const extraItems = document.querySelectorAll(".extra-item");

    let isOpen = false;

    toggleBtn.addEventListener("click", function() {
        isOpen = !isOpen;

        extraItems.forEach((item, index) => {
            if (isOpen) {
                setTimeout(() => {
                    item.classList.remove("hidden");
                    item.classList.add("animate-fadeIn");
                }, index * 40);
            } else {
                item.classList.add("hidden");
                item.classList.remove("animate-fadeIn");
            }
        });

        if (isOpen) {
            toggleText.textContent = "Close Updates";
            toggleArrow.classList.add("rotate-90");
        } else {
            toggleText.textContent = "See All Updates";
            toggleArrow.classList.remove("rotate-90");
        }
    });
});
</script>

<style>
.animate-fadeIn {
    animation: fadeIn .35s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>