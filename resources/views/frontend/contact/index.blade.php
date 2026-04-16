<section
    class="relative bg-black text-white overflow-hidden flex items-center justify-center px-[25px] pt-[10rem] pb-[4rem]">

    <!-- background glow -->
    <div class="absolute pointer-events-none">
        <div class="absolute top-[12%] left-[8%] w-[260px] h-[260px] bg-white/5 blur-[140px] rounded-full"></div>
        <div class="absolute top-[18%] right-[10%] w-[260px] h-[260px] bg-white/5 blur-[140px] rounded-full"></div>
        <div class="absolute bottom-[10%] left-[10%] w-[220px] h-[220px] bg-white/5 blur-[140px] rounded-full"></div>
        <div class="absolute bottom-[12%] right-[12%] w-[220px] h-[220px] bg-white/5 blur-[140px] rounded-full"></div>
    </div>

    <div class="relative z-10 w-full max-w-3xl">
        <!-- top badge -->
        <div class="flex justify-center mb-4">
            <span
                class="px-4 py-1.5 text-[12px] text-white/80 rounded-full border border-white/10 bg-white/5 backdrop-blur-md">
                ∘ Contact
            </span>
        </div>

        <!-- title -->
        <div class="text-center mb-10">
            <h2 class="text-[32px] sm:text-[42px] md:text-[56px] leading-none font-light tracking-[-0.03em]">
                Get in Touch with Us
            </h2>
            <p class="mt-4 text-[13px] sm:text-[14px] text-white/55 max-w-md mx-auto leading-relaxed">
                Have questions or need AI solutions? Let us know by
                filling out the form, and we’ll be in touch!
            </p>
        </div>

        <!-- top cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div
                class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl px-5 py-4
    shadow-[inset_0_1px_0_rgba(255,255,255,0.25),inset_0_-1px_0_rgba(255,255,255,0.05),inset_0_0_30px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-2 text-white text-sm font-medium">
                    <span
                        class="w-5 h-5 rounded-full border border-white/15 flex items-center justify-center text-[10px]">
                        ✉
                    </span>
                    Phone
                </div>

                <p class="mt-2 text-sm text-white/70">+91 78564 23412</p>

            </div>

            <div
                class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl px-5 py-4
    shadow-[inset_0_1px_0_rgba(255,255,255,0.25),inset_0_-1px_0_rgba(255,255,255,0.05),inset_0_0_30px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-2 text-white text-sm font-medium">
                    <span
                        class="w-5 h-5 rounded-full border border-white/15 flex items-center justify-center text-[10px]">
                        ✉
                    </span>
                    E-Mail
                </div>

                <p class="mt-2 text-sm text-white/70">Admin@xtract.com</p>

            </div>
        </div>

        <!-- form -->
        <form class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white mb-2">First Name</label>
                    <input type="text" placeholder="Enter Your First Name"
                        class="w-full h-[46px] rounded-lg border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/25 outline-none focus:border-white/20">
                </div>

                <div>
                    <label class="block text-sm text-white mb-2">Last Name</label>
                    <input type="text" placeholder="Enter Your Last Name"
                        class="w-full h-[46px] rounded-lg border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/25 outline-none focus:border-white/20">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white mb-2">Email</label>
                    <input type="email" placeholder="Enter Your Email"
                        class="w-full h-[46px] rounded-lg border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/25 outline-none focus:border-white/20">
                </div>

                <div>
                    <label class="block text-sm text-white mb-2">Phone</label>
                    <input type="text" placeholder="Enter Your Phone Number"
                        class="w-full h-[46px] rounded-lg border border-white/10 bg-white/5 px-4 text-sm text-white placeholder:text-white/25 outline-none focus:border-white/20">
                </div>
            </div>

            <div>
                <label class="block text-sm text-white mb-2">Message</label>
                <textarea rows="4" placeholder="Hi, I am jane i want help"
                    class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-white/25 outline-none resize-none focus:border-white/20"></textarea>
            </div>

            <button type="submit"
                class="w-full h-[46px] rounded-lg bg-white text-black text-sm font-medium hover:bg-white/90 transition">
                Submit
            </button>
        </form>
    </div>
</section>