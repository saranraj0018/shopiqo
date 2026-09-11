@php
    $initials = collect(explode(' ', $review->user->name))
        ->map(fn($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->implode('');
@endphp
<div
    class="h-[220px] rounded-[18px] border border-white/10 bg-white/[0.03] p-8 backdrop-blur-sm shadow-[0_0_30px_rgba(255,255,255,0.03)]">

    <div class="flex items-start justify-between gap-3 mb-4">
        <div class="flex gap-3 flex-col items-start">
            <div
                class="w-11 h-11 rounded-full border border-white/10 bg-white/10 flex items-center justify-center text-[13px] font-medium text-white uppercase">
                {{ $initials }}
            </div>

            <div class="flex gap-[15px] items-center">
                <h4 class="text-white text-[13px] font-medium leading-none">
                    {{ $review->user->name }}
                </h4>

                <div class="flex items-center gap-1 text-[12px] text-[#f6c344] shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M12 2l2.9 6.26 6.9.59-5.2 4.5 1.56 6.65L12 16.9 5.84 20l1.56-6.65-5.2-4.5 6.9-.59L12 2z" />
                    </svg>
                    <span>{{ $review->rating }}</span>
                </div>
            </div>
        </div>

    </div>

    <p class="text-white/55 text-[11px] leading-[1.55]">
        {{ $review->review }}
    </p>
</div>
