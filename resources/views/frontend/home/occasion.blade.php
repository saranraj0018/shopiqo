    <section class="relative overflow-hidden bg-black text-white py-0 sm:py-8 px-[25px] sm:px-6 lg:px-8">

        <!-- Background glow -->
        <div class="absolute inset-0">
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
                @forelse ($occasions as $occasion)
                <div
                    class="group relative rounded-2xl p-[1px] bg-[linear-gradient(135deg,rgba(255,255,255,0.18),rgba(255,255,255,0.05),rgba(255,255,255,0.16))] shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">
                    <div
                        class="relative h-full rounded-2xl bg-[linear-gradient(180deg,rgba(10,10,12,0.95),rgba(7,10,14,0.98))] px-5 py-6 backdrop-blur-xl transition duration-300 group-hover:border-white/15 group-hover:bg-[linear-gradient(180deg,rgba(12,12,16,0.96),rgba(8,12,18,1))]">
                        <div
                            class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] shadow-[inset_0_1px_0_rgba(255,255,255,0.08)]">
                            @if ($occasion->icon)
                                <img src="{{ asset('storage/' . $occasion->icon) }}" alt="{{ $occasion->name }}"
                                    class="h-5 w-5 object-contain opacity-90">
                            @else
                                <img src="{{ asset('assets/images/heroicon/Frame.svg') }}" alt="{{ $occasion->name }}"
                                    class="h-5 w-5 object-contain opacity-90">
                            @endif
                        </div>

                        <h3 class="text-xl font-medium text-white mb-2">{{ $occasion->name }}</h3>
                        <p class="text-sm text-white/45 leading-6">
                            Curated products for {{ \Illuminate\Support\Str::lower($occasion->name) }}
                        </p>
                    </div>
                </div>
                @empty
                {{-- No active occasions configured in admin yet --}}
                @endforelse
            </div>
        </div>
    </section>
