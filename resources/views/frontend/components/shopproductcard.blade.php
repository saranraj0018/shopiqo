<a href="/shop/single-product" class="block w-full h-full">

    <div
        class="w-full h-full bg-white rounded-[14px] overflow-hidden border border-black/10 shadow-sm flex flex-col cursor-pointer">

        <div class="relative bg-[#efefef] h-[200px] flex items-center justify-center">

            @if(!empty($item['badge']))
            <img src="{{ asset($item['badge']) }}" alt="badge"
                class="absolute top-3 left-3 w-8 h-8 object-contain z-10">
            @endif

            @if(!empty($item['wishlist']))
            <button type="button" onclick="event.stopPropagation(); event.preventDefault(); toggleHeart(this)"
                class="absolute top-3 right-3 w-8 h-8 rounded-full bg-[#1f1f1f] flex items-center justify-center shadow-md z-10">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 fill-current text-white transition duration-300 heart-icon" viewBox="0 0 24 24">
                    <path
                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </button>
            @endif

            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
        </div>

        <div class="p-3 flex flex-col justify-between flex-1">

            <div>
                <h3 class="text-[12.5px] leading-[1.25] font-medium text-black line-clamp-2">
                    {{ $item['title'] }}
                </h3>

                <p class="mt-1 text-[12px] leading-[1.25] text-black/75 line-clamp-1">
                    {{ $item['subtitle'] }}
                </p>
            </div>

            <div class="mt-3 flex items-start justify-between gap-2">

                <div class="flex flex-wrap gap-3 items-end">

                    <div class="flex items-end gap-1">
                        <span class="text-[20px] font-semibold text-black leading-none">
                            ₹{{ $item['price'] }}
                        </span>
                        <span class="text-xs text-gray-500">/piece</span>
                    </div>

                    <div class="flex items-center gap-1 mb-[3px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400 fill-current"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <span class="text-sm text-black font-medium">
                            {{ $item['rating'] }}
                        </span>
                    </div>

                </div>

                @if(strtolower(trim($item['availability'])) === 'out-of-stock')
                <span
                    class="shrink-0 h-[30px] px-4 rounded-full bg-gray-400 text-white text-[11px] font-medium flex items-center justify-center cursor-not-allowed">
                    Out of Stock
                </span>
                @else
                <span
                    class="shrink-0 h-[30px] px-4 rounded-full bg-[#1f1f1f] text-white text-[11px] font-medium flex items-center justify-center">
                    Customize
                </span>
                @endif

            </div>
        </div>

    </div>

</a>