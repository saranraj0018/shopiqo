@php
$addresses = [
[
'title' => 'Office Address',
'name' => 'Tech Corp Ltd.',
'line1' => '123 Business Park, Sector 5',
'city' => 'Mumbai, Maharashtra 400001',
'phone' => '+91 98765 43210'
],
[
'title' => 'Home Address',
'name' => '456 Residential Complex',
'line1' => 'Andheri West',
'city' => 'Mumbai, Maharashtra 400053',
'phone' => '+91 98765 43210'
]
];
@endphp
<div
    class="w-full min-h-[690px] rounded-[16px] border border-white/20 bg-black px-4 md:px-5 py-4 md:py-5 text-white shadow-[0_0_30px_rgba(255,255,255,0.02)]">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[16px] font-medium text-white">Saved Addresses</h2>

    </div>

    @foreach($addresses as $address)
    <div class="mb-5">

        <p class="text-[12px] text-white mb-2">{{ $address['title'] }}</p>

        <div class="flex items-start gap-3">
            <div
                class="flex-1 min-h-[60px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 py-3 shadow-[inset_0_0_24px_rgba(255,255,255,0.06)]">

                <p class="text-[12px] leading-[1.55] text-white/80">
                    {{ $address['name'] }}<br>
                    {{ $address['line1'] }}<br>
                    {{ $address['city'] }}<br>
                    Phone: {{ $address['phone'] }}
                </p>

            </div>

            <div class="w-[56px] shrink-0 flex flex-col items-center gap-2 pt-2">
                <button type="button" onclick="openModal()"
                    class="w-full h-[28px] rounded-full border border-white/50 text-[12px] text-white hover:bg-white hover:text-black transition">
                    Edit
                </button>


                <!-- Modal -->
                <div id="editModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4 pt-6 opacity-0 transition-opacity duration-300 ease-out">

                    <div id="modalBox"
                        class="w-full max-w-[720px] mt-[20px] rounded-[16px] border border-white/15 bg-black px-5 py-5 text-white shadow-[0_0_30px_rgba(255,255,255,0.03)] relative transform scale-95 -translate-y-4 opacity-0 transition-all duration-300 ease-out">

                        <!-- Close -->
                        <button type="button" onclick="closeModal()"
                            class="absolute top-4 right-4 text-white/60 hover:text-white text-[18px] leading-none">
                            ×
                        </button>

                        <h3 class="text-[14px] font-medium mb-5">Edit Address</h3>

                        <form class="space-y-4">
                            <div class="flex flex-wrap mx-2 h-[70vh] overflow-auto lg:h-auto lg:overflow-visible">

                                <!-- Full Name -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">Full Name</label>
                                    <input type="text" placeholder="Enter Your Name"
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                </div>

                                <!-- Phone Number -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">Phone Number</label>
                                    <input type="text" placeholder="Enter Your Phone Number"
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                </div>

                                <!-- Country -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">Country</label>
                                    <select
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                        <option>Select Country</option>
                                    </select>
                                </div>

                                <!-- City -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">City</label>
                                    <select
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                        <option>Select City</option>
                                    </select>
                                </div>

                                <!-- State -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">State</label>
                                    <select
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                        <option>Select State</option>
                                    </select>
                                </div>

                                <!-- Zip Code -->
                                <div class="w-full md:w-1/2 px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">Zip Code</label>
                                    <input type="text" placeholder="Enter Zip Code"
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                </div>

                                <!-- Street Address -->
                                <div class="w-full px-2 mb-4">
                                    <label class="block text-[13px] text-white mb-2">Street Address</label>
                                    <input type="text" placeholder="Street Address"
                                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                                </div>

                                <div class="flex justify-center lg:justify-start w-[100%] mb-4 lg:mb-0">
                                    <button type="button"
                                        class=" w-[100%] sm:w-[60%] md:w-[40%] lg:w-[25%] h-[35px] rounded-full border border-white/50 text-[14px] text-white hover:bg-white hover:text-black transition">
                                        Edit Address
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <button class="text-[12px] text-white hover:text-white/80 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Add Address -->
    <div class="mt-7">
        <h3 class="text-[16px] font-medium text-white mb-5">Add Address</h3>

        <form class="space-y-4">
            <div>
                <label class="block text-[13px] text-white mb-2">Full Name</label>
                <input type="text" placeholder="Enter Your Name"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="w-full md:w-[92%]">
                <label class="block text-[13px] text-white mb-2">Country</label>

                <div class="relative">
                    <select
                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 pr-9 text-[13px] text-white outline-none appearance-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
                        <option>Select Country</option>
                    </select>

                    <!-- SVG inside -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white/35" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">Street Address</label>
                <input type="text" placeholder="Street Address"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">City</label>
                <input type="text" placeholder="Enter Your City"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="w-full md:w-[92%]">
                <label class="block text-[13px] text-white mb-2">State</label>

                <div class="relative">
                    <select
                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 pr-9 text-[13px] text-white outline-none appearance-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
                        <option>Select State</option>
                    </select>

                    <!-- SVG inside -->
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white/35" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">Zip Code</label>
                <input type="text" placeholder=" Enter Your Zip Code"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">Phone Number</label>
                <input type="text" placeholder="+91 90871 65342"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="flex justify-center lg:justify-start">
                <button type="button"
                    class="w-full sm:w-[60%] md:w-[40%] lg:w-[20%] h-[35px] rounded-full border border-white/50 text-[14px] bg-white text-black hover:bg-black hover:text-white transition">
                    Save New Address
                </button>
            </div>

        </form>
    </div>
</div>


<script>
function openModal() {
    const modal = document.getElementById('editModal');
    const modalBox = document.getElementById('modalBox');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        modal.classList.remove('opacity-0');

        modalBox.classList.remove('opacity-0', 'scale-95', '-translate-y-4');
        modalBox.classList.add('opacity-100', 'scale-100', 'translate-y-0');
    }, 100);
}

function closeModal() {
    const modal = document.getElementById('editModal');
    const modalBox = document.getElementById('modalBox');

    modal.classList.add('opacity-0');

    modalBox.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
    modalBox.classList.add('opacity-0', 'scale-95', '-translate-y-4');

    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>