<div class="w-full rounded-[18px] border border-white/20 bg-black px-5 md:px-6 py-5 md:py-6 shadow-[0_0_30px_rgba(255,255,255,0.04)] relative overflow-hidden">
    <div
        class="hidden md:block absolute inset-y-0 right-0 w-[45%] bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_65%)] pointer-events-none">
    </div>
    <div class="relative z-10">
        <h2 class="text-white text-[24px] md:text-[28px] font-medium mb-6">Profile Information</h2>
        <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div class="w-[86px] h-[86px] rounded-full border border-white/25 overflow-hidden shrink-0">
                    <div
                        class="w-[86px] h-[86px] rounded-full border border-white/25 bg-white/5 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[42px] h-[42px] text-white/50"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c1.5-4 5-6 8-6s6.5 2 8 6" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap">
                        <label for="profile_photo"
                            class="inline-flex items-center justify-center h-[34px] px-4 rounded-full bg-white text-black text-[13px] font-medium cursor-pointer hover:bg-gray-200 transition">
                            Upload Photo
                        </label>

                        <input type="file" id="profile_photo" name="profile_photo" class="hidden">

                        <button type="button"
                            class="w-[36px] h-[36px] rounded-full border border-red-500/50 shadow-[0_0_10px_rgba(255,0,0,0.4)] flex items-center justify-center hover:scale-105 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px] text-red-400"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M9 3.75h6M10 8.25v7.5M14 8.25v7.5M4.5 6h15M6.75 6l.72 10.073A2.25 2.25 0 0 0 9.714 18.75h4.572a2.25 2.25 0 0 0 2.244-2.677L17.25 6M9.75 3.75 10.031 3A1.125 1.125 0 0 1 11.084 2.25h1.832A1.125 1.125 0 0 1 13.969 3l.281.75"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-white/45 text-[13px] leading-5 mt-3">
                        Make sure the image is at least 400×400px <br class="hidden sm:block">
                        and under 5 MB.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-white text-[15px] font-medium mb-2">Full Name</label>
                    <input type="text" placeholder="John Doe"
                        class="w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
                </div>

                <div>
                    <label class="block text-white text-[15px] font-medium mb-2">Email</label>
                    <input type="email" placeholder="john@example.com"
                        class="w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
                </div>
            </div>

            <div>
                <label class="block text-white text-[15px] font-medium mb-2">Phone Number</label>
                <input type="text" placeholder="+91 98765 43210"
                    class="w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>

            <div>
                <label class="block text-white text-[15px] font-medium mb-2">Company Name (Optional)</label>
                <input type="text" placeholder="Your company name"
                    class="w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>

            <div>
                <label class="block text-white text-[15px] font-medium mb-2">GST Number (Optional)</label>
                <input type="text" placeholder="GSTIN"
                    class="w-full h-[44px] rounded-[8px] border border-white/15 bg-white/[0.04] px-4 text-white text-[14px] placeholder:text-white/30 outline-none focus:border-white/30 shadow-[inset_0_1px_6px_rgba(255,255,255,0.08)]">
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="min-w-[140px] h-[44px] px-6 rounded-full bg-white text-black text-[14px] font-medium hover:bg-gray-200 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
