@php
$steps = [
[
'title' => 'Browse & Select Products',
'desc' => 'Follow these simple steps to get your customized corporate gifts and event merchandise',
'points' => [
'Browse 500+ products',
'Check quantity discounts',
'Filter by category & price',
'Read product specifications',
],
'image' => 'Frame.svg'
],
[
'title' => 'Customize Your Products',
'desc' => 'Upload your company logo, select colors, add custom text, and personalize every detail.',
'points' => [
'Upload logo (PNG, SVG, JPG)',
'Choose from color options',
'Preview your design',
'Add custom text',
],
'image' => 'Frame1.svg'
],
[
'title' => 'Pay 50% Advance',
'desc' => 'Make a secure payment of just 50% of the total order value. This covers the sample production and confirms
your order.',
'points' => [
'Pay only 50% upfront',
'Secure payment gateway',
'Multiple payment options',
'Instant order confirmation',
],
'image' => 'Frame2.svg'
],
[
'title' => 'Sample Creation',
'desc' => 'We produce a tangible sample of your item, ensuring your logo, colors, and overall quality meet your
standards.',
'points' => [
'Explore our catalog',
'Volume discount rates',
'Sort by type & cost',
'View item details',
],
'image' => 'Frame3.svg'
],
[
'title' => 'Accept or Revise',
'desc' => 'Here how to order your custom business swag and promotional items',
'points' => [
'Browse 500+ products',
'Check quantity discounts',
'Filter by category & price',
'Read product specifications',
],
'image' => 'Frame4.svg'
],
[
'title' => 'Mass Production',
'desc' => 'Here how to order your custom business swag and promotional items',
'points' => [
'Browse 500+ products',
'Check quantity discounts',
'Filter by category & price',
'Read product specifications',
],
'image' => 'Frame5.svg'
],
[
'title' => 'Pay Remaining Amount',
'desc' => 'Here how to order your custom business swag and promotional items.',
'points' => [
'Browse 500+ products',
'Check quantity discounts',
'Filter by category & price',
'Read product specifications',
],
'image' => 'Frame6.svg'
],
[
'title' => 'Delivery to Your Doorstep',
'desc' => 'Your bulk order is carefully packaged and delivered to your specified address with tracking information.',
'points' => [
'Tracked shipping',
'On-time delivery',
'Secure packaging',
'Delivery confirmation',
],
'image' => 'Frame7.svg'
],
];
@endphp
<div class="w-full bg-black text-white overflow-hidden relative">

    <!-- background glow -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_35%)]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(255,255,255,0.06),_transparent_30%)]">
    </div>

    <!-- top curved line effect -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div
            class="w-full h-full bg-[repeating-radial-gradient(circle_at_top,_rgba(255,255,255,0.08)_0px,_rgba(255,255,255,0.08)_1px,_transparent_1px,_transparent_18px)]">
        </div>
    </div>

    <div class="relative z-10 max-w-[900px] mx-auto px-8 pt-52 pb-20">

        <!-- top title -->
        <div class="text-center">
            <h1 class="text-[34px] sm:text-[48px] leading-none font-normal tracking-[-0.02em]">
                How Shopiq Works
            </h1>

            <p class="my-4 max-w-[620px] mx-auto text-[11px] sm:text-[14px] leading-[1.5] text-white/70">
                Our simple 6-step sample-first process ensures you get perfect customized products
                every time. No surprises, no mistakes, just quality merchandise.
            </p>

            <a href="/shop"
                class="mt-5 py-[10px] px-[25px] h-[36px] px-6 rounded-full bg-white text-black text-[12px] font-medium hover:bg-white/90 transition">
                Start Shopping
            </a>
        </div>

        <!-- section heading -->
        <div class="text-center mt-20 md:mt-40">
            <h2 class="text-[24px] sm:text-[34px] font-light leading-none">
                Step-by-Step Process
            </h2>
            <p class="mt-3 text-[11px] sm:text-[13px] text-white/65 max-w-[470px] mx-auto leading-[1.5]">
                Follow these simple steps to get your customized corporate
                gifts and event merchandise
            </p>
        </div>

        <div class="mt-16 space-y-16">

            @foreach($steps as $index => $step)

            <div
                class="grid grid-cols-1 md:grid-cols-[{{ $index % 2 == 0 ? '1fr_160px' : '160px_1fr' }}] items-center gap-8">

                <!-- LEFT / RIGHT CONTENT -->
                <div
                    class="{{ $index % 2 != 0 ? 'md:order-2 md:ml-[60px]' : '' }} rounded-[18px] border border-white/20 bg-[linear-gradient(135deg,_rgba(255,255,255,0.06)_0%,_rgba(0,0,0,0.8)_40%,_rgba(255,255,255,0.04)_100%)]
                            backdrop-blur-xl shadow-[0_0_40px_rgba(255,255,255,0.05)] px-[20px] py-[20px] text-white max-w-[520px]">

                    <h3 class="text-[18px] font-semibold mb-3">
                        {{ $step['title'] }}
                    </h3>

                    <p class="text-white/70 text-[13px] mb-4 leading-[1.6]">
                        {{ $step['desc'] }}
                    </p>

                    <ul class="space-y-4 text-[13px] text-white/90">
                        @foreach($step['points'] as $point)
                        <li class="flex items-center gap-3">
                            <span
                                class="w-5 h-5 rounded-full bg-white text-black flex items-center justify-center text-[12px]">✓</span>
                            {{ $point }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- ICON SIDE -->
                <div class="flex justify-center md:justify-start {{ $index % 2 != 0 ? 'md:order-1' : '' }}">
                    <div class="relative">

                        <div class="relative w-[80px] h-[80px] rounded-full flex items-center justify-center border border-white/20 bg-[radial-gradient(circle_at_30%_30%,rgba(255,255,255,0.12),rgba(0,0,0,0.9))]
                                    shadow-[inset_0_0_40px_rgba(255,255,255,0.08),0_0_25px_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/abouticons/'.$step['image']) }}"
                                class="w-10 h-10 opacity-90" />

                            <div
                                class="absolute inset-0 rounded-full bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.15),transparent_60%)]">
                            </div>
                        </div>

                        <!-- STEP NUMBER -->
                        <div
                            class="absolute top-[-4px] right-[-4px] w-[28px] h-[28px] rounded-full bg-white text-black text-[14px] font-semibold flex items-center justify-center shadow">
                            {{ $index + 1 }}
                        </div>

                    </div>
                </div>

            </div>

            @endforeach
        </div>
    </div>
</div>