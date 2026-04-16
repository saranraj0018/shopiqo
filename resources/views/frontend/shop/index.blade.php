@extends('frontend.app')

@section('content')

@php
$products = [

['image'=>'assets/images/categoriecard/categorie.png','title'=>'T-Shirt Unisex','subtitle'=>'Cotton
T-Shirt','price'=>'120','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Apparel','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie1.png','title'=>'Steel Bottle','subtitle'=>'Premium
Bottle','price'=>'250','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bottles','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie2.png','title'=>'Gift Bag','subtitle'=>'Custom
Bag','price'=>'180','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bags','availability'=>'out-of-stock','print_capability'=>['Screen
Print'],'production_time'=>'7+ days'],

['image'=>'assets/images/categoriecard/categorie3.png','title'=>'Pen Set','subtitle'=>'Laser
Pen','price'=>'90','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Pens','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie4.png','title'=>'Notebook','subtitle'=>'Office
Notebook','price'=>'60','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Stationery','availability'=>'In-stock','print_capability'=>['UV
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie5.png','title'=>'Wireless Mouse','subtitle'=>'Tech
Mouse','price'=>'499','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Tech
Gifts','availability'=>'out-of-stock','print_capability'=>['UV Print'],'production_time'=>'7+ days'],

['image'=>'assets/images/categoriecard/categorie.png','title'=>'Hoodie','subtitle'=>'Printed
Hoodie','price'=>'799','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Apparel','availability'=>'In-stock','print_capability'=>['Embroidery'],'production_time'=>'3-7
days'],

['image'=>'assets/images/categoriecard/categorie1.png','title'=>'Sipper Bottle','subtitle'=>'Custom
Bottle','price'=>'220','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bottles','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie2.png','title'=>'Laptop Bag','subtitle'=>'Business
Bag','price'=>'350','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bags','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie3.png','title'=>'Blue Pen','subtitle'=>'Promo
Pen','price'=>'40','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Pens','availability'=>'out-of-stock','print_capability'=>['Laser'],'production_time'=>'7+
days'],

['image'=>'assets/images/categoriecard/categorie4.png','title'=>'Desk
Calendar','subtitle'=>'Stationery','price'=>'110','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Stationery','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'1-3 days'],

['image'=>'assets/images/categoriecard/categorie5.png','title'=>'Bluetooth Speaker','subtitle'=>'Tech
Gift','price'=>'950','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Tech
Gifts','availability'=>'In-stock','print_capability'=>['UV Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie.png','title'=>'Round Neck T-Shirt','subtitle'=>'Cotton
Wear','price'=>'140','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Apparel','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie1.png','title'=>'Thermal Bottle','subtitle'=>'Hot/Cold
Bottle','price'=>'300','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bottles','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie2.png','title'=>'Carry Bag','subtitle'=>'Reusable
Bag','price'=>'150','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bags','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie3.png','title'=>'Black Pen','subtitle'=>'Office
Pen','price'=>'50','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Pens','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie4.png','title'=>'Diary','subtitle'=>'Personal
Diary','price'=>'130','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Stationery','availability'=>'out-of-stock','print_capability'=>['UV
Print'],'production_time'=>'7+ days'],

['image'=>'assets/images/categoriecard/categorie5.png','title'=>'Power Bank','subtitle'=>'Tech
Accessory','price'=>'1200','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Tech
Gifts','availability'=>'In-stock','print_capability'=>['UV Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie.png','title'=>'Sweatshirt','subtitle'=>'Winter
Wear','price'=>'650','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Apparel','availability'=>'In-stock','print_capability'=>['Embroidery'],'production_time'=>'3-7
days'],

['image'=>'assets/images/categoriecard/categorie1.png','title'=>'Plastic Bottle','subtitle'=>'Gym
Bottle','price'=>'180','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bottles','availability'=>'out-of-stock','print_capability'=>['Laser'],'production_time'=>'7+
days'],

['image'=>'assets/images/categoriecard/categorie2.png','title'=>'Office Bag','subtitle'=>'Laptop
Carry','price'=>'500','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bags','availability'=>'In-stock','print_capability'=>['Screen
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie3.png','title'=>'Gel Pen','subtitle'=>'Smooth
Writing','price'=>'30','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Pens','availability'=>'In-stock','print_capability'=>['Laser'],'production_time'=>'1-3
days'],

['image'=>'assets/images/categoriecard/categorie4.png','title'=>'Sticky Notes','subtitle'=>'Office
Use','price'=>'70','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Stationery','availability'=>'In-stock','print_capability'=>['UV
Print'],'production_time'=>'3-7 days'],

['image'=>'assets/images/categoriecard/categorie5.png','title'=>'USB Drive','subtitle'=>'Corporate
Gift','price'=>'350','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Tech
Gifts','availability'=>'In-stock','print_capability'=>['UV Print'],'production_time'=>'1-3 days'],

['image'=>'assets/images/categoriecard/categorie2.png','title'=>'Gift Bag','subtitle'=>'Custom
Bag','price'=>'180','rating'=>'4.5','badge'=>null,'wishlist'=>true,'category'=>'Bags','availability'=>'out-of-stock','print_capability'=>['Screen
Print'],'production_time'=>'7+ days'],

];
@endphp

<section
    class="bg-black min-h-screen text-white px-[25px] lg:px-[25px] pb-8 pt-[110px] md:pt-[130px] lg:pt-[140px] overflow-hidden">
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-5 lg:gap-6">

        <!-- Mobile Filter Button -->
        <div class="lg:hidden">
            <button id="openFilterDrawer" type="button"
                class="h-[46px] rounded-[15px] mt-[20px] lg:mt-0 border border-white/15 bg-[#0d0d0d] px-4 flex items-center justify-center gap-2 text-[14px] font-medium text-white width-[30%]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18m-15 7h12m-9 7h6" />
                </svg>
                <span>Filter</span>
            </button>
        </div>

        <!-- Mobile Overlay -->
        <div id="filterOverlay"
            class="fixed inset-0 bg-black/60 z-[9998] opacity-0 invisible transition-all duration-300 lg:hidden"></div>

        <!-- Left Filter -->
        <div id="filterDrawer"
            class="fixed top-0 left-0 h-full w-full max-w-full z-[9999] -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:static lg:h-auto lg:w-[20%] lg:max-w-none lg:z-auto shrink-0">
            <div
                class="h-full overflow-y-auto bg-black backdrop-blur-lg border border-white/10 lg:bg-transparent pt-[24px] pb-[24px] pr-[18px] pl-[25px] lg:p-0">
                <div class="flex items-center justify-between mb-4 lg:hidden">
                    <h2 class="text-[18px] font-medium text-white">Filters</h2>
                    <button id="closeFilterDrawer" type="button"
                        class="w-9 h-9 rounded-full border border-white/15 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div>
                    @include('frontend.shop.shopfilter')
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="w-full lg:w-[80%]">
            <div class="mb-4">
                <div
                    class="h-[44px] sm:h-[46px] rounded-full border border-white/10 bg-[#0d0d0d] px-4 flex items-center">
                    <input type="text" id="keywordFilter" placeholder="Search"
                        class="w-full bg-transparent outline-none text-[13px] sm:text-sm text-white placeholder:text-white/40">
                </div>
            </div>

            <p id="resultsCount" class="text-[13px] sm:text-[14px] text-white/70 mb-3 px-[15px] lg:px-0">
                Showing 0 Results
            </p>

            <div id="activeFiltersWrapper" class="flex flex-wrap items-center sm:items-center gap-2 mb-5 hidden">
                <span class="text-[13px] sm:text-[14px] text-white/70">Active Filters</span>
                <div id="activeFilters" class="flex items-center gap-2 flex-wrap"></div>
                <button type="button" id="clearAllFilters" class="text-[12px] underline text-white/80">
                    Clear All
                </button>
            </div>

            <div id="productGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-4 px-[30px] lg:px-0">
                @foreach ($products as $product)
                <div class="product-item h-auto min-h-[300px]" data-title="{{ strtolower($product['title']) }}"
                    data-subtitle="{{ strtolower($product['subtitle']) }}"
                    data-category="{{ strtolower($product['category']) }}"
                    data-availability="{{ strtolower($product['availability']) }}"
                    data-print="{{ strtolower(implode(',', $product['print_capability'])) }}"
                    data-time="{{ strtolower($product['production_time']) }}" data-price="{{ $product['price'] }}">
                    @include('frontend.components.shopproductcard', ['item' => $product])
                </div>
                @endforeach
            </div>

            <div id="noProductsMessage" class="hidden text-center">

                <!-- Image -->
                <img src="{{ asset('assets/images/ordericons/nomacthing.png') }}"
                    class="w-[80%] sm:w-[50%] md:w-[50%] mx-auto object-contain">

                <!-- Title -->
                <h2 class="text-white text-[18px] sm:text-[20px] font-semibold mb-2">
                    No matching search result
                </h2>

                <!-- Subtitle -->
                <p class="text-white/50 text-[13px] sm:text-[14px] mb-6">
                    Try again using more general search terms
                </p>

                <!-- Button -->
                <!-- <button onclick="clearFilters()"
                    class="px-6 h-[42px] rounded-full bg-white text-black text-[14px] font-medium hover:bg-white/90 transition">
                    Clear All Filters
                </button> -->

            </div>

            <div id="pagination" class="flex justify-center flex-wrap mt-8 sm:mt-10 gap-2"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const keywordInput = document.getElementById("keywordFilter");
    const allProducts = Array.from(document.querySelectorAll(".product-item"));
    const pagination = document.getElementById("pagination");
    const resultsCount = document.getElementById("resultsCount");
    const noProductsMessage = document.getElementById("noProductsMessage");
    const activeFiltersWrapper = document.getElementById("activeFiltersWrapper");
    const activeFilters = document.getElementById("activeFilters");
    const clearAllFiltersBtn = document.getElementById("clearAllFilters");

    const categoryFilters = document.querySelectorAll(".filter-category");
    const availabilityFilters = document.querySelectorAll(".filter-availability");
    const printFilters = document.querySelectorAll(".filter-print");
    const timeFilters = document.querySelectorAll(".filter-time");
    const topCategoryFilters = document.querySelectorAll(".top-category-filter");

    const minRange = document.getElementById("minRange");
    const maxRange = document.getElementById("maxRange");
    const minTooltip = document.getElementById("minTooltip");
    const maxTooltip = document.getElementById("maxTooltip");
    const minPriceText = document.getElementById("minPrice");
    const maxPriceText = document.getElementById("maxPrice");
    const rangeTrack = document.getElementById("rangeTrack");

    const filterDrawer = document.getElementById("filterDrawer");
    const filterOverlay = document.getElementById("filterOverlay");
    const openFilterDrawer = document.getElementById("openFilterDrawer");
    const closeFilterDrawer = document.getElementById("closeFilterDrawer");

    let itemsPerPage = window.innerWidth < 1024 ? 8 : 9;
    let currentPage = 1;
    let filteredProducts = [...allProducts];
    let topNavCategory = "";

    const urlParams = new URLSearchParams(window.location.search);
    const categoryFromUrl = urlParams.get("category");

    if (categoryFromUrl && categoryFromUrl !== "all") {
        topNavCategory = categoryFromUrl.toLowerCase();
    }

    function openDrawer() {
        if (window.innerWidth < 1024) {
            filterDrawer.classList.remove("-translate-x-full");
            filterOverlay.classList.remove("opacity-0", "invisible");
            filterOverlay.classList.add("opacity-100", "visible");
            document.body.classList.add("overflow-hidden");
        }
    }

    function closeDrawerFn() {
        if (window.innerWidth < 1024) {
            filterDrawer.classList.add("-translate-x-full");
            filterOverlay.classList.add("opacity-0", "invisible");
            filterOverlay.classList.remove("opacity-100", "visible");
            document.body.classList.remove("overflow-hidden");
        }
    }

    if (openFilterDrawer) {
        openFilterDrawer.addEventListener("click", openDrawer);
    }

    if (closeFilterDrawer) {
        closeFilterDrawer.addEventListener("click", closeDrawerFn);
    }

    if (filterOverlay) {
        filterOverlay.addEventListener("click", closeDrawerFn);
    }

    function updateItemsPerPage() {
        itemsPerPage = window.innerWidth < 1024 ? 6 : 9;
        currentPage = 1;
        renderPage();

        if (window.innerWidth >= 1024) {
            document.body.classList.remove("overflow-hidden");
            filterOverlay.classList.add("opacity-0", "invisible");
            filterOverlay.classList.remove("opacity-100", "visible");
            filterDrawer.classList.remove("-translate-x-full");
        } else {
            filterDrawer.classList.add("-translate-x-full");
        }
    }

    function getCheckedValues(elements) {
        let values = [];
        elements.forEach((item) => {
            if (item.checked) {
                values.push(item.value.toLowerCase());
            }
        });
        return values;
    }

    function createFilterTag(text, inputElement, type = "") {
        const tag = document.createElement("span");
        tag.className = "px-3 h-[28px] rounded-full bg-white text-black text-[12px] flex items-center gap-2";
        tag.innerHTML = `${text}<button type="button" class="font-medium">×</button>`;

        tag.querySelector("button").addEventListener("click", function() {
            if (type === "top-nav") {
                topNavCategory = "";
                topCategoryFilters.forEach((item) => item.classList.remove("active-top-filter"));
                const allFilter = document.querySelector('.top-category-filter[data-filter="all"]');
                if (allFilter) {
                    allFilter.classList.add("active-top-filter");
                }
                filterProducts();
                return;
            }

            if (type === "price") {
                minRange.value = minRange.min;
                maxRange.value = maxRange.max;
                updateRangeUI();
                filterProducts();
                return;
            }

            if (inputElement) {
                inputElement.checked = false;
                filterProducts();
            } else {
                keywordInput.value = "";
                filterProducts();
            }
        });

        activeFilters.appendChild(tag);
    }

    function updateRangeUI() {
        let minVal = parseInt(minRange.value);
        let maxVal = parseInt(maxRange.value);

        if (minVal > maxVal) {
            [minVal, maxVal] = [maxVal, minVal];
        }

        const min = parseInt(minRange.min);
        const max = parseInt(minRange.max);

        const percentMin = ((minVal - min) / (max - min)) * 100;
        const percentMax = ((maxVal - min) / (max - min)) * 100;

        rangeTrack.style.left = percentMin + "%";
        rangeTrack.style.width = (percentMax - percentMin) + "%";

        minTooltip.innerText = `₹${minVal}`;
        maxTooltip.innerText = `₹${maxVal}`;

        minTooltip.style.left = `calc(${percentMin}% - 16px)`;
        maxTooltip.style.left = `calc(${percentMax}% - 16px)`;

        minPriceText.innerText = `₹${minVal}`;
        maxPriceText.innerText = `₹${maxVal}`;
    }

    function updateActiveFilters(keyword, selectedCategories, selectedAvailability, selectedPrint,
        selectedTime) {
        activeFilters.innerHTML = "";

        if (keyword !== "") {
            createFilterTag(keyword, null);
        }

        if (topNavCategory !== "") {
            const activeTopLink = document.querySelector(
                `.top-category-filter[data-filter="${topNavCategory}"] span`);
            const topFilterText = activeTopLink ? activeTopLink.textContent.trim() : topNavCategory;
            createFilterTag(topFilterText, null, "top-nav");
        }

        categoryFilters.forEach((item) => {
            if (item.checked) createFilterTag(item.value, item);
        });

        availabilityFilters.forEach((item) => {
            if (item.checked) createFilterTag(item.value, item);
        });

        printFilters.forEach((item) => {
            if (item.checked) createFilterTag(item.value, item);
        });

        timeFilters.forEach((item) => {
            if (item.checked) createFilterTag(item.value, item);
        });

        const minVal = parseInt(minRange.value);
        const maxVal = parseInt(maxRange.value);
        const defaultMin = parseInt(minRange.min);
        const defaultMax = parseInt(maxRange.max);

        if (minVal !== defaultMin || maxVal !== defaultMax) {
            createFilterTag(`₹${minVal} - ₹${maxVal}`, null, "price");
        }

        const hasFilters =
            keyword !== "" ||
            topNavCategory !== "" ||
            selectedCategories.length > 0 ||
            selectedAvailability.length > 0 ||
            selectedPrint.length > 0 ||
            selectedTime.length > 0 ||
            minVal !== defaultMin ||
            maxVal !== defaultMax;

        if (hasFilters) {
            activeFiltersWrapper.classList.remove("hidden");
        } else {
            activeFiltersWrapper.classList.add("hidden");
        }
    }

    function filterProducts() {
        const keyword = keywordInput.value.toLowerCase().trim();
        const selectedCategories = getCheckedValues(categoryFilters);
        const selectedAvailability = getCheckedValues(availabilityFilters);
        const selectedPrint = getCheckedValues(printFilters);
        const selectedTime = getCheckedValues(timeFilters);
        const minVal = parseInt(minRange.value);
        const maxVal = parseInt(maxRange.value);

        filteredProducts = allProducts.filter((card) => {
            const title = card.dataset.title || "";
            const subtitle = card.dataset.subtitle || "";
            const category = card.dataset.category || "";
            const availability = card.dataset.availability || "";
            const print = card.dataset.print || "";
            const time = card.dataset.time || "";
            const price = parseFloat(card.dataset.price) || 0;

            const keywordMatch =
                keyword === "" ||
                title.includes(keyword) ||
                subtitle.includes(keyword) ||
                category.includes(keyword) ||
                availability.includes(keyword) ||
                print.includes(keyword) ||
                time.includes(keyword);

            const topNavMatch =
                topNavCategory === "" ||
                category === topNavCategory;

            const categoryMatch =
                selectedCategories.length === 0 || selectedCategories.includes(category);

            const availabilityMatch =
                selectedAvailability.length === 0 || selectedAvailability.includes(availability);

            const timeMatch =
                selectedTime.length === 0 || selectedTime.includes(time);

            const priceMatch =
                price >= Math.min(minVal, maxVal) &&
                price <= Math.max(minVal, maxVal);

            let printMatch = true;
            if (selectedPrint.length > 0) {
                printMatch = selectedPrint.some((item) => print.includes(item));
            }

            return keywordMatch && topNavMatch && categoryMatch && availabilityMatch && printMatch &&
                timeMatch && priceMatch;
        });

        currentPage = 1;
        updateActiveFilters(keyword, selectedCategories, selectedAvailability, selectedPrint, selectedTime);
        renderPage();
    }

    function renderPage() {
        allProducts.forEach((item) => {
            item.style.display = "none";
        });

        const totalResults = filteredProducts.length;
        const totalPages = Math.ceil(totalResults / itemsPerPage);

        resultsCount.innerText = `Showing ${totalResults} Results`;

        if (totalResults === 0) {
            noProductsMessage.classList.remove("hidden");
            pagination.innerHTML = "";
            return;
        } else {
            noProductsMessage.classList.add("hidden");
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        filteredProducts.slice(start, end).forEach((item) => {
            item.style.display = "block";
        });

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        pagination.innerHTML = "";

        if (totalPages <= 1) return;

        function createArrow(direction, disabled) {
            const el = document.createElement(disabled ? "span" : "button");

            el.className = `
                w-8 h-8 flex items-center justify-center rounded-full
                ${disabled ? "text-white/30" : "text-white hover:bg-white/10"}
            `;

            el.innerHTML =
                direction === "prev" ?
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>` :
                `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>`;

            if (!disabled) {
                el.onclick = () => {
                    currentPage += direction === "prev" ? -1 : 1;
                    renderPage();
                    window.scrollTo({
                        top: document.getElementById("productGrid").offsetTop - 120,
                        behavior: "smooth"
                    });
                };
            }

            pagination.appendChild(el);
        }

        function pageBtn(i) {
            const btn = document.createElement("button");
            btn.innerText = i;

            btn.className = `
                w-8 h-8 flex items-center justify-center rounded-full text-sm
                ${i === currentPage ? "bg-white text-black font-medium" : "text-white hover:bg-white/10"}
            `;

            btn.onclick = () => {
                currentPage = i;
                renderPage();
                window.scrollTo({
                    top: document.getElementById("productGrid").offsetTop - 120,
                    behavior: "smooth"
                });
            };

            pagination.appendChild(btn);
        }

        function dots() {
            const span = document.createElement("span");
            span.innerText = "...";
            span.className = "px-1 text-white/70 flex items-center";
            pagination.appendChild(span);
        }

        createArrow("prev", currentPage === 1);

        if (totalPages <= 7) {
            for (let i = 1; i <= totalPages; i++) {
                pageBtn(i);
            }
        } else {
            pageBtn(1);

            if (currentPage > 3) dots();

            for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
                pageBtn(i);
            }

            if (currentPage < totalPages - 2) dots();

            pageBtn(totalPages);
        }

        createArrow("next", currentPage === totalPages);
    }

    topCategoryFilters.forEach((link) => {
        link.addEventListener("click", function(e) {
            e.preventDefault();

            const selectedValue = (this.dataset.filter || "").toLowerCase();

            topCategoryFilters.forEach((item) => item.classList.remove("active-top-filter"));

            if (selectedValue === "all") {
                topNavCategory = "";
                this.classList.add("active-top-filter");
            } else {
                topNavCategory = selectedValue;
                this.classList.add("active-top-filter");
            }

            filterProducts();
        });
    });

    clearAllFiltersBtn.addEventListener("click", function() {
        keywordInput.value = "";
        topNavCategory = "";

        topCategoryFilters.forEach((item) => item.classList.remove("active-top-filter"));
        const allFilter = document.querySelector('.top-category-filter[data-filter="all"]');
        if (allFilter) {
            allFilter.classList.add("active-top-filter");
        }

        categoryFilters.forEach((item) => item.checked = false);
        availabilityFilters.forEach((item) => item.checked = false);
        printFilters.forEach((item) => item.checked = false);
        timeFilters.forEach((item) => item.checked = false);

        minRange.value = minRange.min;
        maxRange.value = maxRange.max;
        updateRangeUI();

        filterProducts();
    });

    keywordInput.addEventListener("input", filterProducts);

    categoryFilters.forEach((item) => item.addEventListener("change", filterProducts));
    availabilityFilters.forEach((item) => item.addEventListener("change", filterProducts));
    printFilters.forEach((item) => item.addEventListener("change", filterProducts));
    timeFilters.forEach((item) => item.addEventListener("change", filterProducts));

    minRange.addEventListener("input", function() {
        updateRangeUI();
        filterProducts();
    });

    maxRange.addEventListener("input", function() {
        updateRangeUI();
        filterProducts();
    });

    topCategoryFilters.forEach((item) => item.classList.remove("active-top-filter"));

    if (categoryFromUrl && categoryFromUrl !== "all") {
        const activeLink = document.querySelector(`.top-category-filter[data-filter="${topNavCategory}"]`);
        if (activeLink) {
            activeLink.classList.add("active-top-filter");
        }
    } else {
        const allFilter = document.querySelector('.top-category-filter[data-filter="all"]');
        if (allFilter) {
            allFilter.classList.add("active-top-filter");
        }
    }

    window.addEventListener("resize", updateItemsPerPage);

    updateRangeUI();
    filterProducts();
    updateItemsPerPage();
});

function toggleHeart(btn) {
    const svg = btn.querySelector("svg");
    svg.classList.toggle("text-red-500");
    svg.classList.toggle("text-white");
}
</script>

@endsection