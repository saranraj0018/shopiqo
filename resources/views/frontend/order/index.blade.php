@php
$steps = [
['label' => 'Customize & Order','icon' => 'assets/images/ordericons/frame.svg','route' => '/order/customize',],
['label' => 'Advance Payment','icon' => 'assets/images/ordericons/frame4.svg','route' => '/order/payment',],
['label' => 'Sample Process','icon' => 'assets/images/ordericons/frame1.svg','route' => '/order/sample-process',],
['label' => 'Sample Review','icon' => 'assets/images/ordericons/frame2.svg','route' => '/order/sample-review',],
['label' => 'Order Success','icon' => 'assets/images/ordericons/frame3.svg','route' => '/order/order-success',],
];
@endphp

<div class="w-full bg-black px-6 pt-[4rem] md:pt-[9rem]">
    <div class="hidden lg:flex w-[70%] mx-auto items-center justify-between">

        @foreach($steps as $index => $step)
        @php
        $stepNumber = $index + 1;
        $isCompleted = $currentStep > $stepNumber;
        $isCurrent = $currentStep == $stepNumber;
        $isActive = $currentStep >= $stepNumber;

        // Step 1 & 2 no redirect
        // From step 3 onward, only previous steps clickable
        $canClick = $currentStep >= 3 && $stepNumber < $currentStep && !in_array($stepNumber, [1, 2]); @endphp <div
            class="flex items-center">
            @if($canClick)
            <a href="{{ $step['route'] }}" class="flex items-center hover:opacity-80 transition">
                @else
                <div class="flex items-center">
                    @endif

                    <div
                        class="w-[35px] h-[35px] rounded-full flex items-center justify-center border border-white/20 {{ $isActive ? 'bg-white' : 'bg-transparent' }}">
                        @if($isCompleted)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        @else
                        <img src="{{ asset($step['icon']) }}"
                            class="w-4 h-4 {{ $isActive ? 'opacity-100' : 'opacity-50' }}" alt="{{ $step['label'] }}">
                        @endif
                    </div>

                    <span class="ml-4 text-[14px] font-medium {{ $isActive ? 'text-white' : 'text-white/50' }}">
                        {{ $step['label'] }}
                    </span>

                    @if($canClick)
            </a>
            @else
    </div>
    @endif
</div>

@if(!$loop->last)
<div class="flex-1 h-[2px] mx-4 {{ $currentStep > $stepNumber ? 'bg-white/80' : 'bg-white/20' }}"></div>
@endif
@endforeach

</div>