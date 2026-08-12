@extends('frontend.loginapp')
<style>
    .tab-btn {
        transition: color 0.3s ease;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .form-panel {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .active-form {
        opacity: 1;
        transform: translateY(0);
        display: block;
    }

    .hidden-form {
        opacity: 0;
        transform: translateY(10px);
        display: none;
    }
</style>
@section('content')
    <section
        class="h-screen overflow-y-auto no-scrollbar bg-black text-white px-[25px] py-8 flex items-start justify-center">
        <div class="w-full max-w-[420px]">
            <div class="flex items-center gap-3 mb-5">
                <a href="/login" class="text-[15px] font-medium">
                    <button type="button" class="text-white text-xl leading-none">&#8592;</button>
                    Change account type
                </a>
            </div>
            <div
                class="rounded-[22px] border border-white/10 bg-white/[0.04] backdrop-blur-xl px-5 py-7 shadow-[inset_0_1px_0_rgba(255,255,255,0.06)]">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Shopiq Logo"
                        class="h-[70px] object-contain">
                </div>
                <div class="text-center">
                    <h2 id="formTitle" class="text-[20px] font-semibold transition-all duration-300">Welcome Back!</h2>
                    <p id="formSubtitle" class="mt-2 text-[13px] text-white/65 transition-all duration-300">
                        Sign in to your personal buyer account
                    </p>
                </div>
                <div class="mt-7">
                    <div class="relative rounded-[12px] bg-white/20 p-1 flex">
                        <span id="tabIndicator"
                            class="absolute top-1 left-1 h-[44px] w-[calc(50%-4px)] rounded-[10px] bg-[linear-gradient(to_bottom,#f4f4f4,#d9d9d9)] shadow-[inset_0_1px_0_rgba(255,255,255,0.8),0_2px_8px_rgba(255,255,255,0.08)] transition-all duration-300 ease-in-out">
                        </span>
                        <button id="loginTab" type="button"
                            class="tab-btn relative z-10 w-1/2 h-[44px] rounded-[10px] text-[14px] font-medium text-black">
                            Login
                        </button>
                        <button id="signupTab" type="button"
                            class="tab-btn relative z-10 w-1/2 h-[44px] rounded-[10px] text-[14px] font-medium text-white/85">
                            Signup
                        </button>
                    </div>
                </div>
                <div class="relative mt-6">
                    <form id="personalloginForm" class="form-panel active-form space-y-5" method="POST" action="">
                        @csrf
                        <div>
                            <label class="block text-[14px] font-medium mb-2">Email Address</label>
                            <input type="email" placeholder="your@email.com" id="email" name="email"
                                class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
                        </div>
                        <div class="relative">
    <label class="block text-[14px] font-medium mb-2">Password</label>
    <div class="relative">
        <input type="password" placeholder="Password" id="password" name="password"
            class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 pr-11 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
        <button type="button" onclick="togglePassword()"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-purple-400 hover:text-purple-200 transition">
            <!-- Eye Open -->
            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Eye Closed -->
            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="hidden">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M6.938 6.938A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.48 5.587M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
            </svg>
        </button>
    </div>
</div>
                        <button type="submit" id="login_personal_form"
                            class="w-full h-[46px] rounded-full bg-white text-black text-[14px] font-semibold hover:bg-white/90 transition flex items-center justify-center">
                            Submit Request
                        </button>
                        <p class="text-center text-[14px] text-white/65">
                            Don’t have an account?
                            <button type="button" id="bottomSignupBtn" class="text-white font-medium">Sign Up</button>
                        </p>
                    </form>
                    <form id="personalsignupForm" class="form-panel hidden-form space-y-5" method="POST">
                        @csrf
                        <input type="hidden" name="buyer_type" id="buyer_type" value="personal">
                        <div>
                            <label class="block text-[14px] font-medium mb-2">Full Name</label>
                            <input type="text" placeholder="Enter your full name" id="full_name" name="full_name"
                                class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
                        </div>
                        <div>
                            <label class="block text-[14px] font-medium mb-2">Email Address</label>
                            <input type="email" placeholder="your@email.com" id="email" name="email"
                                class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
                        </div>
                        <div>
                            <label class="block text-[14px] font-medium mb-2">Phone Number</label>
                            <input type="text" placeholder="+91 98765 43210" id="phone_number" name="phone_number"
                                class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
                        </div>
                        <div>
                            <label class="block text-[14px] font-medium mb-2">Password</label>
                            <input type="password" placeholder="Create a strong password" id="password" name="password"
                                class="w-full h-[42px] rounded-[8px] border border-white/15 bg-white/[0.03] px-4 text-[13px] text-white placeholder:text-white/30 outline-none shadow-[inset_0_8px_20px_rgba(255,255,255,0.04)] focus:border-white/25">
                            <input type="hidden" name="password_confirmation" id="password_confirmation">
                        </div>
                        <button type="submit" id="save_personal_login"
                            class="w-full h-[46px] rounded-full bg-white text-black text-[14px] font-semibold hover:bg-white/90 transition flex items-center justify-center">
                            Submit Request
                        </button>
                        <p class="text-center text-[14px] text-white/65">
                            Already have an account?
                            <button type="button" id="bottomLoginBtn" class="text-white font-medium">Login</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('admin/js/login.js') }}?v={{ time() }}"></script>
@endsection
