<nav class="bg-white/90 backdrop-blur-sm w-full border-b border-slate-200 px-5 py-2.5 shadow-sm flex justify-between items-center">
    <a href="javascript:void(0)" onclick="toggleSidebar()" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 transition-colors" id="menuToggleBtn">
        <i id="menuIcon" class="fas fa-bars text-lg transition-all duration-300"></i>
    </a>
    <div class="flex items-center gap-6">
        <ul class="flex items-center gap-4">
            <!-- Notifications -->
            {{-- <li class="relative">
                <a href="{{ route('notifications.index') }}" class="relative">
                    <i class="fa fa-bell text-xl text-red-600"></i>
                    @php
                        $unread = \App\Models\Notification::where(['status' => 0, 'role' => 1])->count();
                    @endphp
                    @if ($unread > 0)
                        <span
                            class="absolute top-0 right-0 bg-red-600 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $unread }}
                        </span>
                    @endif
                </a>
            </li> --}}
            <li class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-full hover:bg-slate-100 transition-colors focus:outline-none">
                    <span class="w-7 h-7 rounded-full bg-indigo-600 text-white text-xs font-semibold flex items-center justify-center">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                    <span class="text-slate-700 text-sm font-medium">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                </button>
                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-lg shadow-slate-200/60 py-2 z-50"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 flex items-center gap-2 transition-colors">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>
    </div>
</nav>
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const navbar = document.getElementById('navbarWrapper');
    const main = document.getElementById('mainContent');
    const texts = document.querySelectorAll('.sidebar-text');
    const icon = document.getElementById('menuIcon');
    const isCollapsed = sidebar.classList.contains('collapsed');

    if (isCollapsed) {
        sidebar.classList.remove('collapsed');
        sidebar.classList.remove('w-15');
        sidebar.classList.add('w-64');
        navbar.classList.remove('left-15');
        navbar.classList.add('left-64');
        main.classList.remove('ml-15');
        main.classList.add('ml-64');
        texts.forEach(el => el.classList.remove('hidden'));
        icon.classList.remove('fa-arrow-left');
        icon.classList.add('fa-bars');
    } else {
        sidebar.classList.add('collapsed');
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-15');
        navbar.classList.remove('left-64');
        navbar.classList.add('left-15');
        main.classList.remove('ml-64');
        main.classList.add('ml-15');
        texts.forEach(el => el.classList.add('hidden'));
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-arrow-left');
    }
}
</script>
