@extends('frontend.app')

@section('content')

@include('frontend.order.index')

@php
$isCompleted = false;

$status = [
'title' => $isCompleted ? 'Completed Successfully' : 'We will update you soon',
'date' => now()->format('M d, Y')
];
@endphp

@php
$timeline = [
[
'title' => 'Modul Process Started',
'date' => 'Dec 8, 2025'
],
[
'title' => 'Designing Process',
'date' => 'Dec 8, 2025'
],
[
'title' => 'Quality Check',
'date' => 'Dec 8, 2025'
],
[
'title' => 'Working on Changes',
'date' => 'Dec 8, 2025'
],
[
'title' => 'Ready For Review',
'date' => 'Dec 8, 2025'
],
];
@endphp

<div class="w-full bg-black text-white px-6 py-10">

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

        <div
            class="border border-white/20 rounded-[20px] overflow-hidden relative h-[420px] flex flex-col items-center justify-center">
            <h2 class="text-white text-[22px] sm:text-[26px] font-light text-center">
                {{ $status['title'] }}
            </h2>
            <p class="text-white/60 text-[13px] mt-3 text-center">
                {{ $status['date'] }}
            </p>
        </div>

        <!-- bottom buttons -->
        <div class="mt-6 flex flex-col sm:flex-row gap-4 w-full">

            <button onclick="openRequestPopup()"
                class="w-full sm:w-1/2 py-3 border border-white/40 rounded-[10px] text-white text-[14px] hover:bg-white hover:text-black transition text-center">
                Request Changes
            </button>

            <a href="/order/sample-review"
                class="w-full sm:w-1/2 py-3 bg-white text-black rounded-[10px] text-[14px] font-medium hover:bg-white/90 text-center">
                Approve Sample &amp; Start Production
            </a>

        </div>

    </div>
</div>

<!-- REQUEST CHANGES POPUP -->
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


<script>
function openRequestPopup() {
    const popup = document.getElementById('requestPopup');
    const box = document.getElementById('requestPopupBox');

    popup.classList.remove('invisible', 'opacity-0');
    popup.classList.add('opacity-100');

    box.classList.remove('scale-95', 'translate-y-4');
    box.classList.add('scale-100', 'translate-y-0');
}

function closeRequestPopup() {
    const popup = document.getElementById('requestPopup');
    const box = document.getElementById('requestPopupBox');

    popup.classList.remove('opacity-100');
    popup.classList.add('opacity-0');

    box.classList.remove('scale-100', 'translate-y-0');
    box.classList.add('scale-95', 'translate-y-4');

    setTimeout(() => {
        popup.classList.add('invisible');
    }, 300);
}

// click outside close
document.getElementById('requestPopup').addEventListener('click', closeRequestPopup);
</script>

@endsection