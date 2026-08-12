@php
    if ($item->product_type === 'variant' || ($item->product_type === 'bulk' && $item->leastPricedVariant)) {
        $salePrice = $item->leastPricedVariant->sale_price;
        $regularPrice = $item->leastPricedVariant->regular_price;
    } else {
        $salePrice = $item->sale_price;
        $regularPrice = $item->regular_price;
    }

    $item->is_in_wishlist = auth()->check()
        ? auth()->user()->wishlists()->where('product_id', $item->id)->exists()
        : false;
@endphp
    <div
        class="w-full h-full bg-white rounded-[14px] overflow-hidden border border-black/10 shadow-sm flex flex-col cursor-pointer">
        <div class="relative bg-[#efefef] h-[200px] flex items-center justify-center">
            @if (!empty($item['badge']))
                <img src="{{ asset($item['badge']) }}" alt="badge" class="absolute top-3 left-3 w-8 h-8 object-contain">
            @endif
            <button
                class="heart-btn absolute top-3 right-3 w-9 h-9 rounded-full bg-black text-white flex items-center justify-center shadow-md transition"
                data-product-id="{{ $item->id }}" data-liked="{{ $item->is_in_wishlist ? 'true' : 'false' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current transition" viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                        fill="{{ $item->is_in_wishlist ? 'red' : 'white' }}" />
                </svg>
            </button>
            @if ($item->main_image)
                <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->name }}"
                    class="max-w-full max-h-full object-contain">
            @elseif($item->product_gallery_image->isNotEmpty())
                <img src="{{ asset($item->product_gallery_image->first()->image_path) }}" alt="{{ $item->name }}"
                    class="max-w-full max-h-full object-contain">
            @endif
        </div>
        <div class="p-3 flex flex-col justify-between flex-1">
            <div>
                <h3 class="text-[13px] sm:text-[14px] font-medium text-black leading-[1.4] line-clamp-2">
                    {{ $item['name'] }}
                </h3>
                <p class="text-[12px] text-gray-500 mt-1 line-clamp-1">
                    {{ $item['description'] }}
                </p>
                @php
                    $rating = number_format($item->reviews_avg_rating ?? 0, 1);
                @endphp
            </div>
            <div class="mt-3 flex items-start justify-between gap-2">
                <div class="flex flex-wrap gap-3 items-end">
                    <div class="flex items-end gap-1">
                        <span
                            class="text-[24px] sm:text-[22px] md:text-[20px] lg:text-[24px] font-semibold text-black leading-none">
                            ₹{{ $salePrice }}
                        </span>
                        {{-- <span class="text-xs text-gray-500">/piece</span> --}}
                    </div>
                    <div class="flex items-center gap-1 mb-[3px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400 fill-current"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <span class="text-sm text-black font-medium">{{ $rating }}
                            ({{ $item->reviews->count() }})</span>
                    </div>
                </div>
                @if (strtolower(trim($item['availability'])) === 'out-of-stock')
                    <span
                        class="shrink-0 h-[30px] px-4 rounded-full bg-gray-400 text-white text-[11px] font-medium flex items-center justify-center cursor-not-allowed">
                        Out of Stock
                    </span>
                @else
                    <a href="{{ route('shop.single-product', ['id' => encrypt($item->id)]) }}"
                        class="shrink-0 bg-[#1f1f1f] text-white text-xs sm:text-sm font-medium px-4 sm:px-5 py-2.5 rounded-full hover:bg-black transition">
                        Customize
                    </a>
                @endif
            </div>
        </div>
    </div>
    @include('frontend.components.product_script')
