@props([
    'route' => '',
    'icon' => 'fa-home',
    'name' => 'Dashboard',
    'trigger' => false,
])

@php
    $isActive = $route && request()->routeIs($route);
@endphp
<li class="px-3 w-full">
    @if ($route)
        <a href="{{ route($route) }}"
            class="relative flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
           {{ $isActive
                ? 'bg-indigo-600 text-white shadow-[0_2px_10px_rgba(79,70,229,0.45)]'
                : 'text-slate-300 hover:bg-white/[0.06] hover:text-white' }}">
            @if ($isActive)
            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-5 w-[3px] rounded-r bg-indigo-300"></span>
            @endif
            <i class="fa {{ $icon }} w-5 text-center {{ $isActive ? 'text-white' : 'text-slate-400' }}"></i>
            <span class="sidebar-text transition-all duration-300">{{ $name }}</span>
            @if ($trigger)
                <i class="fa fa-chevron-down w-5 sidebar-text"></i>
            @endif
        </a>
    @else
        <button type="submit"
            class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-slate-300 transition-all duration-200 hover:bg-white/[0.06] hover:text-white">
            <i class="fa {{ $icon }} w-5 text-center text-slate-400"></i>
            <span class="sidebar-text flex-1 text-left transition-all duration-300">{{ $name }}</span>
            @if ($trigger)
                <i class="fa fa-chevron-down w-5 sidebar-text"></i>
            @endif
        </button>
    @endif
</li>
