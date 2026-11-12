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

{{--
    Pushed to the `modals` stack (see frontend.app) rather than left inline
    here — this content sits inside the `relative z-10` page wrapper above,
    which caps its own stacking context regardless of this modal's z-index,
    the same navbar-clipping trap the logo-creation popup hit earlier.
--}}
@push('modals')
<div id="avatarZoomModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 px-4 opacity-0 transition-opacity duration-300 ease-out">
    <button type="button" onclick="closeAvatarZoom()"
        class="absolute top-6 right-6 w-10 h-10 rounded-full bg-white/10 text-white text-[20px] flex items-center justify-center hover:bg-white hover:text-black transition">
        ×
    </button>
    <img id="avatarZoomImg" src="" alt="Profile photo"
        class="max-h-[85vh] max-w-[90vw] rounded-[16px] object-contain scale-90 opacity-0 transition-all duration-300 shadow-2xl">
</div>
@endpush

<script>
function openAvatarZoom(src) {
    if (!src) return;
    const modal = document.getElementById('avatarZoomModal');
    const img = document.getElementById('avatarZoomImg');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        modal.classList.remove('opacity-0');
        img.classList.remove('scale-90', 'opacity-0');
        img.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeAvatarZoom() {
    const modal = document.getElementById('avatarZoomModal');
    const img = document.getElementById('avatarZoomImg');

    modal.classList.add('opacity-0');
    img.classList.remove('scale-100', 'opacity-100');
    img.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('avatarZoomModal');
    if (!modal) return;
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeAvatarZoom();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAvatarZoom();
    });
});
</script>
@endsection