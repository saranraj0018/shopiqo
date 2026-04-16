@extends('frontend.app')

@section('content')
<section class="relative min-h-screen overflow-hidden bg-black text-white py-10 px-[25px] md:px-8 top-[65px] mb-[64px]">
    <!-- Background Glow -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(255,255,255,0.06),transparent_30%)]">
        </div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_70%,rgba(255,255,255,0.05),transparent_28%)]">
        </div>
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.03),transparent,rgba(255,255,255,0.03))]">
        </div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-center text-[13px] text-white/70 mb-8 mt-8">
            <span>Home</span>

            @if(Request::segment(1))
            <span class="mx-1">/</span>
            <span class="text-white capitalize">
                {{ Request::segment(1) }}
            </span>
            @endif

            @if(Request::segment(2))
            <span class="mx-1">/</span>
            <span class="text-white capitalize">
                {{ Request::segment(2) }}
            </span>
            @endif
        </div>

        <div class="flex flex-col lg:flex-row gap-6 items-start">
            <!-- Sidebar -->
            @include('frontend.profile.sidebar')

            <!-- Main Content -->
            <div class="flex-1 w-full">
                @if(request()->is('profile'))
                @include('frontend.profile.profile')
                @elseif(request()->is('profile/orders-activity'))
                @include('frontend.profile.ordersactivity')
                @elseif(request()->is('profile/address'))
                @include('frontend.profile.address')
                @elseif(request()->is('profile/notification'))
                @include('frontend.profile.notifications')
                @elseif(request()->is('profile/support-help'))
                @include('frontend.profile.supporthelp')
                @endif
            </div>
        </div>
    </div>
</section>
@endsection