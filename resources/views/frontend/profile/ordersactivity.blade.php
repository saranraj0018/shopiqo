@php
$orders = [
['image'=>'assets/images/categoriecard/categorie.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie1.png','button1'=>'Track Order','button2'=>null],
['image'=>'assets/images/categoriecard/categorie2.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie3.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie4.png','button1'=>'Track Order','button2'=>null],
['image'=>'assets/images/categoriecard/categorie5.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie3.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie5.png','button1'=>'Track Order','button2'=>null],
['image'=>'assets/images/categoriecard/categorie4.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie.png','button1'=>'View Order','button2'=>'Download Invoice'],
['image'=>'assets/images/categoriecard/categorie2.png','button1'=>'Track Order','button2'=>null],
['image'=>'assets/images/categoriecard/categorie1.png','button1'=>'View Order','button2'=>'Download Invoice'],
];
@endphp

<section>

    <h3 class="mb-6 text-[14px] flex justify-center font-medium text-white lg:hidden">
        Orders & Activity
    </h3>

    <div class="max-w-5xl mx-auto">

        <div class="mb-4 sm:mb-2 flex justify-end px-4 sm:px-6 lg:px-0">
            <div class="relative w-[120px] sm:w-[135px]">
                <select id="viewSwitcher"
                    class="appearance-none w-full h-[36px] sm:h-[40px] rounded-full border border-white/15 bg-white/5 backdrop-blur-md pl-3 sm:pl-4 pr-9 sm:pr-10 text-[11px] sm:text-[12px] font-medium text-white shadow-[0_0_20px_rgba(255,255,255,0.04)] outline-none transition-all duration-300 hover:border-white/30 hover:bg-white/10 focus:border-white/40 focus:bg-white/10">

                    <option value="grid" class="bg-[#111] text-white">Grid View</option>
                    <option value="list" class="hidden md:block bg-[#111] text-white">List View</option>

                </select>

                <div class="pointer-events-none absolute inset-y-0 right-3 sm:right-4 flex items-center text-white/70">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[13px] w-[13px] sm:h-4 sm:w-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- ✅ CONDITION START --}}
        @if(count($orders) > 0)

        <!-- GRID -->
        <div id="ordersContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 px-8 lg:px-0">
            @foreach($orders as $order)
            <div class="order-item bg-[#f5f5f5] rounded-2xl overflow-hidden shadow-md">
                <div class="h-[165px] bg-[#e9e9e9] flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($order['image']) }}" class="w-full h-full object-fill" alt="order">
                </div>

                <div class="p-4">
                    <div class="flex gap-2">
                        @if($order['button2'])
                        <a href="{{ url('/order/view-order') }}"
                            class="flex-1 w-full h-[35px] rounded-full border border-black/20 bg-white text-black text-[10px] font-medium text-black/70 hover:bg-black hover:text-white transition flex items-center justify-center">
                            {{ $order['button1'] }}
                        </a>

                        <button
                            class="flex-1 h-[35px] rounded-full bg-black text-white text-[10px] font-medium hover:bg-black/90 transition">
                            {{ $order['button2'] }}
                        </button>
                        @else
                        <a href="{{ url('/order/track-order') }}"
                            class="w-full h-[35px] rounded-full border border-black/20 text-[10px] font-medium text-black/70 hover:bg-black hover:text-white transition flex items-center justify-center">
                            {{ $order['button1'] }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- LIST VIEW -->
        <div id="ordersListContainer" class="hidden px-5 lg:px-0">
            <div class="overflow-hidden rounded-2xl border border-white/10 bg-black">
                <div class="hidden md:grid grid-cols-6 bg-white/10 text-white text-[12px] font-medium px-6 py-4">
                    <div>Order ID</div>
                    <div>Date</div>
                    <div>Order Total</div>
                    <div>Status</div>
                    <div>Payment mode</div>
                    <div>Action</div>
                </div>

                @foreach($orders as $index => $order)
                <div class="order-list-item border-t border-white/10 text-white">
                    <div class="hidden md:grid grid-cols-6 items-center px-6 py-5 text-[12px]">
                        <div>ORD-12345678{{ $index }}</div>
                        <div>08/11/2024</div>
                        <div>₹500</div>
                        <div>
                            @if($index == 3)
                            <span class="inline-flex items-center rounded-full border border-white/40 px-3 py-1 text-[11px]">
                                Pending
                            </span>
                            @else
                            <span class="inline-flex items-center rounded-full bg-white text-black px-3 py-1 text-[11px]">
                                Batching
                            </span>
                            @endif
                        </div>
                        <div>
                            @if($index == 2)
                            COD
                            @else
                            Online Payment
                            @endif
                        </div>
                        <div>
                            <a href="{{ url('/order/view-order') }}"
                                class="rounded-full bg-white px-4 py-2 text-[11px] font-medium text-black hover:bg-white/90 transition">
                                View order
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ❌ NO DATA --}}
        @else
        <div class="flex items-center justify-center px-4 flex-col pt-6">
            <div class="text-center">
                <img src="{{ asset('assets/images/ordericons/noorders.png') }}"
                    class="w-[300px] mx-auto mb-6">

            </div>
                <h3 class="text-white text-[20px] font-medium mb-2">
                    No Orders yet
                </h3>

                <p class="text-white/50 text-[13px] mb-6">
                    You haven't placed any orders yet, Start shopping to fill this space!
                </p>

                <a href="/shop"
                    class="px-6 py-2 bg-white text-black rounded-full text-[14px] font-medium">
                    Start Shopping
                </a>
        </div>
        @endif
        {{-- ✅ CONDITION END --}}

        <!-- PAGINATION -->
        @if(count($orders) > 0)
        <div class="mt-10 flex justify-center">
            <div id="pagination" class="flex items-center gap-2 px-3 py-2 backdrop-blur-md">
            </div>
        </div>
        @endif

    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 6;
    const gridItems = Array.from(document.querySelectorAll(".order-item"));
    const listItems = Array.from(document.querySelectorAll(".order-list-item"));
    const pagination = document.getElementById("pagination");
    const viewSwitcher = document.getElementById("viewSwitcher");
    const ordersContainer = document.getElementById("ordersContainer");
    const ordersListContainer = document.getElementById("ordersListContainer");
    let currentPage = 1;

    function getCurrentItems() {
        return viewSwitcher.value === "grid" ? gridItems : listItems;
    }

    function showPage(page) {
        currentPage = page;

        const activeItems = getCurrentItems();
        const dynamicTotalPages = Math.ceil(activeItems.length / itemsPerPage);

        if (currentPage > dynamicTotalPages) {
            currentPage = dynamicTotalPages;
        }

        gridItems.forEach((item, index) => {
            const start = (currentPage - 1) * itemsPerPage;
            const end = currentPage * itemsPerPage;
            item.style.display =
                (viewSwitcher.value === "grid" && index >= start && index < end) ? "block" : "none";
        });

        listItems.forEach((item, index) => {
            const start = (currentPage - 1) * itemsPerPage;
            const end = currentPage * itemsPerPage;
            item.style.display =
                (viewSwitcher.value === "list" && index >= start && index < end) ? "block" : "none";
        });

        renderPagination();
    }

    function createButton(label, page = null, isActive = false, isDisabled = false, isDots = false) {
        const el = document.createElement(isDots ? "span" : "button");
        el.innerHTML = label;

        if (isDots) {
            el.className =
                "min-w-[36px] h-[36px] px-2 rounded-full text-white/60 text-sm flex items-center justify-center";
            return el;
        }

        el.className = `
            min-w-[36px] h-[36px] px-3 rounded-full text-sm font-medium transition-all duration-200
            ${isActive
                ? "bg-white text-black shadow-md"
                : "bg-transparent text-white border border-white/10 hover:bg-white hover:text-black"}
            ${isDisabled ? "opacity-35 pointer-events-none" : ""}
        `;

        if (page !== null && !isDisabled) {
            el.addEventListener("click", () => showPage(page));
        }

        return el;
    }

    function getPages() {
        const pages = [];
        const activeItems = getCurrentItems();
        const totalPages = Math.ceil(activeItems.length / itemsPerPage);

        if (totalPages <= 7) {
            for (let i = 1; i <= totalPages; i++) pages.push(i);
        } else {
            pages.push(1, 2);

            if (currentPage > 4) pages.push("...");

            const start = Math.max(3, currentPage - 1);
            const end = Math.min(totalPages - 2, currentPage + 1);

            for (let i = start; i <= end; i++) {
                if (!pages.includes(i)) pages.push(i);
            }

            if (currentPage < totalPages - 3) pages.push("...");

            pages.push(totalPages - 1, totalPages);
        }

        return [...new Set(pages)];
    }

    function renderPagination() {
        pagination.innerHTML = "";
        const activeItems = getCurrentItems();
        const totalPages = Math.ceil(activeItems.length / itemsPerPage);

        pagination.appendChild(
            createButton("&#8592;", currentPage - 1, false, currentPage === 1)
        );

        getPages().forEach(item => {
            if (item === "...") {
                pagination.appendChild(createButton("...", null, false, false, true));
            } else {
                pagination.appendChild(
                    createButton(item, item, item === currentPage)
                );
            }
        });

        pagination.appendChild(
            createButton("&#8594;", currentPage + 1, false, currentPage === totalPages)
        );
    }

    viewSwitcher.addEventListener("change", function() {
        currentPage = 1;

        if (this.value === "grid") {
            ordersContainer.classList.remove("hidden");
            ordersListContainer.classList.add("hidden");
        } else {
            ordersContainer.classList.add("hidden");
            ordersListContainer.classList.remove("hidden");
        }

        showPage(1);
    });

    if (viewSwitcher.value === "grid") {
        ordersContainer.classList.remove("hidden");
        ordersListContainer.classList.add("hidden");
    } else {
        ordersContainer.classList.add("hidden");
        ordersListContainer.classList.remove("hidden");
    }

    showPage(1);
});
</script>