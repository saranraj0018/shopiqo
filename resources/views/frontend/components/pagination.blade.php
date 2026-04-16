@if ($paginator->hasPages())
    <div class="flex items-center justify-center gap-2 mt-10 mb-5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-[36px] h-[36px] flex items-center justify-center rounded-md border border-white/20 text-white/30 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-[36px] h-[36px] flex items-center justify-center rounded-md border border-white/20 text-white/70 hover:bg-white hover:text-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-[36px] h-[36px] flex items-center justify-center text-white/50 text-sm">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-[36px] h-[36px] flex items-center justify-center rounded-md bg-white text-black font-medium text-sm">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-[36px] h-[36px] flex items-center justify-center rounded-md border border-white/20 text-white/70 hover:bg-white hover:text-black transition-colors text-sm">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-[36px] h-[36px] flex items-center justify-center rounded-md border border-white/20 text-white/70 hover:bg-white hover:text-black transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        @else
            <span class="w-[36px] h-[36px] flex items-center justify-center rounded-md border border-white/20 text-white/30 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </span>
        @endif
    </div>
@endif
