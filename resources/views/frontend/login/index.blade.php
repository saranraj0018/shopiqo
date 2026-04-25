<section
    class="relative min-h-screen overflow-hidden bg-black text-white flex items-center justify-center px-[25px] md:px-4 py-10">

    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,255,255,0.08),transparent_45%)]">
        </div>
        <div
            class="absolute left-0 top-0 h-full w-[220px] bg-[linear-gradient(to_right,rgba(255,255,255,0.08),transparent)] blur-2xl">
        </div>
        <div
            class="absolute right-0 top-0 h-full w-[220px] bg-[linear-gradient(to_left,rgba(255,255,255,0.08),transparent)] blur-2xl">
        </div>
        <div class="absolute inset-0 bg-[linear-gradient(to_bottom,rgba(255,255,255,0.02),rgba(0,0,0,1))]"></div>
    </div>

    <div class="relative z-10 w-full max-w-6xl mx-auto text-center">

        <div class="flex justify-center mb-5">
            <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Logo" class="h-20 object-contain">
        </div>

        <h1 class="text-[26px] md:text-[40px] font-semibold tracking-[-0.02em]">
            Welcome to Shopiq
        </h1>
        <p class="mt-2 text-sm md:text-base text-white/65">
            Select your account type to get started
        </p>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 md:gap-6">

            <div
                class="rounded-[32px] border border-white/10 bg-white/[0.04] backdrop-blur-xl p-5 md:p-7 text-left shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] min-h-[340px] flex flex-col justify-between">
                <div>
                    <div
                        class="w-14 h-14 rounded-full border border-white/10 bg-white/10 flex items-center justify-center mb-6 md:mb-8">
                        <img src="{{ asset('assets/images/loginicon/Frame3.svg') }}" class="w-7 h-7">
                    </div>

                    <h3 class="text-[18px] md:text-[20px] font-semibold">Personal Buyer</h3>
                    <p class="mt-2 text-sm text-white/60">
                        Customers order custom products.
                    </p>

                    <div class="mt-6 md:mt-8 space-y-4">
                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Quick registration</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Personal orders</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Simple checkout</span>
                        </div>
                    </div>
                </div>

                <a href="/login/personal"
                    class=" mt-8 md:mt-10 w-full h-[48px] rounded-xl border border-white/10 bg-white/[0.03]
                    hover:bg-white/[0.06] transition flex items-center justify-center text-sm font-medium transition duration-300 hover:scale-[1.02]">
                    Get Started
                </a>

            </div>

            <div
                class="rounded-[32px] border border-white/15 bg-white/[0.05] backdrop-blur-xl p-5 md:p-7 text-left shadow-[0_0_0_1px_rgba(255,255,255,0.04),0_20px_60px_rgba(0,0,0,0.5),inset_0_1px_0_rgba(255,255,255,0.12)] min-h-[340px] flex flex-col justify-between relative">
                <div
                    class="absolute top-0 left-8 right-8 h-[1px] bg-gradient-to-r from-transparent via-white/70 to-transparent">
                </div>

                <div>
                    <div
                        class="w-14 h-14 rounded-full border border-white/10 bg-white/10 flex items-center justify-center mb-6 md:mb-8">
                        <img src="{{ asset('assets/images/loginicon/Frame2.svg') }}" class="w-7 h-7">
                    </div>

                    <h3 class="text-[18px] md:text-[20px] font-semibold">Business Buyer</h3>
                    <p class="mt-2 text-sm text-white/60">
                        Corporate customer for bulk orders
                    </p>

                    <div class="mt-6 md:mt-8 space-y-4">
                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Bulk pricing</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>GST invoices</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Credit terms</span>
                        </div>
                    </div>
                </div>

                <a href="/login/business"
                    class="mt-8 md:mt-10 w-full h-[48px] rounded-xl bg-white text-black hover:bg-white/90 transition flex items-center justify-center text-sm font-semibold shadow-[0_8px_20px_rgba(255,255,255,0.18)]">
                    Get Started
                </a>
            </div>

            <div
                class="rounded-[32px] border border-white/10 bg-white/[0.04] backdrop-blur-xl p-5 md:p-7 text-left shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] min-h-[340px] flex flex-col justify-between">
                <div>
                    <div
                        class="w-14 h-14 rounded-full border border-white/10 bg-white/10 flex items-center justify-center mb-6 md:mb-8">
                        <img src="{{ asset('assets/images/loginicon/Frame1.svg') }}" class="w-7 h-7">
                    </div>

                    <h3 class="text-[18px] md:text-[20px] font-semibold">Vendor</h3>
                    <p class="mt-2 text-sm text-white/60">
                        Sell your custom products on Shopiq
                    </p>

                    <div class="mt-6 md:mt-8 space-y-4">
                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Approval required</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>List products</span>
                        </div>

                        <div class="flex items-center gap-3 text-sm text-white/85">
                            <div
                                class="w-5 h-5 flex items-center justify-center rounded-full border border-white/20 bg-white/5">
                                <svg class="w-3 h-3 text-white/80" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span>Manage orders</span>
                        </div>
                    </div>
                </div>

                <a href="/login/vendor"
                    class="mt-8 md:mt-10 w-full h-[48px] rounded-xl border border-white/10 bg-white/[0.03] hover:bg-white/[0.06] transition flex items-center justify-center text-sm font-medium">
                    Get Started
                </a>
            </div>

        </div>

        <p class="mt-10 text-sm text-white/60">
            Not sure which account type?
            <a href="/contact" class="text-white font-semibold hover:text-white/80 transition">Contact us</a>
        </p>

    </div>
</section>