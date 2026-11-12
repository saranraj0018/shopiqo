@extends('frontend.app')

@section('content')

@include('frontend.order.index')

@php
    $isReady = (int) $order->sample_stage === 5;

    $status = [
        'title' => $isReady ? 'Ready for your review!' : 'We will update you soon',
        'date'  => optional($order->sampleStageLogs->last()->created_at ?? $order->created_at)->format('M d, Y'),
    ];

    // One real, dated entry per admin-logged stage update — no log yet for
    // a stage just means the admin team hasn't reached it.
    $loggedStages = $order->sampleStageLogs->keyBy('stage');
    $timeline = collect(\App\Models\Order::SAMPLE_STAGES)->map(function ($label, $stage) use ($loggedStages) {
        $log = $loggedStages->get($stage);
        return [
            'title' => $label,
            'date'  => $log ? $log->created_at->format('M d, Y') : null,
            'note'  => $log?->note,
            'done'  => (bool) $log,
        ];
    })->values();
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

        <!-- Timeline -->
        <div class="mt-6 rounded-[16px] border border-white/15 divide-y divide-white/10">
            @foreach($timeline as $step)
            <div class="flex items-center justify-between px-5 py-3">
                <div class="flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full {{ $step['done'] ? 'bg-white' : 'bg-white/20' }}"></span>
                    <div>
                        <p class="text-[13px] {{ $step['done'] ? 'text-white' : 'text-white/40' }}">{{ $step['title'] }}</p>
                        @if($step['note'])
                        <p class="text-[11px] text-white/40 mt-0.5">{{ $step['note'] }}</p>
                        @endif
                    </div>
                </div>
                <span class="text-[11px] text-white/40">{{ $step['date'] ?? 'Pending' }}</span>
            </div>
            @endforeach
        </div>

        <div class="mt-6 flex flex-col sm:flex-row gap-4 w-full">

            <button onclick="openRequestPopup()"
                class="w-full sm:w-1/2 py-3 border border-white/40 rounded-[10px] text-white text-[14px] hover:bg-white hover:text-black transition text-center">
                Request Changes
            </button>

            @if($isReady)
            <a href="/order/sample-review"
                class="w-full sm:w-1/2 py-3 bg-white text-black rounded-[10px] text-[14px] font-medium hover:bg-white/90 text-center">
                Approve Sample &amp; Start Production
            </a>
            @else
            <span
                class="w-full sm:w-1/2 py-3 bg-white/10 text-white/40 rounded-[10px] text-[14px] font-medium text-center cursor-not-allowed">
                Awaiting Design Team
            </span>
            @endif

        </div>

    </div>
</div>

<div id="requestPopup"
    class="fixed inset-0 bg-black/60 flex items-center justify-center z-[9999] opacity-0 invisible transition-all duration-300">

    <div id="requestPopupBox"
        class="bg-[#f4f4f4] w-[95%] max-w-[520px] rounded-[20px] p-6 scale-95 translate-y-6 transition-all duration-300"
        onclick="event.stopPropagation()">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[18px] font-semibold text-black">Request Changes</h2>

            <button onclick="closeRequestPopup()"
                class="w-[30px] h-[30px] rounded-full bg-black/10 flex items-center justify-center text-black hover:bg-black/20">
                ✕
            </button>
        </div>

        <p class="text-[13px] text-black/70 mb-3">What needs to be changed?</p>

        <p id="requestPopupError" class="hidden mb-2 text-[12px] text-red-600"></p>

        <textarea id="sampleChangeDescription"
            class="w-full h-[120px] rounded-[14px] bg-[#eaeaea] p-4 text-[13px] outline-none placeholder:text-black/40"
            placeholder="Add comments about what needs to be changed..."></textarea>

        <div class="mt-5">
            <p class="text-[13px] text-black/70 mb-2">Upload Revised Logo (Optional)</p>

            <label
                class="w-full h-[130px] border border-dashed border-black/20 rounded-[16px] flex flex-col items-center justify-center cursor-pointer bg-[#f7f7f7] hover:bg-[#efefef] transition">

                <img src="{{ asset('assets/images/Group.svg') }}" class="w-10 h-10 mb-2 opacity-60" alt="Upload Icon">

                <p id="sampleChangeImageLabel" class="text-[12px] text-black/40">Click to upload new logo</p>

                <input type="file" id="sampleChangeImage" accept="image/*" class="hidden">
            </label>
        </div>

        <div class="flex gap-4 mt-6">
            <button onclick="closeRequestPopup()"
                class="w-1/2 h-[44px] rounded-[10px] border border-black/30 text-[14px] text-black hover:bg-black hover:text-white transition">
                Cancel
            </button>

            <button id="submitSampleChangeBtn" onclick="submitSampleChangeRequest()"
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

document.getElementById('requestPopup').addEventListener('click', closeRequestPopup);

document.getElementById('sampleChangeImage').addEventListener('change', function () {
    document.getElementById('sampleChangeImageLabel').textContent = this.files[0] ? this.files[0].name : 'Click to upload new logo';
});

function submitSampleChangeRequest() {
    const errorEl = document.getElementById('requestPopupError');
    errorEl.classList.add('hidden');

    const description = document.getElementById('sampleChangeDescription').value.trim();
    if (!description) {
        errorEl.textContent = 'Please describe what needs to be changed.';
        errorEl.classList.remove('hidden');
        return;
    }

    const btn = document.getElementById('submitSampleChangeBtn');
    btn.disabled = true;
    showLoader();

    const formData = new FormData();
    formData.append('description', description);
    const image = document.getElementById('sampleChangeImage').files[0];
    if (image) formData.append('image', image);

    sendRequest('{{ route('order.sample.request_changes') }}', formData, 'POST', function (res) {
        hideLoader();
        btn.disabled = false;
        if (res.success) {
            showToast(res.message, 'success', 2500);
            closeRequestPopup();
            setTimeout(() => window.location.reload(), 800);
        } else {
            errorEl.textContent = res.message || 'Something went wrong.';
            errorEl.classList.remove('hidden');
        }
    }, function (err) {
        hideLoader();
        btn.disabled = false;
        errorEl.textContent = err.errors ? Object.values(err.errors)[0][0] : (err.message || 'Something went wrong.');
        errorEl.classList.remove('hidden');
    });
}
</script>

@endsection