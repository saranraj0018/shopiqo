<div class="w-full bg-[#050505]  p-4 sm:p-5 lg:min-h-screen">
    <h2 class="text-[17px] sm:text-[18px] font-medium text-white/90">Filters Options</h2>
    <div class="mt-3 border-t border-white/20"></div>

    <!-- Categories -->
    <div class="mt-4">
        <h3 class="text-[15px] sm:text-[16px] font-medium text-white">Categories</h3>
        <div class="mt-3 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-1 gap-y-2 gap-x-3">
            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Pens" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Pens</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Bottles" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Bottles</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Bags" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Bags</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Apparel" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Apparel</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Stationery" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Stationery</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Tech Gifts" class="filter-category custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Tech Gifts</span>
            </label>
        </div>
    </div>

    <!-- Price -->
    <div class="w-[170px] mt-6">
        <h3 class="text-[15px] sm:text-[16px] font-medium text-white mb-8">Price</h3>

        <div class="relative h-10 w-full">
            <div class="absolute top-1/2 -translate-y-1/2 w-full h-1 bg-black border border-white rounded"></div>

            <div id="rangeTrack" class="absolute top-1/2 -translate-y-1/2 h-1 bg-gray-300 rounded"></div>

            <input type="range" id="minRange" min="30" max="1500" value="30"
                class="absolute w-full appearance-none bg-transparent">

            <input type="range" id="maxRange" min="30" max="1500" value="1500"
                class="absolute w-full appearance-none bg-transparent">

            <div id="minTooltip"
                class="absolute -top-8 text-[10px] sm:text-xs bg-black text-white px-2 py-1 rounded border border-white whitespace-nowrap">
                ₹30
            </div>

            <div id="maxTooltip"
                class="absolute -top-8 text-[10px] sm:text-xs bg-black text-white px-2 py-1 rounded border border-white whitespace-nowrap">
                ₹1500
            </div>
        </div>

        <div class="flex justify-between text-[13px] sm:text-sm mt-4 text-white/80">
            <span id="minPrice">₹30</span>
            <span id="maxPrice">₹1500</span>
        </div>
    </div>

    <!-- Availability -->
    <div class="mt-6">
        <h3 class="text-[15px] sm:text-[16px] font-medium text-white">Availability</h3>
        <div class="mt-3 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-1 gap-y-2 gap-x-3">
            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="In-stock" class="filter-availability custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">In-stock</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="out-of-stock" class="filter-availability custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Out of Stock</span>
            </label>
        </div>
    </div>

    <!-- Print Capability -->
    <div class="mt-6">
        <h3 class="text-[15px] sm:text-[16px] font-medium text-white">Print Capability</h3>
        <div class="mt-3 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-1 gap-y-2 gap-x-3">
            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Laser" class="filter-print custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Laser</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Screen Print" class="filter-print custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Screen Print</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="UV Print" class="filter-print custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">UV Print</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="Embroidery" class="filter-print custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">Embroidery</span>
            </label>
        </div>
    </div>

    <!-- Production Time -->
    <div class="mt-6">
        <h3 class="text-[15px] sm:text-[16px] font-medium text-white">Production Time</h3>
        <div class="mt-3 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-1 gap-y-2 gap-x-3">
            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="1-3 days" class="filter-time custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">1-3 days</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="3-7 days" class="filter-time custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">3-7 days</span>
            </label>

            <label class="flex items-center gap-2 text-white/70 cursor-pointer">
                <input type="checkbox" value="7+ days" class="filter-time custom-checkbox">
                <span class="text-[13px] sm:text-[14px]">7+ days</span>
            </label>
        </div>
    </div>
</div>

<style>
.custom-checkbox {
    width: 16px;
    height: 16px;
    appearance: none;
    -webkit-appearance: none;
    background-color: black;
    border: 1px solid white;
    border-radius: 3px;
    position: relative;
    cursor: pointer;
    flex-shrink: 0;
}

.custom-checkbox:checked {
    background-color: black;
    border-color: white;
}

.custom-checkbox:checked::after {
    content: "✔";
    position: absolute;
    top: 48%;
    left: 50%;
    transform: translate(-50%, -58%);
    font-size: 11px;
    color: white;
    line-height: 1;
}

input[type=range]::-webkit-slider-thumb {
    appearance: none;
    width: 14px;
    height: 14px;
    background: white;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    z-index: 2;
}

input[type=range]::-webkit-slider-runnable-track {
    background: transparent;
}

input[type=range]::-moz-range-thumb {
    width: 14px;
    height: 14px;
    background: white;
    border-radius: 50%;
    border: none;
    cursor: pointer;
}

input[type=range]::-moz-range-track {
    background: transparent;
}
</style>