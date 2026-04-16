@extends('frontend.app')

@section('content')

<div class=" bg-black flex items-center justify-center px-4 sm:px-6">
    <div class="w-full text-center">

        <img src="{{ asset('assets/images/ordericons/placedsuccessfully.png') }}" alt="Order placed"
            class="w-full max-w-[85%] sm:max-w-[60%] md:max-w-[45%] lg:max-w-[35%] mx-auto pt-[10rem] sm:pt-[9rem] md:pt-[9rem] mb-6 object-contain">

        <h1 class="text-white text-[18px] sm:text-[20px] md:text-[22px] font-semibold leading-tight mb-2">
            Order placed successfully!
        </h1>

        <p class="text-white/50 text-[13px] sm:text-[14px] md:text-[15px] mb-6 px-2">
            We’re getting it ready for you!
        </p>

        <a href="/order/track-order"
            class="inline-flex items-center justify-center min-w-[148px] h-[42px] sm:h-[46px] px-6 mb-8 rounded-full bg-white text-black text-[14px] sm:text-[15px] font-medium hover:bg-white/90 transition duration-300">
            View Orders
        </a>

    </div>
</div>

@endsection