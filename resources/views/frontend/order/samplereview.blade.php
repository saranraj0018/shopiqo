@extends('frontend.app')

@section('content')

@include('frontend.order.index')
<div class="w-full bg-black text-white px-4 sm:px-6 pt-[4rem] pb-10">
    <!-- Breadcrumb -->
    <div class="text-center text-[13px] text-white/70 mb-8 mt-8 md:hidden">
        @if(Request::segment(1))
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
    <div class="max-w-[750px] mx-auto">

        <!-- PRODUCT PREVIEW CARD -->
        <div class="rounded-[18px] border border-white/40 p-3 bg-black">
            <div class="rounded-[14px] min-h-[300px] sm:min-h-[420px] flex items-center justify-center px-4 py-8">

                <img onclick="openImagePreview()" src="{{ asset('assets/images/jacket.png') }}" alt="Jacket Preview"
                    class="max-h-[260px] sm:max-h-[380px] w-auto object-contain cursor-pointer ">

            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
            <button onclick="openRequestPopup()"
                class="w-full h-[44px] rounded-[8px] border border-white/40 text-white text-[13px] sm:text-[14px] hover:bg-white hover:text-black transition duration-300">
                Request Changes
            </button>

            <a href="/order/order-success"
                class="w-full h-[44px] rounded-[8px] bg-white text-black text-[13px] sm:text-[14px] font-medium hover:bg-white/90 transition duration-300 flex items-center justify-center">
                Approve Sample & Start Production
            </a>
        </div>
    </div>
</div>

<!-- POPUP SECTION -->

<div id="requestPopup"
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-[9999] opacity-0 invisible transition-all duration-300">

    <!-- BOX -->
    <div id="requestPopupBox"
        class="bg-[#f4f4f4] w-[95%] max-w-[520px] rounded-[20px] p-6 scale-95 translate-y-6 transition-all duration-300"
        onclick="event.stopPropagation()">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[18px] font-semibold text-black">Request Changes</h2>

            <button onclick="closeRequestPopup()"
                class="w-[30px] h-[30px] rounded-full bg-black/10 flex items-center justify-center text-black hover:bg-black/20">
                ✕
            </button>
        </div>

        <!-- LABEL -->
        <p class="text-[13px] text-black/70 mb-3">What needs to be changed?</p>

        <!-- TEXTAREA -->
        <textarea
            class="w-full h-[120px] rounded-[14px] bg-[#eaeaea] p-4 text-[13px] outline-none placeholder:text-black/40"
            placeholder="Add comments about what needs to be changed..."></textarea>

        <!-- UPLOAD -->
        <div class="mt-5">
            <p class="text-[13px] text-black/70 mb-2">Upload Revised Logo (Optional)</p>

            <label
                class="w-full h-[130px] border border-dashed border-black/20 rounded-[16px] flex flex-col items-center justify-center cursor-pointer bg-[#f7f7f7] hover:bg-[#efefef] transition">

                <!-- YOUR SVG IMAGE -->
                <img src="{{ asset('assets/images/Group.svg') }}" class="w-10 h-10 mb-2 opacity-60" alt="Upload Icon">

                <p class="text-[12px] text-black/40">Click to upload new logo</p>

                <input type="file" class="hidden">
            </label>
        </div>

        <!-- BUTTONS -->
        <div class="flex gap-4 mt-6">
            <button onclick="closeRequestPopup()"
                class="w-1/2 h-[44px] rounded-[10px] border border-black/30 text-[14px] text-black hover:bg-black hover:text-white transition">
                Cancel
            </button>

            <button
                class="w-1/2 h-[44px] rounded-[10px] bg-black text-white text-[14px] font-medium hover:bg-black/90 transition">
                Submit Request
            </button>
        </div>

    </div>
</div>

<!-- IMAGE PREVIEW POPUP -->
<div id="imagePreview"
    class="fixed inset-0 bg-black/80 flex items-center justify-center z-[9999] opacity-0 invisible transition-all duration-300">

    <!-- CLOSE BUTTON -->
    <button onclick="closeImagePreview()"
        class="absolute top-6 right-6 text-white text-[20px] bg-white/10 w-[40px] h-[40px] rounded-full flex items-center justify-center hover:bg-white hover:text-black transition">
        ✕
    </button>

    <!-- IMAGE BOX -->
    <div id="imagePreviewBox" class="scale-90 opacity-0 transition-all duration-300 flex items-center justify-center">

        <img src="{{ asset('assets/images/jacket.png') }}"
            class="max-h-[85vh] max-w-[90vw] object-contain rounded-[12px] shadow-lg">
    </div>

</div>

<script>
// OPEN IMAGES PREVIEW
function openImagePreview() {
    const popup = document.getElementById('imagePreview');
    const box = document.getElementById('imagePreviewBox');

    popup.classList.remove('invisible', 'opacity-0');
    popup.classList.add('opacity-100');

    box.classList.remove('scale-90', 'opacity-0');
    box.classList.add('scale-100', 'opacity-100');
}

function closeImagePreview() {
    const popup = document.getElementById('imagePreview');
    const box = document.getElementById('imagePreviewBox');

    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');

    box.classList.remove('scale-100', 'opacity-100');
    box.classList.add('scale-90', 'opacity-0');

    setTimeout(() => {
        popup.classList.add('invisible');
    }, 300);
}

document.getElementById('imagePreview').addEventListener('click', closeImagePreview);

// POPUP SECTION

function openRequestPopup() {
    const popup = document.getElementById('requestPopup');
    const box = document.getElementById('requestPopupBox');

    popup.classList.remove('invisible', 'opacity-0');
    popup.classList.add('opacity-100');

    box.classList.remove('scale-95', 'translate-y-6');
    box.classList.add('scale-100', 'translate-y-0');
}

function closeRequestPopup() {
    const popup = document.getElementById('requestPopup');
    const box = document.getElementById('requestPopupBox');

    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');

    box.classList.remove('scale-100', 'translate-y-0');
    box.classList.add('scale-95', 'translate-y-6');

    setTimeout(() => {
        popup.classList.add('invisible');
    }, 300);
}

document.getElementById('requestPopup').addEventListener('click', closeRequestPopup);
</script>

@endsection