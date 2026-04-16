<div class="min-h-screen bg-black text-white px-8 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Title -->
        <h2 class="text-[24px] font-medium mb-8">Write a Review</h2>

        <div class="mb-8">
            <label class="block text-[15px] font-medium mb-3 text-white">Your Rating</label>

            <div class="flex items-center gap-2" id="ratingStars">
                @for($i = 1; $i <= 5; $i++) <button type="button" class="rating-star text-white/60 transition"
                    data-value="{{ $i }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-7 h-7 star-icon transition-all duration-200" fill="none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.386a.562.562 0 01-.840.610L12 17.770l-4.998 3.020a.562.562 0 01-.840-.610l1.285-5.386a.563.563 0 00-.182-.557L3.060 10.385a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.499z" />
                    </svg>
                    </button>
                    @endfor
            </div>

            <input type="hidden" name="rating" id="selectedRating" value="0">
        </div>


        <!-- Review -->
        <div class="mb-8">
            <label for="review" class="block text-[15px] font-medium mb-3">Your Review</label>

            <textarea id="review" maxlength="500" placeholder="Tell us about your experience with this product..."
                class="w-full h-[120px] rounded-[14px] border border-white/40 bg-black px-4 py-4 text-[14px] text-white placeholder:text-white/40 outline-none resize-none focus:border-white"></textarea>

            <p class="mt-2 text-[12px] text-white/70">0 / 500 characters</p>
        </div>

        <!-- Upload -->
        <div class="mb-8">
            <label class="block text-[15px] font-medium mb-3">Add Photos (Optional)</label>

            <label for="photoUpload"
                class="w-full min-h-[150px] rounded-[16px] border border-white/40 bg-black flex flex-col items-center justify-center text-center cursor-pointer hover:border-white transition px-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-8 h-8 text-white/80 mb-3">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                        d="M12 16V4m0 0l-4 4m4-4l4 4M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                </svg>

                <p class="text-[14px] text-white/90">Click to upload or drag and drop</p>
                <p class="mt-1 text-[12px] text-white/50">Max 3 images, JPG or PNG</p>

                <input id="photoUpload" type="file" accept="image/png, image/jpeg" multiple class="hidden">
            </label>
        </div>

        <!-- Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button type="button"
                class="h-[54px] rounded-[14px] border border-white/40 bg-black text-white text-[15px] font-medium hover:bg-white hover:text-black transition">
                Cancel
            </button>

            <button type="submit"
                class="h-[54px] rounded-[14px] bg-[#e5e5e5] text-black text-[15px] font-medium hover:bg-white transition">
                Submit Review
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const stars = document.querySelectorAll(".rating-star");
    const selectedRating = document.getElementById("selectedRating");

    let currentRating = 0;

    function updateStars(rating) {
        stars.forEach((star, index) => {
            const icon = star.querySelector(".star-icon");

            if (index < rating) {
                icon.setAttribute("fill", "#facc15"); // ⭐ GOLD
                star.classList.remove("text-white/40");
            } else {
                icon.setAttribute("fill", "none");
                star.classList.add("text-white/40");
            }
        });
    }

    // ⭐ CLICK (TOGGLE LOGIC)
    stars.forEach((star) => {
        star.addEventListener("click", function() {
            const value = parseInt(this.dataset.value);

            // 👉 TOGGLE
            if (currentRating === value) {
                currentRating = 0; // unselect
            } else {
                currentRating = value;
            }

            selectedRating.value = currentRating;
            updateStars(currentRating);
        });

        // ⭐ HOVER
        star.addEventListener("mouseenter", function() {
            const hoverValue = parseInt(this.dataset.value);
            updateStars(hoverValue);
        });
    });

    // ⭐ RESET AFTER HOVER
    document.getElementById("ratingStars").addEventListener("mouseleave", function() {
        updateStars(currentRating);
    });

    updateStars(0);
});
</script>