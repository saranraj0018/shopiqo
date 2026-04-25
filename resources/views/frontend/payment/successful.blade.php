@extends('frontend.app')

@section('content')

<section class="bg-[#000000] flex items-center justify-center relative overflow-hidden pt-[150px] pb-[40px]">

    <div class="relative z-10 w-full max-w-[420px] text-center px-6">

<div class="flex justify-center mb-4">
    <video autoplay loop muted playsinline
           class="w-[220px] sm:w-[300px] object-contain">
        <source src="{{ asset('assets/images/ordericons/successful.mp4') }}" type="video/mp4">
    </video>
</div>

        <h2 class="text-white text-[20px] sm:text-[24px] font-medium mb-2">
            Payment successful!
        </h2>

        <p class="text-white/50 text-[13px] sm:text-[14px] mb-4">
            Your payment has been processed.
        </p>

        <a href="#"
            class="inline-block px-8 py-2 rounded-full bg-white text-black text-[14px] font-medium hover:bg-white/90 transition">
            View Cart
        </a>

    </div>

</section>

@endsection