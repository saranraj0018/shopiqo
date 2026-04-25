@php
$orders = [

    ['title' => 'Order Confirmed','desc' => 'Your order #ORD-2024-1236 has been confirmed and is being processed.','time' =>
    '4 day ago','icon' => 'assets/images/profile/Confirmed.png'],

    ['title' => 'Order Returned','desc' => 'Your order #ORD-2024-1237 has been returned to our warehouse.','time' => '3 day
    ago','icon' => 'assets/images/profile/Returned.png','dot' => true],

    ['title' => 'Order Rejected','desc' => 'Order #ORD-2024-1238 was rejected. Contact support for help.','time' => '2 day
    ago','icon' => 'assets/images/profile/Rejected.png','dot' => true],

    ['title' => 'Order Pending','desc' => 'Your order #ORD-2024-1240 has been returned and a refund has been
    initiated.','time' => '1 day ago','icon' => 'assets/images/profile/Pending.png'],

    ['title' => 'Order Delivered Successfully','desc' => 'Your order #ORD-2024-1234 has been delivered. We hope you
    enjoyyour new EV accessories!','time' => '1 day ago','icon' => 'assets/images/profile/Successfully.png'],

    ['title' => 'Order Out for Delivery','desc' => 'Your order #ORD-2024-1235 is out for delivery and will reach you
    today.','time' => '1 day ago','icon' => 'assets/images/profile/Delivery.png'],

    ['title' => 'Order Rejected','desc' => 'Order #ORD-2024-1238 was rejected. Contact support for help.','time' => '2 day
    ago','icon' => 'assets/images/profile/Rejected.png','dot' => true],

    ['title' => 'Order Pending','desc' => 'Your order #ORD-2024-1240 has been returned and a refund has been
    initiated.','time' => '1 day ago','icon' => 'assets/images/profile/Pending.png'],

    ['title' => 'Order Delivered Successfully','desc' => 'Your order #ORD-2024-1234 has been delivered. We hope you
    enjoyyour new EV accessories!','time' => '1 day ago','icon' => 'assets/images/profile/Successfully.png'],

    ['title' => 'Order Out for Delivery','desc' => 'Your order #ORD-2024-1235 is out for delivery and will reach you
    today.','time' => '1 day ago','icon' => 'assets/images/profile/Delivery.png'],

    ['title' => 'Order Confirmed','desc' => 'Your order #ORD-2024-1236 has been confirmed and is being processed.','time' =>
    '4 day ago','icon' => 'assets/images/profile/Confirmed.png'],

    ['title' => 'Order Returned','desc' => 'Your order #ORD-2024-1237 has been returned to our warehouse.','time' => '3 day
    ago','icon' => 'assets/images/profile/Returned.png','dot' => true],

];
@endphp

<section>
    <div class="max-w-5xl mx-auto">

        @if(count($orders) > 0)

        <!-- Orders List -->
        <div id="ordersContainer" class="flex flex-col gap-[10px]">
            @foreach($orders as $order)
            <div
                class="order-item relative flex items-center gap-4 rounded-[20px] border border-white/20 bg-white/[0.03] px-4 py-2 backdrop-blur-md">

                <div class="flex h-[50px] w-[50px] items-center justify-center rounded-full bg-white shrink-0">
                    <img src="{{ asset($order['icon']) }}" alt="icon" class="w-8 h-8 object-contain">
                </div>

                <div class="flex-1">
                    <h3 class="text-white text-[14px] font-medium">
                        {{ $order['title'] }}
                    </h3>

                    <p class="text-white/80 text-[12px] mt-1">
                        {{ $order['desc'] }}
                    </p>

                    <span class="text-white/50 text-[10px]">
                        {{ $order['time'] }}
                    </span>
                </div>

                @if(!empty($order['dot']))
                <span
                    class="absolute right-6 top-[15%] lg:top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-white rounded-full"></span>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div id="pagination" class="mt-8 flex items-center justify-center gap-2 flex-wrap"></div>

        @else

        <!-- NO NOTIFICATIONS FOUND -->
        <div class="flex flex-col items-center">
            
            <div class="flex justify-center mb-4">
                <div class="w-[350px] sm:w-[450px]">
                    <img src="{{ asset('assets/images/ordericons/nonotifications.png') }}" alt="notification">
                </div>
            </div>

            <h3 class="text-white text-[22px] font-medium">
                No Notifications
            </h3>
        </div>

        @endif

    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 6;
    const items = Array.from(document.querySelectorAll(".order-item"));
    const pagination = document.getElementById("pagination");
    let currentPage = 1;
    const totalPages = Math.ceil(items.length / itemsPerPage);

    function showPage(page) {
        currentPage = page;

        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        items.forEach((item, index) => {
            item.style.display = (index >= start && index < end) ? "flex" : "none";
        });

        renderPagination();
    }

    function createButton(label, page, isActive = false, isDisabled = false) {
        const btn = document.createElement("button");
        btn.innerText = label;
        btn.className = `
            min-w-[38px] h-[38px] px-3 rounded-full border text-sm transition
            ${isActive 
                ? "bg-white text-black border-white" 
                : "bg-transparent text-white border-white/20 hover:bg-white hover:text-black"}
            ${isDisabled ? "opacity-40 cursor-not-allowed hover:bg-transparent hover:text-white" : ""}
        `;

        if (!isDisabled) {
            btn.addEventListener("click", () => showPage(page));
        }

        return btn;
    }

    function createDots() {
        const span = document.createElement("span");
        span.innerText = "...";
        span.className = "px-2 text-white/60 text-sm";
        return span;
    }

    function getPagesToShow(current, total) {
        const pages = [];

        if (total <= 7) {
            for (let i = 1; i <= total; i++) pages.push(i);
            return pages;
        }

        pages.push(1);

        if (current > 3) {
            pages.push("dots-left");
        }

        let start = Math.max(2, current - 1);
        let end = Math.min(total - 1, current + 1);

        if (current <= 3) {
            start = 2;
            end = 4;
        }

        if (current >= total - 2) {
            start = total - 3;
            end = total - 1;
        }

        for (let i = start; i <= end; i++) {
            pages.push(i);
        }

        if (current < total - 2) {
            pages.push("dots-right");
        }

        pages.push(total);

        return pages;
    }

    function renderPagination() {
        pagination.innerHTML = "";

        pagination.appendChild(
            createButton("←", currentPage - 1, false, currentPage === 1)
        );

        const pages = getPagesToShow(currentPage, totalPages);

        pages.forEach(page => {
            if (page === "dots-left" || page === "dots-right") {
                pagination.appendChild(createDots());
            } else {
                pagination.appendChild(
                    createButton(page, page, currentPage === page)
                );
            }
        });

        pagination.appendChild(
            createButton("→", currentPage + 1, false, currentPage === totalPages)
        );
    }

    showPage(1);
});
</script>