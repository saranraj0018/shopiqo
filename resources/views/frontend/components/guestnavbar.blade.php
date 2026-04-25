<header class="absolute top-0 left-0 w-full z-50 text-white">
    <div class="w-full bg-black backdrop-blur-md border-b border-white/10">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10">
            <div class="h-[64px] md:h-[68px] flex items-center justify-between gap-4">

                <div class="flex items-center shrink-0">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Logo"
                            class="h-[34px] sm:h-[38px] md:h-[52px] w-auto object-contain">
                    </a>
                </div>

                <div class="hidden md:flex items-center justify-around flex-1 ml-8">
                    <nav class="flex items-center gap-6 lg:gap-10 text-[14px] lg:text-[15px] font-normal">
                        <a href="/" class="hover:text-white/80 transition">Home</a>
                        <a href="/shop" class="hover:text-white/80 transition">Shop</a>
                        <a href="/how-it-works" class="hover:text-white/80 transition">How it works</a>
                        <a href="/contact" class="hover:text-white/80 transition">Contact Us</a>
                    </nav>

                    <div class="flex items-center gap-4 lg:gap-5">
                        <div
                            class="flex items-center w-[180px] lg:w-[230px] h-[38px] rounded-full border border-white/15 bg-white/[0.04] px-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-[16px] h-[16px] text-white/80 mr-2 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                            <input type="text" placeholder="Search"
                                class="w-full bg-transparent text-[13px] lg:text-[14px] text-white placeholder:text-white/60 outline-none border-none">
                        </div>

                        <a href="/login"
                            class="h-[36px] px-5 rounded-full bg-white text-black text-[13px] font-medium flex items-center justify-center hover:bg-white/90 transition">
                            Login
                        </a>
                    </div>
                </div>

                <div class="flex md:hidden items-center gap-3 ml-auto">
                    <button type="button"
                        class="flex items-center justify-center w-9 h-9 rounded-full border border-white/15 bg-white/[0.04] hover:bg-white/[0.08] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] text-white/85" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.85-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>

                    <a href="/login"
                        class="h-[36px] px-5 rounded-full bg-white text-black text-[13px] font-medium flex items-center justify-center hover:bg-white/90 transition">
                        Login
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
            <nav class="flex flex-col gap-5 text-[15px]">
                <a href="/" class="hover:text-white/80 transition">Home</a>
                <a href="/shop" class="hover:text-white/80 transition">Shop</a>
                <a href="/how-it-works" class="hover:text-white/80 transition">How it works</a>
                <a href="/contact" class="hover:text-white/80 transition">Contact Us</a>
            </nav>

            <a href="tel:8956478965"
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
const openIcon = document.getElementById('openIcon');
const closeIcon = document.getElementById('closeIcon');

function openMenu() {
    mobileMenu.classList.remove('-translate-x-full');
    mobileOverlay.classList.remove('hidden');
    openIcon.classList.add('hidden');
    closeIcon.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeMenu() {
    mobileMenu.classList.add('-translate-x-full');
    mobileOverlay.classList.add('hidden');
    openIcon.classList.remove('hidden');
    closeIcon.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

if (menuToggle) menuToggle.addEventListener('click', openMenu);
if (menuClose) menuClose.addEventListener('click', closeMenu);
if (mobileOverlay) mobileOverlay.addEventListener('click', closeMenu);

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