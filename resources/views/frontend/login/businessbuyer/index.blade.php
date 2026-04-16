@extends('frontend.loginapp')

@section('content')
<section
    class="h-screen overflow-y-auto no-scrollbar bg-black text-white px-[25px] py-8 flex items-start justify-center">
    <div class="w-full max-w-[420px]">
        <!-- Top back -->
        <div class="flex items-center gap-3 mb-5">
            <button type="button" class="text-white text-xl leading-none">&#8592;</button>
            <a href="/login" class="text-[15px] font-medium">
                Change account type
            </a>
        </div>

        <!-- Card -->
        <div
            class="rounded-[22px] border border-white/10 bg-white/[0.04] backdrop-blur-xl px-5 py-7 shadow-[inset_0_1px_0_rgba(255,255,255,0.06)]">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Shopiq Logo"
                    class="h-[70px] object-contain">
            </div>

            <!-- Title -->
            <div class="text-center">
                <h2 id="formTitle" class="text-[20px] font-semibold transition-all duration-300">
                    Welcome Back!
                </h2>
                <p id="formSubtitle" class="mt-2 text-[13px] text-white/65 transition-all duration-300">
                    Sign in to your business buyer account
                </p>
            </div>

            <!-- Tabs -->
            <div class="mt-7">
                <div class="relative rounded-[12px] bg-white/20 p-1 flex">
                    <div id="tabIndicator"
                        class="absolute top-1 left-1 h-[44px] w-[calc(50%-4px)] rounded-[10px] bg-gradient-to-b from-[#f4f4f4] to-[#d9d9d9] transition-all duration-300 ease-in-out shadow-[inset_0_1px_0_rgba(255,255,255,0.8),0_2px_8px_rgba(255,255,255,0.08)]">
                    </div>

                    <button id="loginTab" type="button"
                        class="relative z-10 w-1/2 h-[44px] rounded-[10px] text-[14px] font-medium text-black transition-all duration-300">
                        Login
                    </button>

                    <button id="signupTab" type="button"
                        class="relative z-10 w-1/2 h-[44px] rounded-[10px] text-[14px] font-medium text-white/85 transition-all duration-300">
                        Sign Up
                    </button>
                </div>
            </div>

            <!-- Forms Wrapper -->
            <div class="relative mt-6">
                <!-- Login Form -->
                <form id="loginForm" class="form-panel active-form space-y-5">
                    <div>
                        <label class="block text-[14px] font-medium mb-2">Email Address</label>
                        <input type="email" placeholder="your@email.com" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Password</label>
                        <input type="password" placeholder="Password" class="input-style">
                    </div>

                    <div class="flex justify-end -mt-2">
                        <a href="#" class="text-[14px] text-white/85 hover:text-white transition">
                            Forgot Password?
                        </a>
                    </div>

                    <a href="/"
                        class="w-full h-[46px] rounded-full bg-white text-black text-[14px] font-semibold hover:bg-white/90 transition flex items-center justify-center">
                        Submit Request
                    </a>

                    <p class="text-center text-[14px] text-white/65">
                        Don’t have an account?
                        <button type="button" id="bottomSignupBtn" class="text-white font-medium">
                            Sign Up
                        </button>
                    </p>
                </form>

                <!-- Signup Form -->
                <form id="signupForm" class="form-panel hidden-form space-y-5">
                    <div>
                        <label class="block text-[14px] font-medium mb-2">Full Name</label>
                        <input type="text" placeholder="Enter your full name" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Email Address</label>
                        <input type="email" placeholder="your@email.com" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Phone Number</label>
                        <input type="text" placeholder="+91 98765 43210" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Password</label>
                        <input type="password" placeholder="Create a strong password" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Company Name</label>
                        <input type="text" placeholder="Your Company Pvt. Ltd." class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">Designation</label>
                        <input type="text" placeholder="Manager" class="input-style">
                    </div>

                    <div>
                        <label class="block text-[14px] font-medium mb-2">GST Number (Optional)</label>
                        <input type="text" placeholder="GST123456" class="input-style">
                    </div>

                    <a href="/"
                        class="w-full h-[46px] rounded-full bg-white text-black text-[14px] font-semibold hover:bg-white/90 transition flex items-center justify-center">
                        Create Account
                    </a>

                    <p class="text-center text-[14px] text-white/65">
                        Already have an account?
                        <button type="button" id="bottomLoginBtn" class="text-white font-medium">
                            Login
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.input-style {
    width: 100%;
    height: 42px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    background: rgba(255, 255, 255, 0.03);
    padding: 0 16px;
    font-size: 13px;
    color: white;
    outline: none;
    box-shadow: inset 0 8px 20px rgba(255, 255, 255, 0.04);
    transition: all 0.3s ease;
}

.input-style::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.input-style:focus {
    border-color: rgba(255, 255, 255, 0.25);
    background: rgba(255, 255, 255, 0.05);
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

<script>
const loginTab = document.getElementById('loginTab');
const signupTab = document.getElementById('signupTab');

const loginForm = document.getElementById('loginForm');
const signupForm = document.getElementById('signupForm');

const formTitle = document.getElementById('formTitle');
const formSubtitle = document.getElementById('formSubtitle');

const bottomSignupBtn = document.getElementById('bottomSignupBtn');
const bottomLoginBtn = document.getElementById('bottomLoginBtn');

const tabIndicator = document.getElementById('tabIndicator');

function showLogin() {
    tabIndicator.style.transform = 'translateX(0%)';

    loginTab.classList.remove('text-white/85');
    loginTab.classList.add('text-black');

    signupTab.classList.remove('text-black');
    signupTab.classList.add('text-white/85');

    signupForm.classList.remove('active-form');
    signupForm.classList.add('hidden-form');

    setTimeout(() => {
        signupForm.style.display = 'none';
        loginForm.style.display = 'block';

        setTimeout(() => {
            loginForm.classList.remove('hidden-form');
            loginForm.classList.add('active-form');
        }, 20);
    }, 150);

    formTitle.textContent = 'Welcome Back!';
    formSubtitle.textContent = 'Sign in to your business buyer account';
}

function showSignup() {
    tabIndicator.style.transform = 'translateX(100%)';

    signupTab.classList.remove('text-white/85');
    signupTab.classList.add('text-black');

    loginTab.classList.remove('text-black');
    loginTab.classList.add('text-white/85');

    loginForm.classList.remove('active-form');
    loginForm.classList.add('hidden-form');

    setTimeout(() => {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';

        setTimeout(() => {
            signupForm.classList.remove('hidden-form');
            signupForm.classList.add('active-form');
        }, 20);
    }, 150);

    formTitle.textContent = 'Create Your Account';
    formSubtitle.textContent = 'Sign up for your business buyer account';
}

loginTab.addEventListener('click', showLogin);
signupTab.addEventListener('click', showSignup);
bottomSignupBtn.addEventListener('click', showSignup);
bottomLoginBtn.addEventListener('click', showLogin);

loginForm.style.display = 'block';
signupForm.style.display = 'none';
</script>
@endsection