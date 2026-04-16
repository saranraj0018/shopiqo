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

];
@endphp


@php
$cartItems = [
[
'id' => 1,
'brand' => 'Polo',
'title' => 'Unisex Highneck Jacket',
'image' => 'assets/images/categoriecard/categorie.png',
'price' => '₹799',
'quantity' => '50nos',
'subtotal' => '₹799',
],
[
'id' => 2,
'brand' => 'Polo',
'title' => 'Unisex Highneck Jacket',
'image' => 'assets/images/categoriecard/categorie1.png',
'price' => '₹799',
'quantity' => '50nos',
'subtotal' => '₹799',
],

[
'id' => 1,
'brand' => 'Polo',
'title' => 'Unisex Highneck Jacket',
'image' => 'assets/images/categoriecard/categorie.png',
'price' => '₹799',
'quantity' => '50nos',
'subtotal' => '₹799',
],
[
'id' => 2,
'brand' => 'Polo',
'title' => 'Unisex Highneck Jacket',
'image' => 'assets/images/categoriecard/categorie1.png',
'price' => '₹799',
'quantity' => '50nos',
'subtotal' => '₹799',
],
];
@endphp

@php
$coupons = [
[
'code' => 'SAVE10',
'desc' => 'Get ₹10 off',
],
[
'code' => 'FREESHIP',
'desc' => 'Free shipping',
],
];
@endphp

