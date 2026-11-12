<div class="w-full lg:w-[70%] md:w-full lg:max-w-[240px] rounded-[20px] bg-[#f3f3f3] p-5 shadow-lg">
    <!-- User Info -->
    @php $sidebarUser = $user ?? auth('user')->user(); @endphp
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 shrink-0 rounded-full overflow-hidden bg-gray-300 flex items-center justify-center">
            @if($sidebarUser?->image)
            <img src="{{ asset('storage/' . $sidebarUser->image) }}" alt="{{ $sidebarUser->name }}"
                onclick="openAvatarZoom('{{ asset('storage/' . $sidebarUser->image) }}')"
                class="w-full h-full rounded-full object-cover object-center cursor-zoom-in hover:opacity-80 transition">
            @else
            <div class="w-12 h-12 rounded-full bg-gray-200 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-gray-500" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.76 0 5-2.24 5-5S14.76 2 12 2 7 4.24 7 7s2.24 5 5 5zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z" />
                </svg>
            </div>
            @endif
        </div>
        <div>
            <h3 class="text-[15px] font-semibold text-black leading-tight">{{ $sidebarUser?->name ?? 'Guest' }}</h3>
            <p class="text-[11px] text-gray-500">{{ $sidebarUser?->email }}</p>
        </div>
    </div>

    <!-- Menu -->
    <div class="mt-6 flex flex-col gap-3">
        <!-- Profile -->
        <a href="/profile" class="group flex items-center gap-3 rounded-full px-4 py-3 text-[14px] font-medium transition-all duration-300
        {{ request()->is('profile') ? 'bg-[#1f1f1f] text-white' : 'text-[#2b2b2b] hover:text-black' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 transition-colors duration-300 {{ request()->is('profile') ? 'text-gray-300' : 'text-gray-600 group-hover:text-black' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 20c1.5-4 5-6 8-6s6.5 2 8 6" stroke-linecap="round" />
            </svg>
            <span>Profile</span>
        </a>

        <!-- Orders & Activity -->
        <a href="/profile/orders-activity"
            class="group flex items-center gap-3 rounded-full px-4 py-3 text-[14px] font-medium transition-all duration-300
        {{ request()->is('profile/orders-activity') ? 'bg-[#1f1f1f] text-white' : 'text-[#2b2b2b] hover:text-black' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 transition-colors duration-300 {{ request()->is('profile/orders-activity') ? 'text-gray-300' : 'text-gray-600 group-hover:text-black' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                <circle cx="6" cy="6" r="1.5" />
                <circle cx="6" cy="12" r="1.5" />
                <circle cx="6" cy="18" r="1.5" />

                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h8M10 12h8M10 18h8" />
            </svg>
            <span>Orders & Activity</span>
        </a>

        <!-- Address -->
        <a href="/profile/address" class="group flex items-center gap-3 rounded-full px-4 py-3 text-[14px] font-medium transition-all duration-300
        {{ request()->is('profile/address') ? 'bg-[#1f1f1f] text-white' : 'text-[#2b2b2b] hover:text-black' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 transition-colors duration-300 {{ request()->is('profile/address') ? 'text-gray-300' : 'text-gray-600 group-hover:text-black' }}" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10Zm0-7.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            </svg>
            <span>Address</span>
        </a>

        <!-- Notifications -->
        <a href="/profile/notification" class="group flex items-center gap-3 rounded-full px-4 py-3 text-[14px] font-medium transition-all duration-300
        {{ request()->is('profile/notification') ? 'bg-[#1f1f1f] text-white' : 'text-[#2b2b2b] hover:text-black' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 transition-colors duration-300 {{ request()->is('profile/notification') ? 'text-gray-300' : 'text-gray-600 group-hover:text-black' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
           a6.002 6.002 0 00-4-5.659V5
           a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159
           c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1
           a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span>Notifications</span>
            @if(!empty($unreadNotificationCount))
            <span class="ml-auto inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 rounded-full bg-red-500 text-white text-[10px] font-semibold">
                {{ $unreadNotificationCount > 9 ? '9+' : $unreadNotificationCount }}
            </span>
            @endif
        </a>

        <!-- Support & Help -->
        <a href="/profile/support-help" class="group flex items-center gap-3 rounded-full px-4 py-3 text-[14px] font-medium transition-all duration-300
        {{ request()->is('profile/support-help') ? 'bg-[#1f1f1f] text-white' : 'text-[#2b2b2b] hover:text-black' }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 transition-colors duration-300 {{ request()->is('profile/support-help') ? 'text-gray-300' : 'text-gray-600 group-hover:text-black' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13v5a1 1 0 001 1h2v-7H6a1 1 0 00-1 1zm14 0v5a1 1 0 01-1 1h-2v-7h2a1 1 0 011 1zM4 12a8 8 0 0116 0" />
            </svg>
            <span>Support & Help</span>
        </a>

        <!-- Logout -->
       <form id="logoutForm" action="/user-logout" method="POST" class="hidden">
    @csrf
</form>

<a href="#" onclick="document.getElementById('logoutForm').submit()"
    class="flex items-center gap-3 px-4 py-2 text-red-500 text-[14px] font-medium hover:text-red-600 transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="1.7">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3-6-3-3m3 3-3 3m3-3H9" />
    </svg>
    <span>Logout</span>
</a>
    </div>
</div>
