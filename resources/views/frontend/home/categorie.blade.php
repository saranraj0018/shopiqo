<section class="relative bg-black text-white py-14 sm:py-16 lg:py-12 overflow-hidden">
    <!-- Mobile padding 25px -->
    <div class="relative max-w-6xl mx-auto px-14 sm:px-6 lg:px-8">
        <!-- Badge -->
        <div class="flex justify-center mb-5">
            <span
                class="inline-flex items-center px-4 py-1.5 rounded-full border border-white/10 bg-white/5 text-xs sm:text-sm text-white/80 backdrop-blur-sm">
                Popular categories
            </span>
        </div>
        <!-- Title -->
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
            <h2 class="text-[24px] sm:text-[30px] lg:text-[40px] font-medium leading-tight">
                Explore our most loved corporate gift categories
            </h2>
        </div>
        <!-- Grid FIXED -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($products as $item)
            @include('frontend.components.homeproductcard', ['item' => $item])
            @empty
            <p class="text-white/50 col-span-full text-center">No products available yet.</p>
            @endforelse
        </div>
        <!-- Button -->
        <div class="flex justify-center mt-10">
            <a href="/shop"
                class="inline-flex items-center justify-center px-5 py-2 rounded-full border border-white/20 text-sm text-white hover:bg-white hover:text-black transition">
                See more
            </a>
        </div>
    </div>
</section>
