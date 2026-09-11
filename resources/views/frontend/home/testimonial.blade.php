    <section class="relative overflow-hidden bg-black py-16 sm:py-12 text-white">
        <!-- background glow -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_42%)]">
            </div>
            <div class="absolute inset-0 bg-[linear-gradient(to_bottom,rgba(255,255,255,0.02),rgba(0,0,0,1))]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-[25px] sm:px-6 lg:px-8">
            <!-- top badge -->
            <div class="flex justify-center mb-8 sm:mb-10">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-4 py-1.5 text-[11px] text-white/70 backdrop-blur-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
                    What people say
                </span>
            </div>

            @if ($testimonials->isNotEmpty())
            <!-- slider -->
            <div class="swiper testimonialSlider">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $review)
                    <div class="swiper-slide">
                        @include('frontend.components.testimonialcard', ['review' => $review])
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- arrows -->
            <div class="flex items-center justify-center gap-3 mt-8">
                <button type="button"
                    class="testimonial-prev w-9 h-9 rounded-full border border-white/10 bg-white/[0.03] flex items-center justify-center hover:bg-white/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button type="button"
                    class="testimonial-next w-9 h-9 rounded-full border border-white/10 bg-white/[0.03] flex items-center justify-center hover:bg-white/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </section>

    @if ($testimonials->isNotEmpty())
    <script>
document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".testimonialSlider", {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 1,
        slidesPerGroup: 1,
        speed: 800,
        navigation: {
            nextEl: ".testimonial-next",
            prevEl: ".testimonial-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                slidesPerGroup: 1
            },
            1024: {
                slidesPerView: 3,
                slidesPerGroup: 1
            }
        }
    });
});
    </script>
    @endif
