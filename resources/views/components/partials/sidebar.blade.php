{{-- <aside id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-[#343a40] transition-all duration-300"> --}}
<x-app-logo />
<ul class="mt-4 space-y-3 text-sm font-medium text-white">
    <x-menu.item route="dashboard" name="Dashboard" icon="fa-home" />
    <x-menu.item route="view_banner" name="Banner" icon="fas fa-images" />
    <x-menu.item route="view_category" name="Category" icon="fa-layer-group" />
    <x-menu.item route="view_attribute" name="Attributes" icon="fas fa-sliders-h" />
    <x-menu.item route="product_list" name="Product" icon="fa fa-boxes w-5" />
    <x-menu.item route="view_coupon" name="Coupon" icon="fa-solid fa-tag" />
    <x-menu.item route="view_wallet_bonus" name="Wallet Bonus" icon="fa fa-boxes w-5" />
</ul>
{{-- </aside> --}}