<div class="bg-black px-4 pt-36 pb-8 text-white">

    <!-- Breadcrumb -->
    <div class="text-center text-[13px] text-white/70 mb-8">
        <span>Home</span>

        @if(Request::segment(1))
        <span class="mx-1">/</span>
        <span class="text-white capitalize">
            {{ Request::segment(1) }}
        </span>
        @endif

        @if(Request::segment(2))
        <span class="mx-1">/</span>
        <span class="text-white capitalize">
            {{ Request::segment(2) }}
        </span>
        @endif
    </div>
    <div class="mx-auto grid max-w-5xl grid-cols-1 gap-6 lg:grid-cols-[1fr_340px]">

        <!-- LEFT SIDE -->
        <div>
            <!-- HEADER -->
            <div
                class="hidden md:grid grid-cols-[1.8fr_0.6fr_0.6fr_0.6fr] items-center rounded-xl bg-[#f3f3f3] px-6 py-4 text-[14px] font-medium text-black">
                <p>Product</p>
                <p class="text-center">Price</p>
                <p class="text-center">Quantity</p>
                <p class="text-center">Subtotal</p>
            </div>
            <div class="h-[75vh] overflow-auto mt-4 hide-scrollbar">

                @foreach($cartItems as $item)

                <a href="/shop/single-product" class="block">

                    <div class="border-b border-white/20 py-0 sm:py-5 cursor-pointer">

                        <!-- DESKTOP -->
                        <div class="hidden md:grid grid-cols-[30px_1.8fr_0.6fr_0.6fr_0.6fr] items-center gap-4">

                            <!-- ❌ REMOVE BUTTON -->
                            <button onclick="event.stopPropagation(); event.preventDefault();"
                                class="flex h-8 w-8 items-center justify-center text-2xl leading-none text-white">
                                ×
                            </button>

                            <div class="flex items-center gap-4">
                                <div class="h-[48px] w-[48px] shrink-0 overflow-hidden rounded-md bg-white">
                                    <img src="{{ asset($item['image']) }}" class="h-full w-full object-cover">
                                </div>

                                <div>
                                    <p class="text-[10px] text-white/70">Brand: {{ $item['brand'] }}</p>
                                    <h3 class="text-[16px] font-medium leading-tight text-white">
                                        {{ $item['title'] }}
                                    </h3>
                                </div>
                            </div>

                            <div class="text-center text-[14px] font-medium">{{ $item['price'] }}</div>
                            <div class="text-center text-[14px] font-medium">{{ $item['quantity'] }}</div>
                            <div class="text-center text-[14px] font-medium">{{ $item['subtotal'] }}</div>
                        </div>

                        <!-- MOBILE -->
                        <div class="rounded-xl border border-white/10 p-4 md:hidden">

                            <div class="flex items-start justify-between gap-3">

                                <div class="flex gap-3">
                                    <div class="h-[55px] w-[55px] shrink-0 overflow-hidden rounded-md bg-white">
                                        <img src="{{ asset($item['image']) }}" class="h-full w-full object-cover">
                                    </div>

                                    <div>
                                        <p class="text-[10px] text-white/70">Brand: {{ $item['brand'] }}</p>
                                        <h3 class="text-[16px] font-medium leading-tight text-white">
                                            {{ $item['title'] }}
                                        </h3>
                                    </div>
                                </div>

                                <!-- ❌ MOBILE REMOVE -->
                                <button onclick="event.stopPropagation(); event.preventDefault();"
                                    class="text-2xl leading-none text-white">
                                    ×
                                </button>
                            </div>

                            <div class="mt-4 grid grid-cols-3 gap-3 text-center">
                                <div>
                                    <p class="text-[11px] text-white/60">Price</p>
                                    <p class="mt-1 text-[15px] font-medium">{{ $item['price'] }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-white/60">Quantity</p>
                                    <p class="mt-1 text-[15px] font-medium">{{ $item['quantity'] }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] text-white/60">Subtotal</p>
                                    <p class="mt-1 text-[15px] font-medium">{{ $item['subtotal'] }}</p>
                                </div>
                            </div>

                        </div>

                    </div>

                </a>

                @endforeach
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="space-y-4 px-6">

            <!-- COUPON BOX -->
            <div class="rounded-[20px] border border-white/20 bg-white/95 p-4 sm:p-4 text-black">
                <h3 class="text-[14px] sm:text-[14px] font-semibold">Apply Coupon</h3>

                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center">
                    <input type="text" placeholder="Enter coupon code"
                        class="h-[48px] sm:h-[40px] w-full rounded-[14px] border border-black/70 bg-transparent px-4 text-[13px] text-black placeholder:text-[#6b7280] outline-none" />

                    <button
                        class="h-[48px] sm:h-[40px] rounded-full bg-black px-6 text-[14px] font-medium text-white transition hover:bg-gray">
                        Apply
                    </button>
                </div>
            </div>

            <!-- AVAILABLE COUPONS -->
            <div onclick="openCouponPopup()"
                class="cursor-pointer rounded-[16px] border border-white/20 bg-white/95 px-4 py-4 text-black hover:bg-white transition">

                <div class="flex items-center justify-between gap-4">
                    <span class="text-[14px] font-medium">View Available Coupons</span>
                    <span class="text-[14px] font-medium text-black">1 Available</span>
                </div>
            </div>

            <!-- OVERLAY -->
            <div id="couponPopup" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-[9999] px-6">

                <!-- BOX -->
                <div class="bg-white w-[90%] max-w-[400px] rounded-xl p-5 relative">

                    <!-- CLOSE BUTTON -->
                    <button onclick="closeCouponPopup()" class="absolute top-3 right-3 text-xl text-black">×</button>

                    <h3 class="text-[16px] font-semibold text-black mb-4">
                        Available Coupons
                    </h3>

                    <!-- COUPON LIST -->
                    <div class="space-y-3">

                        @foreach($coupons as $coupon)
                        <div class="border rounded-lg p-3 flex justify-between items-center">

                            <div>
                                <p class="font-medium text-[14px] text-black">
                                    {{ $coupon['code'] }}
                                </p>

                                <p class="text-[12px] text-black/60">
                                    {{ $coupon['desc'] }}
                                </p>
                            </div>

                            <button onclick="applyCoupon('{{ $coupon['code'] }}')"
                                class="text-sm text-black font-medium hover:underline">
                                Apply
                            </button>

                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- PAYMENT BOX -->
            <div class="h-fit rounded-2xl bg-[#f3f3f3] p-5 text-black shadow-sm">
                <h3 class="text-[14px] font-medium">Price details</h3>

                <div class="my-4 border-t border-black/10"></div>

                <div class="space-y-3 text-[13px]">
                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Items</span>
                        <span>9</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Sub Total</span>
                        <span>₹200.00</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Coupon Discount</span>
                        <span>-₹10.00</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Shipping</span>
                        <span>₹200.00</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-black/60">Taxes</span>
                        <span>₹200.00</span>
                    </div>
                </div>

                <div class="my-4 border-t border-black/10"></div>

                <div class="flex items-center justify-between text-[15px] font-medium">
                    <span class="text-black/70">Total</span>
                    <span>₹200.00</span>
                </div>

                <div class="mt-5 flex items-center justify-between rounded-lg bg-[#e8e8e8] px-4 py-3 text-[14px]">
                    <span class="text-black/45">Payment method</span>
                    <span class="font-medium text-black/60">UPI</span>
                </div>
            </div>

        </div>
    </div>

    <h2 class=" flex justify-center mb-8 mt-4 text-[24px] sm:text-[34px] md:text-[30px] font-light leading-[1.15]
    bg-gradient-to-r from-white via-white/80 to-white/40 
    bg-clip-text text-transparent">
        You may also try
    </h2>

    <div class="w-full flex justify-center">

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

        <p id="noProductsMessage" class="hidden text-center text-white/60 mt-8">
            No products found
        </p>

        <div id="pagination" class="flex justify-center flex-wrap mt-8 sm:mt-10 gap-2"></div>
    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}

.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<script>
function applyCoupon(code) {
    // fill input (optional)
    const input = document.querySelector('input[placeholder="Enter coupon code"]');
    if (input) {
        input.value = code;
    }

    // close popup
    closeCouponPopup();
}

function openCouponPopup() {
    const popup = document.getElementById('couponPopup');
    popup.classList.remove('hidden');
    popup.classList.add('flex');
}

function closeCouponPopup() {
    const popup = document.getElementById('couponPopup');
    popup.classList.add('hidden');
    popup.classList.remove('flex');
}

// outside click close
document.getElementById('couponPopup').addEventListener('click', function(e) {
    if (e.target.id === 'couponPopup') {
        closeCouponPopup();
    }
});
</script>