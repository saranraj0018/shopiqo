<header class="absolute top-0 left-0 w-full z-50 text-white">
    <div class="w-full bg-black backdrop-blur-md border-b border-white/10">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="h-[64px] md:h-[68px] flex items-center justify-between gap-4">

                <div class="flex items-center">
                    <a href="/" class="shrink-0 flex items-center">
                        <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Logo"
                            class="h-[34px] sm:h-[38px] md:h-[52px] w-auto object-contain">
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-8 lg:gap-10">
                    <div>
                        <nav class="flex items-center gap-6 lg:gap-10 text-[14px] lg:text-[16px] font-normal">
                            <a href="/" class="hover:text-white/80 transition">Home</a>
                            <a href="/shop" class="hover:text-white/80 transition">Shop</a>
                            <a href="/how-it-works" class="hover:text-white/80 transition">How it works</a>
                            <a href="/contact" class="hover:text-white/80 transition">Contact Us</a>
                        </nav>
                    </div>
                    <div class="flex gap-[20px]">
                        <div class=" flex items-center w-[150px] lg:w-[210px] h-[36px] lg:h-[38px] rounded-full border
                        border-white/20 bg-white/5 px-3 lg:px-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-[16px] h-[16px] lg:w-[18px] lg:h-[18px] text-white/80 mr-2 shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                            <input type="text" placeholder="Search"
                                class="w-full bg-transparent text-[13px] lg:text-[15px] text-white placeholder:text-white/65 outline-none border-none">
                        </div>

                        <a href="/wishlist" class="flex items-center justify-center hover:opacity-80 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] lg:w-[22px] lg:h-[22px]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m12 21-1.45-1.32C5.4 15.02 2 11.93 2 8.13 2 5.04 4.42 2.6 7.5 2.6c1.74 0 3.41.81 4.5 2.09A6.04 6.04 0 0 1 16.5 2.6C19.58 2.6 22 5.04 22 8.13c0 3.8-3.4 6.89-8.55 11.55L12 21Z" />
                            </svg>
                        </a>

                        <a href="/cart" class="flex items-center justify-center hover:opacity-80 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] lg:w-[22px] lg:h-[22px]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5.4 5M7 13l-1.2 4.2A1 1 0 0 0 6.76 18H19M19 18a1 1 0 1 1 0 2 1 1 0 0 1 0-2Zm-11 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z" />
                            </svg>
                        </a>

                        <a href="/profile" class="flex items-center justify-center hover:opacity-80 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px] lg:w-[22px] lg:h-[22px]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.12a7.5 7.5 0 0 1 15 0" />
                            </svg>
                        </a>
                    </div>



                    <a href="tel:9629035372"
                        class="hidden xl:flex items-center gap-3 bg-white text-black rounded-full pl-3 pr-4 h-[42px] hover:bg-white/90 transition">

                        <span class="flex items-center justify-center w-[28px] h-[28px] ">
                            <img src="{{ asset('assets/images/navbarheadset.svg') }}" alt="call"
                                class="w-[26px] h-[26px] object-contain">
                        </span>

                        <div class="leading-tight">
                            <p class="text-[9px] font-medium uppercase tracking-[0.5px]">Call us 24/7</p>
                            <p class="text-[15px] font-medium">89564 78965</p>
                        </div>

                    </a>
                </div>

                <div class="flex md:hidden items-center gap-4">
                    <div
                        class="flex items-center w-full h-[30px] rounded-full border border-white/20 bg-white/5 px-4 ml-[30px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] text-white/80 mr-2 shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <input type="text" placeholder="Search"
                            class="  w-full bg-transparent text-[14px] text-white placeholder:text-white/65 outline-none border-none">
                    </div>

                    <a href="/wishlist" class="flex items-center justify-center hover:opacity-80 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m12 21-1.45-1.32C5.4 15.02 2 11.93 2 8.13 2 5.04 4.42 2.6 7.5 2.6c1.74 0 3.41.81 4.5 2.09A6.04 6.04 0 0 1 16.5 2.6C19.58 2.6 22 5.04 22 8.13c0 3.8-3.4 6.89-8.55 11.55L12 21Z" />
                        </svg>
                    </a>

                    <a href="/cart" class="flex items-center justify-center hover:opacity-80 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[20px] h-[20px]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13 5.4 5M7 13l-1.2 4.2A1 1 0 0 0 6.76 18H19M19 18a1 1 0 1 1 0 2 1 1 0 0 1 0-2Zm-11 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z" />
                        </svg>
                    </a>

                    <button id="menuToggle" type="button" class="flex items-center justify-center">
                        <svg id="openIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg id="closeIcon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-black/10 backdrop-blur-md border-white/5">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10">
            <div id="autoScroll"
                class="h-[46px] md:h-[50px] flex items-center gap-6 md:gap-10 overflow-x-auto whitespace-nowrap text-[13px] md:text-[15px]"
                style="scrollbar-width:none; -ms-overflow-style:none;">

                <a href="/shop?category=all"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition shrink-0">
                    <span>Christmas</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>

                <a href="/shop?category=stationery"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition shrink-0">
                    <span>Diaries &amp; Calendars 2026</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>

                <a href="/shop?category=visiting-cards"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition shrink-0">
                    <span>Visiting Cards &amp; ID Cards</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>

                <a href="/shop?category=stationery"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition shrink-0">
                    <span>Stationery &amp; Office Supplies</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>

                <a href="/shop?category=bottles"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition shrink-0">
                    <span>Drinkware &amp; Lunchboxes</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>

                <a href="/shop?category=bags"
                    class="flex items-center gap-2 text-white/95 hover:text-white transition pr-2 shrink-0">
                    <span>Bags</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[12px] h-[12px] md:w-[14px] md:h-[14px]"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 6 6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>


    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden md:hidden"></div>

    <div id="mobileMenu"
        class="fixed top-0 left-0 h-full w-[280px] bg-black/95 backdrop-blur-xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">

        <div class="flex items-center justify-between px-5 h-[64px] border-b border-white/10">
            <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Logo" class="h-[32px] w-auto object-contain">

            <button id="menuClose" type="button" class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6l-12 12" />
                </svg>
            </button>
        </div>

        <div class="px-5 py-6">

            <nav class="flex flex-col gap-4 text-[15px]">
                <a href="/" class="hover:text-white/80 transition">Home</a>
                <a href="/shop" class="hover:text-white/80 transition">Shop</a>
                <a href="/how-it-works" class="hover:text-white/80 transition">How it works</a>
                <a href="/contact" class="hover:text-white/80 transition">Contact Us</a>
                <a href="/profile" class="hover:text-white/80 transition">My Account</a>
            </nav>

            <a href="tel:9629035372"
                class="mt-8 inline-flex items-center gap-3 bg-white text-black rounded-full px-4 h-[42px] hover:bg-white/90 transition">
                <span class="flex items-center justify-center w-[28px] h-[28px]">
                    <img src="{{ asset('assets/images/navbarheadset.svg') }}" alt="call"
                        class="w-[26px] h-[26px] object-contain">
                </span>
                <div class="leading-tight">
                    <p class="text-[9px] font-medium uppercase tracking-[0.5px]">Call us 24/7</p>
                    <p class="text-[14px] font-medium">89564 78965</p>
                </div>
            </a>
        </div>
    </div>
