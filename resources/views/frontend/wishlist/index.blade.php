@php
$products = [

['image'=>'assets/images/categoriecard/categorie5.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie4.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie3.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie2.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie1.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie1.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie2.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie3.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie4.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

['image'=>'assets/images/categoriecard/categorie5.png','title' => 'Bella + Canvas Poly-Cotton Short-Sleeve T-Shirt -
Unisex','subtitle' => 'Short-Sleeve T-Shirt T-Shirt - Unisex','price' => '120','rating' => '4.5','badge' =>
null,'wishlist' => true,'availability' => 'In-stock',],

];

$wishlistItems = array_filter($products, function ($item) {
return isset($item['wishlist']) && $item['wishlist'] === true;
});
@endphp

<section class="bg-black px-12 sm:px-4 sm:px-6 lg:px-8 pt-[140px]">
    <div class="max-w-5xl mx-auto">

        <!-- Breadcrumb -->
        <div class="text-center text-[13px] text-white/60 mb-6">
            Home / <span class="text-white">Wishlist</span>
        </div>

        <h3 class="text-white pb-[15px] text-[16px] flex justify-center lg:hidden">
            Wishlist
        </h3>

        @if(count($wishlistItems) > 0)

        <!-- Product Grid -->
        <div id="productGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-4">
            @foreach($wishlistItems as $item)
            <div class="product-item">
                @include('frontend.components.shopproductcard', ['item' => $item])
            </div>
            @endforeach
        </div>

        <div id="pagination" class="pb-[2rem] mt-8 flex justify-center gap-2 flex-wrap"></div>

        @else

        <!-- Empty Wishlist -->
        <div id="noWishlistMessage" class="text-center mt-10">
            <img src="{{ asset('assets/images/ordericons/emptywishlist.png') }}" alt="Empty Wishlist"
                class="w-[80%] sm:w-[40%] md:w-[35%] mx-auto mb-6 object-contain">

            <h2 class="text-white text-[18px] sm:text-[20px] font-semibold mb-2">
                Your wishlist is empty
            </h2>

            <p class="text-white/50 text-[13px] sm:text-[14px] mb-6">
                Looks like you haven’t added anything yet
            </p>

            <a href="/shop"
                class="inline-flex items-center justify-center mb-10 px-6 h-[42px] rounded-full bg-white text-black text-[14px] font-medium hover:bg-white/90 transition">
                Browse Products
            </a>
        </div>

        @endif
    </div>
</section>

@if(count($wishlistItems) > 0)
<script>
function toggleHeart(button) {
    const svg = button.querySelector('svg');
    svg.classList.toggle('text-white');
    svg.classList.toggle('text-red-500');
}

const items = document.querySelectorAll('.product-item');
let itemsPerPage = window.innerWidth < 640 ? 6 : 9;
let currentPage = 1;
let totalPages = Math.ceil(items.length / itemsPerPage);

function updateItemsPerPage() {
    itemsPerPage = window.innerWidth < 640 ? 6 : 9;
    totalPages = Math.ceil(items.length / itemsPerPage);

    if (currentPage > totalPages) {
        currentPage = totalPages;
    }

    showPage(currentPage);
}

function showPage(page) {
    currentPage = page;

    items.forEach((item, index) => {
        item.style.display =
            index >= (page - 1) * itemsPerPage &&
            index < page * itemsPerPage ?
            'block' :
            'none';
    });

    renderPagination();
}

function renderPagination() {
    const container = document.getElementById('pagination');
    let pages = [];

    if (totalPages <= 7) {
        for (let i = 1; i <= totalPages; i++) {
            pages.push(i);
        }
    } else {
        pages.push(1, 2);

        if (currentPage > 4) pages.push('...');

        let start = Math.max(3, currentPage - 1);
        let end = Math.min(totalPages - 2, currentPage + 1);

        for (let i = start; i <= end; i++) {
            if (!pages.includes(i)) pages.push(i);
        }

        if (currentPage < totalPages - 3) pages.push('...');

        pages.push(totalPages - 1, totalPages);
    }

    let html = `
        <div class="flex items-center gap-2 text-white flex-wrap justify-center">
            <button onclick="changePage(${currentPage - 1})"
                class="px-2 text-lg ${currentPage === 1 ? 'opacity-30 pointer-events-none' : 'hover:text-white/70'}">
                ←
            </button>
    `;

    pages.forEach(p => {
        if (p === '...') {
            html += `<span class="px-2 text-white/40">...</span>`;
        } else {
            html += `
                <button onclick="changePage(${p})"
                    class="px-3 py-1 text-sm rounded-md ${
                        p === currentPage
                            ? 'bg-white text-black font-semibold'
                            : 'text-white/60 hover:text-white'
                    }">
                    ${p}
                </button>
            `;
        }
    });

    html += `
            <button onclick="changePage(${currentPage + 1})"
                class="px-2 text-lg ${currentPage === totalPages ? 'opacity-30 pointer-events-none' : 'hover:text-white/70'}">
                →
            </button>
        </div>
    `;

    container.innerHTML = html;
}

function changePage(page) {
    if (page < 1 || page > totalPages) return;
    showPage(page);

    window.scrollTo({
        top: document.getElementById('productGrid').offsetTop - 120,
        behavior: 'smooth'
    });
}

window.addEventListener('resize', updateItemsPerPage);
updateItemsPerPage();
</script>
@endif