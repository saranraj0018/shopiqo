<section class="relative bg-black text-white pt-[9rem] pb-0 px-4 sm:px-6 lg:px-8 overflow-hidden">

    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-0 top-0 h-[300px] w-[300px] rounded-full bg-white/5 blur-3xl"></div>
        <div class="absolute right-0 bottom-0 h-[280px] w-[280px] rounded-full bg-white/5 blur-3xl"></div>
    </div>

    @php
    $productImages = [
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),
    asset('assets/images/jacket.png'),


    ];

    $priceRows = [
    ['qty' => '36-99', 'price' => '₹62.09'],
    ['qty' => '100-149', 'price' => '₹55.49'],
    ['qty' => '150-299', 'price' => '₹53.59'],
    ['qty' => '300-499', 'price' => '₹47.49'],
    ['qty' => '500-999', 'price' => '₹45.89'],
    ['qty' => '1000 -More', 'price' => 'Get a Quote'],
    ];
    @endphp

    <div class="relative z-10 max-w-[60rem] mx-auto">
        <!-- Breadcrumb -->
        <div class="text-center text-[13px] text-white/70 mb-8">

            @if(Request::segment(1))
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

        <div class="flex flex-col xl:flex-row gap-[30px]">

            <div
                class="relative gap-[20px] flex flex-col md:flex-col xl:flex-row w-full xl:w-[50%] items-center xl:items-start">
                <div
                    class="order-1 xl:order-2 relative w-full h-[300px] xl:h-[350px] flex px-[40px] sm:px-0 flex flex-row-reverse gap-[20px]">
                    <button onclick="toggleHeart(this)"
                        class="absolute top-6 right-16 sm:top-4 sm:right-4 xl:top-6 xl:left-[25rem] w-9 h-9 rounded-full bg-black/80 text-white flex items-center justify-center shadow z-10">
                        <i class="fa-solid fa-heart text-[13px] text-white"></i>
                    </button>

                    <img id="mainProductImage" src="{{ $productImages[0] }}" class="w-full">

                    <div
                        class="order-2 xl:order-1 flex flex-row xl:flex-col gap-3 xl:gap-6 overflow-x-auto xl:overflow-y-auto xl:overflow-x-hidden hide-scrollbar w-[74%] sm:w-[18%]">
                        @foreach($productImages as $index => $img)
                        <button onclick="changeMainImage('{{ $img }}', this)"
                            class="thumb-btn {{ $index === 0 ? 'border-white' : 'border-transparent' }} transition ">
                            <img src="{{ $img }}" class=" w-full rounded-[10px] ">
                        </button>
                        @endforeach
                    </div>
                </div>

                <div
                    class="order-2 xl:order-1 flex flex-row xl:flex-col gap-4 xl:gap-6 overflow-x-auto xl:overflow-y-auto xl:overflow-x-hidden md:hidden hide-scrollbar w-[77%] sm:w-[18%]">
                    @foreach($productImages as $index => $img)
                    <button onclick="changeMainImage('{{ $img }}', this)"
                        class="thumb-btn {{ $index === 0 ? 'border-white' : 'border-transparent' }} transition ">
                        <img src="{{ $img }}" class=" h-[60px] max-w-[60px] rounded-[10px] ">
                    </button>
                    @endforeach
                </div>



            </div>

            <div class="w-full sm:w-[50%] p-[15px] sm:p-0">

                <p class="text-[11px] text-white/60 mb-1">Brand: Polo</p>

                <h1 class="text-[22px] sm:text-[28px] font-medium">
                    Unisex Highneck Jacket
                </h1>

                <div class="flex items-end gap-2 mt-2">
                    <span class="text-[26px] font-semibold">₹120</span>
                    <span class="text-[13px] text-white/70 pb-[4px]">/piece</span>
                    <span class="text-[13px] text-white/60 pb-[4px]">4.5</span>
                </div>

                <div class="mt-6">
                    <p class="text-[11px] text-white/80 mb-3">Choose Color</p>

                    <div class="flex gap-2">
                        <div class="w-7 h-7 rounded-full border border-white bg-black"></div>
                        <div class="w-7 h-7 rounded-full bg-blue-500"></div>
                        <div class="w-7 h-7 rounded-full bg-yellow-400"></div>
                        <div class="w-7 h-7 rounded-full bg-cyan-400"></div>
                        <div class="w-7 h-7 rounded-full bg-red-500"></div>
                    </div>
                </div>

                <div class="mt-8">
                    <p class="text-[12px] mb-3 text-white/90">Upload Your Design/Logo*</p>

                    <label
                        class="group relative flex flex-col items-center justify-center h-[120px] w-full sm:w-[80%] rounded-xl border border-dashed border-white/30 bg-white/[0.02] cursor-pointer transition-all duration-300 hover:bg-white/[0.05] hover:border-white/50">

                        <div
                            class="mb-2 flex items-center justify-center w-10 h-10 rounded-full bg-white/10 group-hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-white/70 group-hover:text-white transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4-4a3 3 0 014 0l4 4m0 0l4-4M12 12V4m0 0l-3 3m3-3l3 3" />
                            </svg>
                        </div>

                        <p class="text-[12px] text-white/40 group-hover:text-white/70 transition">
                            Drop Design here or click to upload
                        </p>

                        <div
                            class="absolute inset-0 rounded-xl bg-white/5 opacity-0 group-hover:opacity-100 transition pointer-events-none">
                        </div>

                        <!-- INPUT -->
                        <input type="file" class="hidden" accept="image/*">
                    </label>
                </div>

                <!-- SIDE -->
                <div class="mt-5 w-[80%]">
                    <p class="text-[12px] mb-2">Side</p>

                    <div class="flex gap-3">
                        <button class="px-6 h-[34px] bg-white/10 rounded text-[12px]">Front</button>
                        <button class="px-6 h-[34px] bg-white/10 rounded text-[12px]">Back</button>
                        <button class="px-6 h-[34px] bg-white/10 rounded text-[12px]">Both</button>
                    </div>
                </div>

                <!-- PRINT TYPE -->
                <div class="mt-5 w-[80%]">
                    <p class="text-[12px] mb-2 text-white">Print Type</p>

                    <select
                        class="w-full h-[40px] bg-black border border-white/20 rounded px-4 text-[12px] text-white outline-none">

                        <option class="bg-black text-white">Embroidery</option>
                        <option class="bg-black text-white">Screen Print</option>

                    </select>
                </div>

                <!-- TABLE -->
                <div class="mt-7 border border-white/10 rounded-xl overflow-hidden w-[70%]">
                    <table class="w-full text-[12px]">
                        <thead class="border-b border-white/10">
                            <tr>
                                <th class="p-3 text-left">Quantity</th>
                                <th class="p-3 text-left border-l border-white/10">Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($priceRows as $row)
                            <tr class="border-b border-white/10">
                                <td class="p-3">{{ $row['qty'] }}</td>
                                <td class="p-3 border-l border-white/10">{{ $row['price'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

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

</section>

<script>
function toggleHeart(btn) {
    const icon = btn.querySelector('i');

    icon.classList.toggle('text-red-500');
    icon.classList.toggle('text-white');
}
</script>