<x-layouts.app>
<div class="min-h-screen p-1">
<div class="max-w-7xl mx-auto space-y-6">
<div>
    <h1 class="text-2xl font-semibold text-slate-900">Dashboard</h1>
    <p class="text-sm text-slate-500 mt-1">Overview of store performance</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-5">
    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center justify-between">
            <span class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i class="fa-solid fa-users text-lg"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 text-xs font-semibold px-2 py-1 rounded-full">
                <i class="fa-solid fa-arrow-up text-[10px]"></i> 2.5%
            </span>
        </div>
        <p class="text-slate-500 text-sm font-medium mt-4">Total Customers</p>
        <h2 class="text-2xl font-bold text-slate-900 mt-1">567,899</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center justify-between">
            <span class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i class="fa-solid fa-sack-dollar text-lg"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-emerald-600 bg-emerald-50 text-xs font-semibold px-2 py-1 rounded-full">
                <i class="fa-solid fa-arrow-up text-[10px]"></i> 1.2%
            </span>
        </div>
        <p class="text-slate-500 text-sm font-medium mt-4">Revenue</p>
        <h2 class="text-2xl font-bold text-slate-900 mt-1">$3,465M</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center justify-between">
            <span class="w-11 h-11 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i class="fa-solid fa-cart-shopping text-lg"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-rose-600 bg-rose-50 text-xs font-semibold px-2 py-1 rounded-full">
                <i class="fa-solid fa-arrow-down text-[10px]"></i> 0.3%
            </span>
        </div>
        <p class="text-slate-500 text-sm font-medium mt-4">Orders</p>
        <h2 class="text-2xl font-bold text-slate-900 mt-1">1,136</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
        <div class="flex items-center justify-between">
            <span class="w-11 h-11 rounded-xl bg-fuchsia-50 text-fuchsia-600 flex items-center justify-center">
                <i class="fa-solid fa-clock text-lg"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-rose-600 bg-rose-50 text-xs font-semibold px-2 py-1 rounded-full">
                <i class="fa-solid fa-arrow-down text-[10px]"></i> 1.1%
            </span>
        </div>
        <p class="text-slate-500 text-sm font-medium mt-4">Pending</p>
        <h2 class="text-2xl font-bold text-slate-900 mt-1">320</h2>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Sales Overview</h2>
        <div id="barChart" class="h-56 rounded-xl bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-sm">
            Chart data coming soon
        </div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200/70 shadow-sm p-5">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Order Distribution</h2>
        <div id="pieChart" class="h-56 rounded-xl bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-sm">
            Chart data coming soon
        </div>
    </div>
</div>
</div>
</div>
</x-layouts.app>
