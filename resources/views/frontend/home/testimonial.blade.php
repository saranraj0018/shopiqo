<section class="relative overflow-hidden bg-black py-16 sm:py-12 text-white">
    <!-- background glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_42%)]">
        </div>
        <div class="absolute inset-0 bg-[linear-gradient(to_bottom,rgba(255,255,255,0.02),rgba(0,0,0,1))]"></div>
    </div>

    @php
    $testimonials = [
    [
    'name' => 'Avery F.',
    'rating' => '4.7',
    'image' => 'assets/images/home/testimonial/testimonial1.png',
    'message' => 'I was thoroughly impressed with the quality of the corporate gifts I ordered from this company. The
    embroidery details and packaging were excellent.',
    ],
    [
    'name' => 'Riley M.',
    'rating' => '4.2',
    'image' => 'assets/images/home/testimonial/testimonial2.png',
    'message' => 'I recently ordered a batch of customized journals for our team, and they turned out fantastic. The
    quality was superb and the customization was exactly what we wanted.',
    ],
    [
    'name' => 'Jordan M.',
    'rating' => '4.5',
    'image' => 'assets/images/home/testimonial/testimonial3.png',
    'message' => 'I have been using this company for all my corporate gift needs, and they never disappoint. The service
    is top-notch, highly recommended.',
    ],
    [
    'name' => 'Sophia K.',
    'rating' => '4.8',
    'image' => 'assets/images/home/testimonial/testimonial1.png',
    'message' => 'Beautiful presentation, smooth ordering process, and premium finishing. Everything looked exactly as
    expected and felt high quality.',
    ],
    [
    'name' => 'Noah T.',
    'rating' => '4.6',
    'image' => 'assets/images/home/testimonial/testimonial2.png',
    'message' => 'Fast delivery, clean branding, and great material quality. It matched the premium look we wanted for
    our company event.',
    ],
    [
    'name' => 'Emma J.',
    'rating' => '4.9',
    'image' => 'assets/images/home/testimonial/testimonial3.png',
    'message' => 'The support team was helpful from start to finish. Customization, delivery, and product quality were
    all handled really well.',
    ],
    ];
    @endphp

    <div class="relative max-w-7xl mx-auto px-[25px] sm:px-6 lg:px-8">
        <!-- top badge -->
        <div class="flex justify-center mb-8 sm:mb-10">
            <span
                class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-4 py-1.5 text-[11px] text-white/70 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
                What people say
            </span>
        </div>

        <!-- slider -->
        <div class="swiper testimonialSlider">
            <div class="swiper-wrapper">
                @foreach ($testimonials as $testimonial)
                <div class="swiper-slide">
                    @include('frontend.components.testimonialcard', ['testimonial' => $testimonial])
                </div>
                @endforeach
            </div>
        </div>

        <!-- arrows -->
        <div class="flex items-center justify-center gap-3 mt-8">
            <button type="button"
                class="testimonial-prev w-9 h-9 rounded-full border border-white/10 bg-white/[0.03] flex items-center justify-center hover:bg-white/10 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button type="button"
                class="testimonial-next w-9 h-9 rounded-full border border-white/10 bg-white/[0.03] flex items-center justify-center hover:bg-white/10 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white/80" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".testimonialSlider", {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 1,
        slidesPerGroup: 1, // one by one slide
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