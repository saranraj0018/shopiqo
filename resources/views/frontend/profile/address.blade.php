<div
    class="w-full min-h-[690px] rounded-[16px] border border-white/20 bg-black px-4 md:px-5 py-4 md:py-5 text-white shadow-[0_0_30px_rgba(255,255,255,0.02)]">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-[16px] font-medium text-white">Saved Addresses</h1>
    </div>

    <div id="addressList">
        @forelse($addresses as $address)
        <div class="mb-5" data-address-id="{{ $address->id }}">
            <p class="text-[12px] text-white/60 mb-2">{{ $address->address_type }}</p>

            <div class="flex items-start gap-3">
                <div
                    class="flex-1 min-h-[60px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 py-3 shadow-[inset_0_0_24px_rgba(255,255,255,0.06)]">
                    <p class="text-[12px] leading-[1.55] text-white/80">
                        {{ $address->name }}<br>
                        {{ $address->address }}<br>
                        {{ $address->city }}, {{ $address->state }} {{ $address->pincode }}<br>
                        Phone: {{ $address->phone_number }}
                    </p>
                </div>

                <div class="w-[56px] shrink-0 flex flex-col items-center gap-2 pt-2">
                    <button type="button"
                        onclick='openModal(@json($address))'
                        class="w-full h-[28px] rounded-full border border-white/50 text-[12px] text-white hover:bg-white hover:text-black transition">
                        Edit
                    </button>
                    <button type="button" onclick="deleteAddress({{ $address->id }})"
                        class="w-full h-[28px] rounded-full border border-white/20 text-[12px] text-white/70 hover:border-red-400 hover:text-red-400 transition">
                        Delete
                    </button>
                </div>
            </div>
        </div>
        @empty
        <p class="text-[13px] text-white/50 mb-5">No saved addresses yet. Add one below.</p>
        @endforelse
    </div>

    <!-- Edit Modal -->
    <div id="editModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4 pt-6 opacity-0 transition-opacity duration-300 ease-out">
        <div id="modalBox"
            class="w-full max-w-[720px] mt-[20px] rounded-[16px] border border-white/15 bg-black px-5 py-5 text-white shadow-[0_0_30px_rgba(255,255,255,0.03)] relative transform scale-95 -translate-y-4 opacity-0 transition-all duration-300 ease-out">
            <button type="button" onclick="closeModal()"
                class="absolute top-4 right-4 text-white/60 hover:text-white text-[18px] leading-none">
                ×
            </button>

            <h3 class="text-[14px] font-medium mb-5">Edit Address</h3>

            <p id="editAddressError" class="hidden mb-3 text-[12px] text-red-400"></p>

            <form id="editAddressForm" class="space-y-4">
                <input type="hidden" id="edit_address_id" name="address_id">
                <div class="flex flex-wrap mx-2 h-[70vh] overflow-auto lg:h-auto lg:overflow-visible">
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">Full Name</label>
                        <input type="text" id="edit_name" name="name" placeholder="Enter Your Name"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">Phone Number</label>
                        <input type="text" id="edit_phone_number" name="phone_number" placeholder="+91 90871 65342"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">Address Type</label>
                        <select id="edit_address_type" name="address_type"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">City</label>
                        <input type="text" id="edit_city" name="city" placeholder="City"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">State</label>
                        <input type="text" id="edit_state" name="state" placeholder="State"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">Zip Code</label>
                        <input type="text" id="edit_pincode" name="pincode" placeholder="Enter Zip Code"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="w-full px-2 mb-4">
                        <label class="block text-[13px] text-white mb-2">Street Address</label>
                        <input type="text" id="edit_address" name="address" placeholder="Street Address"
                            class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white outline-none">
                    </div>

                    <div class="flex justify-center lg:justify-start w-[100%] mb-4 lg:mb-0">
                        <button type="submit" id="editAddressSubmit"
                            class="w-[100%] sm:w-[60%] md:w-[40%] lg:w-[25%] h-[35px] rounded-full border border-white/50 text-[14px] text-white hover:bg-white hover:text-black transition">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Address -->
    <div class="mt-7">
        <h3 class="text-[16px] font-medium text-white mb-5">Add Address</h3>

        <p id="addAddressError" class="hidden mb-3 text-[13px] text-red-400"></p>

        <form id="addAddressForm" class="space-y-4">
            <div>
                <label class="block text-[13px] text-white mb-2">Full Name</label>
                <input type="text" name="name" placeholder="Enter Your Name"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="w-full md:w-[92%]">
                <label class="block text-[13px] text-white mb-2">Address Type</label>
                <div class="relative">
                    <select name="address_type"
                        class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 pr-9 text-[13px] text-white outline-none appearance-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                        <option value="Other">Other</option>
                    </select>
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
                <input type="text" name="address" placeholder="Street Address"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">City</label>
                <input type="text" name="city" placeholder="Enter Your City"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="w-full md:w-[92%]">
                <label class="block text-[13px] text-white mb-2">State</label>
                <input type="text" name="state" placeholder="Enter Your State"
                    class="w-full h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">Zip Code</label>
                <input type="text" name="pincode" placeholder="Enter Your Zip Code"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div>
                <label class="block text-[13px] text-white mb-2">Phone Number</label>
                <input type="text" name="phone_number" placeholder="+91 90871 65342"
                    class="w-full md:w-[92%] h-[42px] rounded-[6px] border border-white/10 bg-[#0a0a0a] px-3 text-[13px] text-white placeholder:text-white/25 outline-none shadow-[inset_0_0_20px_rgba(255,255,255,0.06)] focus:border-white/15">
            </div>

            <div class="flex justify-center lg:justify-start">
                <button type="submit" id="addAddressSubmit"
                    class="w-full sm:w-[60%] md:w-[40%] lg:w-[20%] h-[35px] rounded-full border border-white/50 text-[14px] bg-white text-black hover:bg-black hover:text-white transition">
                    Save New Address
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(address) {
    const modal = document.getElementById('editModal');
    const modalBox = document.getElementById('modalBox');

    document.getElementById('edit_address_id').value = address.id;
    document.getElementById('edit_name').value = address.name || '';
    document.getElementById('edit_phone_number').value = address.phone_number || '';
    document.getElementById('edit_address_type').value = address.address_type || 'Home';
    document.getElementById('edit_city').value = address.city || '';
    document.getElementById('edit_state').value = address.state || '';
    document.getElementById('edit_pincode').value = address.pincode || '';
    document.getElementById('edit_address').value = address.address || '';

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

document.getElementById('editModal').addEventListener('click', function (e) {
    if (e.target === this) closeModal();
});

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
});

