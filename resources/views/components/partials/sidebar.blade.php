<x-app-logo />
<ul class="mt-4 px-1 space-y-1 text-sm font-medium text-white">
    <x-menu.item route="dashboard" name="Dashboard" icon="fa-home" />
    <x-menu.item route="view_category" name="Category" icon="fa-layer-group" />
    <x-menu.item route="view_occasion" name="Occasions" icon="fa-solid fa-gift" />
    <x-menu.item route="view_attribute_type" name="Attributes" icon="fas fa-sliders-h" />
    <x-menu.item route="view_attribute" name="Attribute Values" icon="fas fa-sliders-h" />
    <x-menu.item route="product_list" name="Product" icon="fa fa-boxes w-5" />
    <x-menu.item route="view_coupon" name="Coupon" icon="fa-solid fa-tag" />
    <div class="relative">
            <x-menu.item route="view_vendor" name="Vendors" icon="fa-solid fa-store" />
            @if($pendingVendorCount > 0)
                <span
                    class="absolute right-6 top-1/2 -translate-y-1/2
                           bg-rose-500 text-white text-[11px] font-bold
                           min-w-[20px] h-5 flex items-center justify-center px-1.5 rounded-full
                           ring-2 ring-[#0f172a]">
                    {{ $pendingVendorCount }}
                </span>
            @endif
    </div>
       <div class="relative">
            <x-menu.item route="view.orders" name="Orders" icon="fa-shopping-cart" />
            @if($pendingOrderCount > 0)
                <span
                    class="absolute right-6 top-1/2 -translate-y-1/2
                           bg-rose-500 text-white text-[11px] font-bold
                           min-w-[20px] h-5 flex items-center justify-center px-1.5 rounded-full
                           ring-2 ring-[#0f172a]">
                    {{ $pendingOrderCount }}
                </span>
            @endif
    </div>
    <div class="relative">
            <x-menu.item route="ticket_lists" name="Tickets" icon="fa-ticket-alt" />
            @if($pendingTicketCount > 0)
                <span
                    class="absolute right-6 top-1/2 -translate-y-1/2
                           bg-rose-500 text-white text-[11px] font-bold
                           min-w-[20px] h-5 flex items-center justify-center px-1.5 rounded-full
                           ring-2 ring-[#0f172a]">
                    {{ $pendingTicketCount }}
                </span>
            @endif
    </div>
</ul>
