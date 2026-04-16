@php
$vendorUpdates = [
[
'date' => 'Dec 8, 2025',
'time' => '10:30 AM',
'message' => 'Sample approved. Starting mass production.'
],
[
'date' => 'Dec 8, 2025',
'time' => '2:15 PM',
'message' => 'Raw materials ordered from suppliers.'
],
[
'date' => 'Dec 9, 2025',
'time' => '9:00 AM',
'message' => 'Materials received. Quality inspection in progress.'
],
];
@endphp

<section class="bg-black px-8 py-10 text-white sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl space-y-4">

        <!-- Order Details -->
        <div class="rounded-2xl border border-white/20 bg-black px-5 py-5 sm:px-6 sm:py-6">
            <h2 class="mb-5 text-[22px] font-medium text-white">Order Details</h2>

            <div class="grid grid-cols-1 gap-y-5 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <p class="mb-1 text-[11px] text-white/45">Order ID</p>
                    <p class="text-[14px] text-white">ORD-12345</p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] text-white/45">Product</p>
                    <p class="text-[14px] text-white">Custom Branded Pen</p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] text-white/45">Quantity</p>
                    <p class="text-[14px] text-white">500 units</p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] text-white/45">Start Date</p>
                    <p class="text-[14px] text-white">Dec 8, 2025</p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] text-white/45">Expected Completion</p>
                    <p class="text-[14px] text-white">Dec 20, 2025</p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] text-white/45">Vendor</p>
                    <p class="text-[14px] text-white">Shopigo Innovations Pvt Ltd</p>
                </div>

                <div class="sm:col-span-2 lg:col-span-1">
                    <p class="mb-1 text-[11px] text-white/45">Delivery Address</p>
                    <p class="text-[14px] leading-5 text-white">
                        12 Tech Row, Silicon Valley,<br>
                        Coimbatore
                    </p>
                </div>
            </div>
        </div>

        <!-- Vendor Updates -->
        <div class="rounded-2xl border border-white/20 bg-black px-5 py-5 sm:px-6 sm:py-6">
            <h2 class="mb-5 text-[22px] font-medium text-white">Vendor Updates</h2>

            <div class="space-y-6">
                @foreach($vendorUpdates as $update)
                <div class="relative pl-6">
                    <div class="absolute left-0 top-1 h-[38px] w-px bg-white/40"></div>

                    <p class="text-[10px] text-white/45">
                        {{ $update['date'] }} {{ $update['time'] }}
                    </p>

                    <p class="mt-1 text-[13px] leading-5 text-white/85">
                        {{ $update['message'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>