function deleteAddress(id) {
    if (!confirm('Delete this address?')) return;
    showLoader();
    sendRequest('/profile/address/' + id + '/delete', {}, 'POST', function (res) {
        hideLoader();
        if (res.success) {
            showToast(res.message, 'success', 1500);
            setTimeout(() => window.location.reload(), 500);
        } else {
            showToast(res.message || 'Could not delete address.', 'error', 2500);
        }
    }, function (err) {
        hideLoader();
        showToast(err.message || 'Something went wrong.', 'error', 2500);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const addForm = document.getElementById('addAddressForm');
    const addError = document.getElementById('addAddressError');
    const addSubmit = document.getElementById('addAddressSubmit');

    addForm.addEventListener('submit', function (e) {
        e.preventDefault();
        addError.classList.add('hidden');
        addSubmit.disabled = true;
        showLoader();

        const formData = new FormData(addForm);

        sendRequest('/profile/address/add', formData, 'POST', function (res) {
            hideLoader();
            addSubmit.disabled = false;
            if (res.success) {
                showToast(res.message, 'success', 1500);
                setTimeout(() => window.location.reload(), 500);
            } else {
                addError.textContent = res.message;
                addError.classList.remove('hidden');
            }
        }, function (err) {
            hideLoader();
            addSubmit.disabled = false;
            addError.textContent = err.errors ? Object.values(err.errors)[0][0] : (err.message || 'Something went wrong.');
            addError.classList.remove('hidden');
        });
    });

    const editForm = document.getElementById('editAddressForm');
    const editError = document.getElementById('editAddressError');
    const editSubmit = document.getElementById('editAddressSubmit');

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        editError.classList.add('hidden');
        editSubmit.disabled = true;
        showLoader();

        const id = document.getElementById('edit_address_id').value;
        const formData = new FormData(editForm);

        sendRequest('/profile/address/' + id + '/update', formData, 'POST', function (res) {
            hideLoader();
            editSubmit.disabled = false;
            if (res.success) {
                showToast(res.message, 'success', 1500);
                setTimeout(() => window.location.reload(), 500);
            } else {
                editError.textContent = res.message;
                editError.classList.remove('hidden');
            }
        }, function (err) {
            hideLoader();
            editSubmit.disabled = false;
            editError.textContent = err.errors ? Object.values(err.errors)[0][0] : (err.message || 'Something went wrong.');
            editError.classList.remove('hidden');
        });
    });
});
</script>
