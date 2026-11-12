<div class="w-full rounded-[18px] border border-white/20 bg-black px-5 md:px-6 py-5 md:py-6 shadow-[0_0_30px_rgba(255,255,255,0.04)] relative overflow-hidden">
    <div
        class="hidden md:block absolute inset-y-0 right-0 w-[45%] bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_65%)] pointer-events-none">
    </div>
    <div class="relative z-10">
        <h2 class="text-white text-[24px] md:text-[28px] font-medium mb-6">Profile Information</h2>
        <p id="profileFormError" class="hidden mb-4 text-[13px] text-red-400"></p>
        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-[86px] h-[86px] rounded-full border border-white/25 overflow-hidden shrink-0">
                    <div id="avatarPreviewWrap"
                        class="w-[86px] h-[86px] rounded-full border border-white/25 bg-white/5 flex items-center justify-center overflow-hidden">
                        @if($user->image)
                        <img id="avatarPreview" src="{{ asset('storage/' . $user->image) }}"
                            onclick="openAvatarZoom(this.src)"
                            class="w-full h-full rounded-full object-cover object-center cursor-zoom-in hover:opacity-80 transition" alt="{{ $user->name }}">
                        @else
                        <svg id="avatarPlaceholder" xmlns="http://www.w3.org/2000/svg" class="w-[42px] h-[42px] text-white/50"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c1.5-4 5-6 8-6s6.5 2 8 6" stroke-linecap="round" />
                        </svg>
                        <img id="avatarPreview" onclick="openAvatarZoom(this.src)"
                            class="hidden w-full h-full rounded-full object-cover object-center cursor-zoom-in hover:opacity-80 transition" alt="{{ $user->name }}">
                        @endif
                    </div>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <label for="profile_photo"
                            class="inline-flex items-center justify-center h-[34px] px-4 rounded-full bg-white text-black text-[13px] font-medium cursor-pointer hover:bg-gray-200 transition">
                            Upload Photo
                        </label>

                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden">
                    </div>

                    <p class="text-white/45 text-[13px] leading-5 mt-3">
                        Make sure the image is at least 400×400px <br class="hidden sm:block">
                        and under 2 MB.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-white text-[15px] font-medium mb-2">Full Name <span class="text-red-400">*</span></label>
                    <input type="text" id="profile_full_name" name="full_name" value="{{ $user->name }}" placeholder="John Doe"
                        class="profile-required-field w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
                </div>

                <div>
                    <label class="block text-white text-[15px] font-medium mb-2">Email <span class="text-red-400">*</span></label>
                    <input type="email" id="profile_email" name="email" value="{{ $user->email }}" placeholder="john@example.com"
                        class="profile-required-field w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
                </div>
            </div>

            <div>
                <label class="block text-white text-[15px] font-medium mb-2">Phone Number <span class="text-red-400">*</span></label>
                <input type="text" id="profile_phone_number" name="phone_number" value="{{ $user->phone }}" placeholder="+91 98765 43210"
                    class="profile-required-field w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>

            @if($user->buyer_type === 'business')
            <div>
                <label class="block text-white text-[15px] font-medium mb-2">Company Name <span class="text-red-400">*</span></label>
                <input type="text" id="profile_company_name" name="company_name" value="{{ $user->company_name }}" placeholder="Your company name"
                    class="profile-required-field w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>

            <div>
                <label class="block text-white text-[15px] font-medium mb-2">GST Number <span class="text-red-400">*</span></label>
                <input type="text" id="profile_gst_number" name="gst_number" value="{{ $user->gst_number }}" placeholder="GSTIN"
                    class="profile-required-field w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>
            @endif

            <div class="pt-2">
                <button type="submit" id="saveProfileBtn"
                    class="min-w-[140px] h-[44px] px-6 rounded-full bg-white text-black text-[14px] font-medium hover:bg-gray-200 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('profileForm');
    if (!form) return;

    const errorEl = document.getElementById('profileFormError');
    const submitBtn = document.getElementById('saveProfileBtn');
    const photoInput = document.getElementById('profile_photo');
    const preview = document.getElementById('avatarPreview');
    const placeholder = document.getElementById('avatarPlaceholder');

    photoInput.addEventListener('change', function () {
        const file = photoInput.files[0];
        if (!file) return;

        const MAX_PHOTO_BYTES = 2 * 1024 * 1024; // matches server's upload_max_filesize (2M)
        if (file.size > MAX_PHOTO_BYTES) {
            errorEl.textContent = 'Photo is too large — max size is 2 MB.';
            errorEl.classList.remove('hidden');
            photoInput.value = '';
            return;
        }
        errorEl.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });

    const requiredFields = form.querySelectorAll('.profile-required-field');

    function markInvalid(field) {
        field.classList.remove('border-white/15', 'focus:border-white/30');
        field.classList.add('border-red-500', 'focus:border-red-500');
    }

    function clearInvalid(field) {
        field.classList.remove('border-red-500', 'focus:border-red-500');
        field.classList.add('border-white/15', 'focus:border-white/30');
    }

    requiredFields.forEach(function (field) {
        field.addEventListener('input', function () {
            if (field.value.trim()) clearInvalid(field);
        });
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        errorEl.classList.add('hidden');

        let firstInvalid = null;
        requiredFields.forEach(function (field) {
            if (!field.value.trim()) {
                markInvalid(field);
                if (!firstInvalid) firstInvalid = field;
            } else {
                clearInvalid(field);
            }
        });

        if (firstInvalid) {
            errorEl.textContent = 'Please fill in all required fields.';
            errorEl.classList.remove('hidden');
            firstInvalid.focus();
            return;
        }

        submitBtn.disabled = true;
        showLoader();

        const formData = new FormData(form);
        sendRequest(form.action, formData, 'POST', function (res) {
            hideLoader();
            submitBtn.disabled = false;
            if (res.success) {
                showToast(res.message, 'success', 2000);
            } else {
                errorEl.textContent = res.message;
                errorEl.classList.remove('hidden');
            }
        }, function (err) {
            hideLoader();
            submitBtn.disabled = false;

            if (err.errors) {
                const fieldMap = {
                    full_name: 'profile_full_name',
                    email: 'profile_email',
                    phone_number: 'profile_phone_number',
                    company_name: 'profile_company_name',
                    gst_number: 'profile_gst_number',
                };
                Object.keys(err.errors).forEach(function (key) {
                    const field = document.getElementById(fieldMap[key]);
                    if (field) markInvalid(field);
                });
                errorEl.textContent = Object.values(err.errors)[0][0];
            } else {
                errorEl.textContent = err.message || 'Something went wrong.';
            }
            errorEl.classList.remove('hidden');
        });
    });
});
</script>
