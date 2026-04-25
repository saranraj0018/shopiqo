    <section class="relative overflow-hidden bg-black text-white py-0 sm:py-8 px-[25px] sm:px-6 lg:px-8">

        <!-- Background glow -->
        <div class="absolute inset-0">
            <!-- <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.06),transparent_35%)]"> -->
            </div>
            <!-- <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom,rgba(0,120,255,0.10),transparent_30%)]"></div> -->
            <div
                class="absolute inset-0 opacity-20 bg-[linear-gradient(to_bottom,transparent,rgba(255,255,255,0.02),transparent)]">
            </div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto">

            <!-- Top badge -->
            <div class="flex justify-center mb-6">
                <span
                    class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs text-white/70 backdrop-blur-md shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
                    <span class="h-2 w-2 rounded-full bg-white/40"></span>
                    Browse by need
                </span>
            </div>

            <!-- Heading -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <h2 class="text-2xl sm:text-3xl lg:text-[38px]  leading-tight text-white">
                    Find the perfect gifts for every occasion
                    <br class="hidden sm:block">
                    and corporate need
                </h2>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- Card 1 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:border-white/15 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame.svg') }}" alt="Corporate events"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Corporate events</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for corporate events
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame1.svg') }}" alt="Employee onboarding"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Employee onboarding</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for employee onboarding
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame2.svg') }}" alt="Festivals & Diwali gifts"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Festivals &amp; Diwali gifts</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for festivals &amp; diwali gifts
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame3.svg') }}" alt="Client gifts"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Client gifts</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for client gifts
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame4.svg') }}" alt="Award ceremonies"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Award ceremonies</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for award ceremonies
                        </p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">

                            <img src="{{ asset('assets/images/heroicon/Frame5.svg') }}" alt="Trade shows"
                                class="h-5 w-5 object-contain opacity-90">
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">Trade shows</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for trade shows
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>