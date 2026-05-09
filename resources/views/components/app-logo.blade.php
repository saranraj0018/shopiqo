<style>
    #sidebar.w-15 a {
        justify-content: center;
    }
</style>

@props(['url' => '/'])

<a href="{{ $url }}" class="flex items-center gap-3 p-4 border-b border-white/30">
    <img src="/dev.png" alt="Shopiqo Logo"
        class="text-white h-8 w-auto max-h-8 rounded-full shadow-lg object-cover float-left ml-3 mr-2 -mt-1">
    <span class="sidebar-text text-lg font-bold text-white transition-all duration-300">
        Shopiqo
    </span>
</a>
