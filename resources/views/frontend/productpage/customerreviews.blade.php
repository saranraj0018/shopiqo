<section class="w-full bg-black text-white py-8 sm:py-10">
    <div class="max-w-[1180px] mx-auto px-8 sm:px-6 lg:px-8">

        <style>
        .review-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .review-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .review-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 9999px;
        }
        </style>

        <div class="border-b border-white/10 mb-8">
            <div class="flex items-center gap-8 text-[11px] sm:text-[12px]">
                <button id="tabDescription" class="relative pb-3 text-white/60 hover:text-white transition">
                    Description
                    <span class="absolute left-0 bottom-0 h-[1px] w-0 bg-white transition-all duration-300"></span>
                </button>

                <button id="tabReviews" class="relative pb-3 text-white">
                    Customer Reviews
                    <span class="absolute left-0 bottom-0 h-[1px] w-full bg-white transition-all duration-300"></span>
                </button>
            </div>
        </div>

        <div id="descriptionContent" class="hidden">
            <div class="mx-auto space-y-3 text-white">

                <div class="rounded-[16px] border border-white/15 bg-[#050505] overflow-hidden">
                    <button type="button" onclick="toggleAccordion('acc1','icon1')"
                        class="w-full flex items-center justify-between px-4 py-4 text-left">
                        <span class="text-[13px] font-medium">Product Details</span>
                        <svg id="icon1" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 15l-6-6-6 6" />
                        </svg>
                    </button>

                    <div id="acc1"
                        class="accordion-content max-h-0 opacity-0 overflow-hidden transition-all duration-300 ease-in-out border-t-0">
                        <div class="px-4">
                            @if ($variantMatrix && $variantMatrix['cols']->first()->id !== 'default')
                            <div class="flex justify-between gap-4 py-4 border-b border-white/15">
                                <p class="text-[11px] text-white/70">Available Colors</p>
                                <p class="text-[11px] text-white/70 text-right lowercase">
                                    {{ $variantMatrix['cols']->pluck('value')->implode(', ') }}
                                </p>
                            </div>
                            @endif
                            @if ($variantMatrix)
                            <div class="flex justify-between gap-4 py-4 border-b border-white/15">
                                <p class="text-[11px] text-white/70">Available Sizes</p>
                                <p class="text-[11px] text-white/70 text-right uppercase">
                                    {{ $variantMatrix['rows']->pluck('value')->implode(', ') }}
                                </p>
                            </div>
                            @endif
                            <div class="flex justify-between gap-4 py-4 border-b border-white/15">
                                <p class="text-[11px] text-white/70">Minimum Order Quantity</p>
                                <p class="text-[11px] text-white/70 text-right">{{ $moq }} {{ Str::plural('unit', $moq) }}</p>
                            </div>
                            @if ($product->production_min_days || $product->production_max_days)
                            <div class="flex justify-between gap-4 py-4">
                                <p class="text-[11px] text-white/70">Production Time</p>
                                <p class="text-[11px] text-white/70 text-right">
                                    {{ $product->production_min_days ?? $product->production_max_days }}–{{ $product->production_max_days ?? $product->production_min_days }} days
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="rounded-[16px] border border-white/15 bg-[#050505] overflow-hidden">
                    <button type="button" onclick="toggleAccordion('acc2','icon2')"
                        class="w-full flex items-center justify-between px-4 py-4 text-left">
                        <span class="text-[13px] font-medium">Customization Options</span>
                        <svg id="icon2" xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 15l-6-6-6 6" />
                        </svg>
                    </button>

                    <div id="acc2"
                        class="accordion-content max-h-0 opacity-0 overflow-hidden transition-all duration-300 ease-in-out border-t-0">
                        <div class="px-4 py-4 space-y-4">
                            <div class="border-b border-white/15 pb-4">
                                <p class="text-[11px] text-white/50 mb-2">Logo Placement</p>
                                <p class="text-[11px] text-white/80">
                                    Fully adjustable — choose front, back, or both, then drag your logo anywhere on the
                                    product photo to set the exact spot.
                                </p>
                            </div>

                            <div class="border-b border-white/15 pb-4">
                                <p class="text-[11px] text-white/50 mb-2">Print Types</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($printTypes as $type)
                                    <span class="px-2.5 py-1 rounded-full bg-white/20 text-[10px]">{{ $type }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <p class="text-[11px] text-white/50 mb-2">Supported File Formats</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-2.5 py-1 rounded-full bg-white/20 text-[10px]">PNG</span>
                                    <span class="px-2.5 py-1 rounded-full bg-white/20 text-[10px]">JPG</span>
                                    <span class="px-2.5 py-1 rounded-full bg-white/20 text-[10px]">SVG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script>
            function toggleAccordion(contentId, iconId) {
                const allContents = document.querySelectorAll('.accordion-content');
                const allIcons = document.querySelectorAll('[id^="icon"]');

                allContents.forEach((item) => {
                    if (item.id !== contentId) {
                        item.classList.remove('max-h-[800px]', 'opacity-100', 'border-t', 'border-white/15');
                        item.classList.add('max-h-0', 'opacity-0', 'border-t-0');
                    }
                });

                allIcons.forEach((icon) => {
                    if (icon.id !== iconId) {
                        icon.classList.remove('rotate-180');
                    }
                });

                const content = document.getElementById(contentId);
                const icon = document.getElementById(iconId);
                const isOpen = content.classList.contains('max-h-[800px]');

                if (isOpen) {
                    content.classList.remove('max-h-[800px]', 'opacity-100', 'border-t', 'border-white/15');
                    content.classList.add('max-h-0', 'opacity-0', 'border-t-0');
                    icon.classList.remove('rotate-180');
                } else {
                    content.classList.remove('max-h-0', 'opacity-0', 'border-t-0');
                    content.classList.add('max-h-[800px]', 'opacity-100', 'border-t', 'border-white/15');
                    icon.classList.add('rotate-180');
                }
            }
            </script>
        </div>

        <div id="reviewContent">
            <div class="grid grid-cols-1 lg:grid-cols-[250px_minmax(0,1fr)] gap-10">

                <div>
                    <div class="flex items-end gap-2 leading-none">
                        <h2 class="text-[76px] sm:text-[90px] font-semibold tracking-[-4px] text-white">{{ $reviewStats['average'] }}</h2>
                        <span class="text-[22px] sm:text-[30px] text-white mb-2">/5</span>
                    </div>

                    <p class="text-[10px] text-white/45 mt-2">
                        ({{ $reviewStats['count'] }} {{ Str::plural('Review', $reviewStats['count']) }})
                    </p>

                    <div class="mt-7 space-y-4 w-[80%] sm:w-full">
                        @for ($star = 5; $star >= 1; $star--)
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-[4px] bg-white/15 rounded-full overflow-hidden">
                                <div class="h-full bg-white rounded-full" style="width: {{ $reviewStats['breakdown'][$star] }}%"></div>
                            </div>
                            <div class="w-[26px] text-[11px] text-white flex items-center gap-1">
                                <span class="text-[#f5c84c]">★</span>{{ $star }}
                            </div>
                        </div>
                        @endfor
                    </div>

                    @php $galleryImages = $approvedReviews->pluck('image')->filter()->take(3); @endphp
                    @if ($galleryImages->isNotEmpty())
                    <div class="flex gap-2 mt-7 flex-wrap">
                        @foreach ($galleryImages as $img)
                        <img src="{{ asset('storage/' . $img) }}" onclick="openImagePreview('{{ asset('storage/' . $img) }}')"
                            class="w-[58px] h-[58px] rounded-[10px] object-cover border border-white/10 bg-white/5 cursor-pointer">
                        @endforeach
                    </div>
                    @endif
                </div>

                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7">
                        <button onclick="openReviewModal()"
                            class="h-[34px] px-4 rounded-full bg-white text-black text-[11px] font-medium inline-flex items-center gap-2 hover:bg-white/90 transition w-fit">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Write a review
                        </button>

                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-white/60">Sort by</span>
                            <div class="relative">
                                <select id="reviewSort"
                                    class="appearance-none bg-black border border-white/15 rounded-full h-[34px] pl-4 pr-9 text-[11px] text-white outline-none">
                                    <option value="newest">Newest</option>
                                    <option value="oldest">Oldest</option>
                                    <option value="top">Top Rating</option>
                                </select>
                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-white/70 text-[10px] pointer-events-none">⌄</span>
                            </div>
                        </div>
                    </div>

                    <dialog id="reviewModal"
                        class="w-[85%] max-w-[500px] bg-white backdrop:bg-black/60 border rounded-[15px]">

                        <div class="relative bg-white px-4 sm:px-4 py-5 sm:py-4">
                            <button onclick="closeReviewModal()"
                                class="absolute top-4 right-4 text-black text-[26px] leading-none hover:opacity-70">
                                ×
                            </button>

                            <h3 class="text-[14px] sm:text-[18px] font-medium text-black mb-4">
                                Write a Review
                            </h3>

                            <input type="hidden" id="reviewProductId" value="{{ $product->id }}">

                            <div class="mb-4">
                                <label class="block text-[12px] sm:text-[14px] font-medium text-black mb-3">
                                    Your Rating <span class="text-red-500">*</span>
                                </label>

                                <div class="flex items-center gap-2" id="ratingStars">
                                    @for($i = 1; $i <= 5; $i++) <button type="button"
                                        class="rating-star text-gray-300 hover:text-yellow-400 transition"
                                        data-value="{{ $i }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.7" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.386a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 19.54a.562.562 0 01-.84-.61l1.285-5.386a.563.563 0 00-.182-.557L3.04 9.385a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345l2.125-5.111z" />
                                        </svg>
                                        </button>
                                        @endfor
                                </div>

                                <input type="hidden" id="selectedRating" value="">
                            </div>

                            <div class="mb-2">
                                <label class="block text-[14px] sm:text-[15px] font-medium text-black mb-3">
                                    Your Review <span class="text-red-500">*</span>
                                </label>

                                <textarea id="reviewText" maxlength="500"
                                    placeholder="Tell us about your experience with this product..."
                                    class="w-full h-[100px] sm:h-[90px] rounded-[16px] border border-gray-300 bg-white px-4 py-4 text-[12px] sm:h-[14px] text-black outline-none resize-none placeholder:text-gray-400"></textarea>

                                <p class="mt-2 text-[12px] text-gray-500">
                                    <span id="charCount">0</span> / 500 characters
                                </p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-[14px] sm:text-[15px] font-medium text-black mb-3">
                                    Add Photos (Optional)
                                </label>

                                <label for="reviewPhotos"
                                    class="w-full rounded-[16px] border border-gray-300 bg-white flex flex-col items-center justify-center text-center cursor-pointer py-[10px] px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400 mb-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 4v12m0-12l-4 4m4-4l4 4" />
                                    </svg>

                                    <p class="text-[12px] text-gray-600">
                                        Click to upload or drag and drop
                                    </p>

                                    <p class="text-[11px] text-gray-400">
                                        1 image, JPG or PNG (optional)
                                    </p>

                                    <input id="reviewPhotos" type="file" accept="image/png, image/jpeg"
                                        class="hidden">
                                </label>
                            </div>

                            <p id="reviewFormError" class="text-[12px] text-red-500 mb-3 hidden"></p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <button type="button" onclick="closeReviewModal()"
                                    class="h-[36px] rounded-[14px] border border-gray-300 bg-white text-black text-[12px] font-medium hover:bg-gray-50 transition">
                                    Cancel
                                </button>

                                <button type="button" id="submitReviewBtn"
                                    class="h-[36px] rounded-[14px] bg-black text-white text-[12px] font-medium hover:opacity-90 transition">
                                    Submit Review
                                </button>
                            </div>
                        </div>
                    </dialog>

                    <div id="reviewsList" class="space-y-8">
                        @forelse ($approvedReviews as $review)
                        @php
                            $reviewerName = $review->user->name ?? 'Anonymous';
                            $initials = collect(explode(' ', $reviewerName))
                                ->map(fn($part) => mb_substr($part, 0, 1))
                                ->take(2)
                                ->implode('');
                        @endphp
                        <div class="review-item hidden gap-3 sm:gap-4" data-rating="{{ $review->rating }}"
                            data-timestamp="{{ $review->created_at->timestamp }}">
                            <div class="shrink-0">
                                <div class="w-10 h-10 rounded-full border border-white/10 bg-white/10 flex items-center justify-center text-[11px] font-medium text-white uppercase">
                                    {{ $initials }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-[12px] font-medium text-white">
                                    {{ $reviewerName }}
                                </h4>

                                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1 mb-2">
                                    <div class="flex items-center gap-[2px] text-[#f5c84c] text-[11px]">
                                        @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'opacity-25' }}"></i>
                                        @endfor
                                    </div>

                                    <span class="text-white/45 text-[10px]">★</span>
                                    <span class="text-white/45 text-[10px]">{{ $review->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="text-[10px] sm:text-[11px] leading-[1.8] text-white/65 max-w-[860px]">
                                    {{ $review->review }}
                                </p>

                                @if ($review->image)
                                <div class="flex gap-2 mt-4 flex-wrap">
                                    <img src="{{ asset('storage/' . $review->image) }}"
                                        onclick="openImagePreview('{{ asset('storage/' . $review->image) }}')"
                                        class="w-[42px] h-[42px] rounded-md object-cover cursor-pointer border border-gray-700">
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p class="text-[12px] text-white/50">No reviews yet — be the first to review this product.</p>
                        @endforelse
                    </div>

                    <div id="previewModal"
                        class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-[9999] p-[30px] sm:p-0">

                        <button onclick="closePreview()"
                            class="absolute top-12 right-8 sm:top-5 sm:right-6 text-white text-3xl font-light hover:opacity-70">
                            ✕
                        </button>

                        <img id="previewImg" class="max-h-[85vh] max-w-[90%] object-contain">
                    </div>

                    <div id="reviewPagination"
                        class="flex items-center justify-center gap-3 mt-10 text-[14px] text-white/70 flex-wrap">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
const tabDescription = document.getElementById('tabDescription');
const tabReviews = document.getElementById('tabReviews');
const descriptionContent = document.getElementById('descriptionContent');
const reviewContent = document.getElementById('reviewContent');

const stars = document.querySelectorAll('.rating-star');
const selectedRating = document.getElementById('selectedRating');

function activateTab(type) {
    if (type === 'description') {
        descriptionContent.classList.remove('hidden');
        reviewContent.classList.add('hidden');

        tabDescription.classList.remove('text-white/60');
        tabDescription.classList.add('text-white');
        tabDescription.querySelector('span').classList.remove('w-0');
        tabDescription.querySelector('span').classList.add('w-full');

        tabReviews.classList.remove('text-white');
        tabReviews.classList.add('text-white/60');
        tabReviews.querySelector('span').classList.remove('w-full');
        tabReviews.querySelector('span').classList.add('w-0');
    } else {
        reviewContent.classList.remove('hidden');
        descriptionContent.classList.add('hidden');

        tabReviews.classList.remove('text-white/60');
        tabReviews.classList.add('text-white');
        tabReviews.querySelector('span').classList.remove('w-0');
        tabReviews.querySelector('span').classList.add('w-full');

        tabDescription.classList.remove('text-white');
        tabDescription.classList.add('text-white/60');
        tabDescription.querySelector('span').classList.remove('w-full');
        tabDescription.querySelector('span').classList.add('w-0');
    }
}

tabDescription.addEventListener('click', function() {
    activateTab('description');
});

tabReviews.addEventListener('click', function() {
    activateTab('reviews');
});

function openImagePreview(src) {
    const modal = document.getElementById('previewModal');
    const img = document.getElementById('previewImg');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closePreview() {
    const modal = document.getElementById('previewModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

document.getElementById('previewModal').addEventListener('click', function(e) {
    if (e.target.id === 'previewModal') {
        closePreview();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePreview();
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 3;
    const reviewsList = document.getElementById('reviewsList');
    const paginationContainer = document.getElementById('reviewPagination');
    let reviewItems = document.querySelectorAll('.review-item');

    if (!reviewItems.length || !paginationContainer) return;

    const totalPages = Math.ceil(reviewItems.length / itemsPerPage);
    let currentPage = 1;

    // Reorders the actual DOM nodes (server already renders them newest-first),
    // then re-reads the NodeList so pagination reflects the new order.
    const sortSelect = document.getElementById('reviewSort');
    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            const mode = this.value;
            const sorted = Array.from(reviewItems).sort(function (a, b) {
                if (mode === 'top') return b.dataset.rating - a.dataset.rating;
                if (mode === 'oldest') return a.dataset.timestamp - b.dataset.timestamp;
                return b.dataset.timestamp - a.dataset.timestamp; // newest
            });
            sorted.forEach(function (item) { reviewsList.appendChild(item); });
            reviewItems = document.querySelectorAll('.review-item');
            showPage(1, false);
        });
    }

    function showPage(page, shouldScroll = false) {
        currentPage = page;

        reviewItems.forEach((item, index) => {
            const start = (page - 1) * itemsPerPage;
            const end = page * itemsPerPage;

            if (index >= start && index < end) {
                item.classList.remove('hidden');
                item.classList.add('flex');
            } else {
                item.classList.add('hidden');
                item.classList.remove('flex');
            }
        });

        renderPagination();

        if (shouldScroll) {
            const reviewSection = document.getElementById('reviewContent');
            if (reviewSection) {
                reviewSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    }

    function createButton(label, onClick, isActive = false, isDisabled = false) {
        const btn = document.createElement('button');
        btn.innerHTML = label;
        btn.disabled = isDisabled;
        btn.onclick = onClick;

        if (isActive) {
            btn.className =
                'w-8 h-8 rounded-full bg-white text-black font-medium flex items-center justify-center';
        } else {
            btn.className = 'hover:text-white transition disabled:opacity-30 disabled:cursor-not-allowed';
        }

        return btn;
    }

    function createDots() {
        const span = document.createElement('span');
        span.textContent = '...';
        span.className = 'text-white/50';
        return span;
    }

    function getPaginationPages(totalPages, currentPage) {
        const pages = [];

        if (totalPages <= 8) {
            for (let i = 1; i <= totalPages; i++) {
                pages.push(i);
            }
        } else {
            if (currentPage <= 3) {
                pages.push(1, 2, 3, '...', totalPages - 1, totalPages);
            } else if (currentPage >= totalPages - 2) {
                pages.push(1, 2, '...', totalPages - 2, totalPages - 1, totalPages);
            } else {
                pages.push(1, 2, '...', currentPage, currentPage + 1, '...', totalPages - 1, totalPages);
            }
        }

        return [...new Set(pages)];
    }

    function renderPagination() {
        paginationContainer.innerHTML = '';

        paginationContainer.appendChild(
            createButton('‹', () => {
                if (currentPage > 1) showPage(currentPage - 1, true);
            }, false, currentPage === 1)
        );

        const pages = getPaginationPages(totalPages, currentPage);

        pages.forEach(page => {
            if (page === '...') {
                paginationContainer.appendChild(createDots());
            } else {
                paginationContainer.appendChild(
                    createButton(page, () => showPage(page, true), page === currentPage)
                );
            }
        });

        paginationContainer.appendChild(
            createButton('›', () => {
                if (currentPage < totalPages) showPage(currentPage + 1, true);
            }, false, currentPage === totalPages)
        );
    }

    showPage(1, false);
});
</script>

<script>
function openReviewModal() {
    document.getElementById('reviewModal').showModal();
}

function closeReviewModal() {
    document.getElementById('reviewModal').close();
}

stars.forEach((star, index) => {
    star.addEventListener('click', function() {
        const value = parseInt(this.getAttribute('data-value'));
        selectedRating.value = value;

        stars.forEach((s, i) => {
            const svg = s.querySelector('svg');

            if (i < value) {
                s.classList.add('text-yellow-400');
                s.classList.remove('text-gray-300');
                svg.setAttribute('fill', 'currentColor');
            } else {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
                svg.setAttribute('fill', 'none');
            }
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const submitBtn = document.getElementById('submitReviewBtn');
    if (!submitBtn) return;

    const errorEl = document.getElementById('reviewFormError');

    submitBtn.addEventListener('click', function () {
        errorEl.classList.add('hidden');

        const productId = document.getElementById('reviewProductId').value;
        const rating = document.getElementById('selectedRating').value;
        const text = document.getElementById('reviewText').value.trim();
        const photoInput = document.getElementById('reviewPhotos');

        if (!rating) {
            errorEl.textContent = 'Please select a rating.';
            errorEl.classList.remove('hidden');
            return;
        }
        if (!text) {
            errorEl.textContent = 'Please write your review.';
            errorEl.classList.remove('hidden');
            return;
        }

        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('rating', rating);
        formData.append('review', text);
        if (photoInput.files && photoInput.files[0]) {
            formData.append('image', photoInput.files[0]);
        }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
        showLoader();

        sendRequest('/product/review', formData, 'POST', function (res) {
            hideLoader();
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Review';

            if (res.status === 'unauthenticated') {
                showToast('Please sign in to write a review.', 'error', 2500);
                return;
            }
            if (res.status === 'saved') {
                showToast('Review submitted — thank you!', 'success', 2000);
                setTimeout(function () { window.location.reload(); }, 700);
            }
        }, function (err) {
            hideLoader();
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Review';
            if (err.errors) {
                const firstError = Object.values(err.errors)[0][0];
                errorEl.textContent = firstError;
                errorEl.classList.remove('hidden');
            } else {
                showToast(err.message || 'Something went wrong.', 'error', 2000);
            }
        });
    });
});
</script>