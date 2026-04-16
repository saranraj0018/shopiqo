<div class="w-full bg-white rounded-[20px] overflow-hidden border border-black/10 shadow-sm">

    <!-- Image box -->
    <div class="relative bg-[#efefef] sm:h-[230px] md:h-[240px] lg:h-[222px] flex items-center justify-center">

        <!-- Badge -->
        @if(!empty($item['badge']))
        <img src="{{ asset($item['badge']) }}" alt="badge" class="absolute top-3 left-3 w-8 h-8 object-contain">
        @endif

        <!-- Wishlist -->
        @if(!empty($item['wishlist']))
        <button onclick="toggleHeart(this)"
            class="absolute top-3 right-3 w-9 h-9 rounded-full bg-black text-white flex items-center justify-center shadow-md transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current transition" viewBox="0 0 24 24">
                <path
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>

        </button>
        @endif

        <!-- Product image -->
        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="max-w-full max-h-full object-contain">
    </div>

    <!-- Content -->
    <div class="p-4 sm:p-5">
        <h3 class="text-[13px] sm:text-[14px] font-medium text-black leading-[1.4] line-clamp-2">
            {{ $item['title'] }}
        </h3>

        <p class="text-[12px] text-gray-500 mt-1 line-clamp-1">
            {{ $item['subtitle'] }}
        </p>

        <div class=" flex items-end justify-between gap-3">
            <div class="flex flex-wrap gap-3 items-end">
                <div class="flex items-end gap-1">
                    <span
                        class="text-[24px] sm:text-[26px] md:text-[28px] lg:text-[30px] font-semibold text-black leading-none">
                        ₹{{ $item['price'] }}
                    </span>
                    <span class="text-xs sm:text-sm text-gray-500 mb-[3px]">/piece</span>
                </div>

                <div class="flex items-center gap-1 mb-[3px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400 fill-current"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                    </svg>
                    <span class="text-sm text-black font-medium">{{ $item['rating'] }}</span>
                </div>
            </div>

            <a href="/shop/single-product"
                class="shrink-0 bg-[#1f1f1f] text-white text-xs sm:text-sm font-medium px-4 sm:px-5 py-2.5 rounded-full hover:bg-black transition">
                Customize
            </a>
        </div>
    </div>
</div>
<script>
function toggleHeart(btn) {
    const svg = btn.querySelector("svg");

    svg.classList.toggle("text-red-500");
    svg.classList.toggle("text-white");
}
</script>