</header>

<script>
const menuToggle = document.getElementById('menuToggle');
const menuClose = document.getElementById('menuClose');
const mobileMenu = document.getElementById('mobileMenu');
const mobileOverlay = document.getElementById('mobileOverlay');

function openMenu() {
    mobileMenu.classList.remove('-translate-x-full');
    mobileOverlay.classList.remove('hidden');
}

function closeMenu() {
    mobileMenu.classList.add('-translate-x-full');
    mobileOverlay.classList.add('hidden');
}

menuToggle.addEventListener('click', function() {
    if (mobileMenu.classList.contains('-translate-x-full')) {
        openMenu();
    } else {
        closeMenu();
    }
});

menuClose.addEventListener('click', closeMenu);
mobileOverlay.addEventListener('click', closeMenu);

const container = document.getElementById('autoScroll');

let scrollAmount = 0;
const speed = 30;

let lastTime = null;

function autoScroll(timestamp) {
    if (!lastTime) lastTime = timestamp;

    const delta = (timestamp - lastTime) / 1000;
    lastTime = timestamp;

    const maxScroll = container.scrollWidth - container.clientWidth;

    if (scrollAmount < maxScroll) {
        scrollAmount += speed * delta;
        container.scrollLeft = scrollAmount;

        requestAnimationFrame(autoScroll);
    }
}

requestAnimationFrame(autoScroll);
</script>