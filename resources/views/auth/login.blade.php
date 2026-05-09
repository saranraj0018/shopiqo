<x-layouts.auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .sq-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f4f8;
            padding: 1.5rem;
            font-family: 'DM Sans', sans-serif;
            height: 100dvh;
            /* exact viewport height, no overflow */
            padding: 1rem;
            /* reduced padding */
            overflow: hidden;
            /* prevent any bleed */
        }

        /* ── Card ─────────────────────────────────────── */
        .sq-card {
            display: flex;
            width: 100%;
            max-width: 900px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(11, 37, 69, 0.14);
            animation: sq-fadeup 0.5s ease both;
        }

        @keyframes sq-fadeup {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Left panel ───────────────────────────────── */
        .sq-left {
            width: 42%;
            background: #0b2545;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .sq-left-circle1 {
            position: absolute;
            top: -70px;
            right: -70px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .sq-left-circle2 {
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .sq-left-circle3 {
            position: absolute;
            bottom: 80px;
            right: -30px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sq-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            z-index: 1;
            animation: sq-fadeup 0.6s 0.1s ease both;
        }

        .sq-logo-mark {
            width: 64px;
            height: 64px;
            background: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sq-brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 30px;
            color: white;
            letter-spacing: -0.5px;
        }

        .sq-brand-name span {
            color: #7CB3FF;
        }

        .sq-tagline {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .sq-features {
            margin-top: 2.5rem;
            z-index: 1;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            animation: sq-fadeup 0.6s 0.2s ease both;
        }

        .sq-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.65);
        }

        .sq-feature-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #7CB3FF;
            flex-shrink: 0;
        }

        /* ── Right panel ──────────────────────────────── */
        .sq-right {
            width: 58%;
            background: #ffffff;
            padding: 2.75rem 2.75rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .sq-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 500;
            background: #EEF4FF;
            color: #134074;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 1.1rem;
            letter-spacing: 0.02em;
            width: fit-content;
        }

        .sq-welcome {
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            color: #0b2545;
            letter-spacing: -0.3px;
            margin-bottom: 4px;
        }

        .sq-sub {
            font-size: 13.5px;
            color: #6b7a8d;
            margin-bottom: 2rem;
        }

        /* ── Form fields ──────────────────────────────── */
        .sq-field {
            margin-bottom: 1.1rem;
        }

        .sq-label {
            display: block;
            font-size: 11.5px;
            font-weight: 500;
            color: #6b7a8d;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .sq-input-wrap {
            position: relative;
        }

        .sq-input {
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            padding: 11px 14px;
            padding-right: 42px;
            border: 1.5px solid #dde3ec;
            border-radius: 10px;
            background: #f8fafc;
            color: #0b2545;
            outline: none;
            transition: border-color 0.18s, background 0.18s, box-shadow 0.18s;
        }

        .sq-input::placeholder {
            color: #aab4c0;
        }

        .sq-input:focus {
            border-color: #134074;
            background: #ffffff;
            box-shadow: 0 0 0 3.5px rgba(19, 64, 116, 0.1);
        }

        .sq-input-icon {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab4c0;
            font-size: 17px;
            line-height: 1;
        }

        .sq-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aab4c0;
            font-size: 17px;
            line-height: 1;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.15s;
        }

        .sq-toggle-btn:hover {
            color: #134074;
        }

        /* ── Field row: label + forgot ────────────────── */
        .sq-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 7px;
        }

        .sq-forgot {
            font-size: 12px;
            color: #134074;
            text-decoration: none;
            font-weight: 500;
        }

        .sq-forgot:hover {
            text-decoration: underline;
        }

        /* ── Error messages ───────────────────────────── */
        .sq-error {
            font-size: 12px;
            color: #c0392b;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── Submit button ────────────────────────────── */
        .sq-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #0b2545;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14.5px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.18s, transform 0.12s;
            letter-spacing: 0.01em;
        }

        .sq-btn:hover:not(:disabled) {
            background: #134074;
        }

        .sq-btn:active:not(:disabled) {
            transform: scale(0.99);
        }

        .sq-btn:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }

        /* Spinner */
        .sq-spinner {
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(255, 255, 255, 0.35);
            border-top-color: white;
            border-radius: 50%;
            animation: sq-spin 0.7s linear infinite;
            flex-shrink: 0;
        }

        @keyframes sq-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ── Divider ──────────────────────────────────── */
        .sq-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 1.4rem 0;
            font-size: 12px;
            color: #aab4c0;
        }

        .sq-divider::before,
        .sq-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #edf0f4;
        }

        /* ── Footer ───────────────────────────────────── */
        .sq-footer {
            font-size: 13.5px;
            text-align: center;
            color: #6b7a8d;
        }

        .sq-footer a {
            color: #13315c;
            font-weight: 500;
            text-decoration: none;
        }

        .sq-footer a:hover {
            text-decoration: underline;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 680px) {
            .sq-left {
                display: none;
            }

            .sq-right {
                overflow-y: auto;
                /* add this */
                padding: 2.25rem 2.5rem;
                /* slightly reduced */
            }

            .sq-card {
                border-radius: 16px;
            }
        }
    </style>
    <div class="sq-page">
        <div class="sq-card">
            <div class="sq-left">
                <div class="sq-left-circle1"></div>
                <div class="sq-left-circle2"></div>
                <div class="sq-left-circle3"></div>
                <div class="sq-brand">
                    <div class="sq-logo-mark">
                        <img src="{{ asset('assets/images/Shopiqologo.svg') }}" alt="Shopiqo"
                            style="height: 38px; width: auto; object-fit: contain;">
                    </div>
                    <div class="sq-brand-name">Shopiq<span>o</span></div>
                    <div class="sq-tagline">Admin Dashboard</div>
                </div>
                <div class="sq-features">
                    <div class="sq-feature">
                        <div class="sq-feature-dot"></div>
                        Manage orders & inventory
                    </div>
                    <div class="sq-feature">
                        <div class="sq-feature-dot"></div>
                        Real-time analytics
                    </div>
                    <div class="sq-feature">
                        <div class="sq-feature-dot"></div>
                        Customer insights
                    </div>
                    <div class="sq-feature">
                        <div class="sq-feature-dot"></div>
                        Secure & role-based access
                    </div>
                </div>
            </div>
            {{-- ── Right panel ── --}}
            <div class="sq-right">
                <div class="sq-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    Secure login
                </div>
                <h2 class="sq-welcome">Welcome back</h2>
                <p class="sq-sub">Sign in to your Shopiqo dashboard</p>
                <form method="POST" action="{{ route('admin.authenticate') }}" x-data="{ showPw: false, loading: false }"  @submit="loading = true" novalidate>
                    @csrf
                    {{-- Email --}}
                    <div class="sq-field">
                        <label class="sq-label" for="email">Email address</label>
                        <div class="sq-input-wrap">
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                class="sq-input" placeholder="you@example.com" autocomplete="email" autofocus />
                            <span class="sq-input-icon" aria-hidden="true">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            </span>
                        </div>
                        @error('email')
                            <p class="sq-error">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="sq-field">
                        <div class="sq-label-row">
                            <label class="sq-label" for="password" style="margin-bottom:0;">Password</label>
                            <a href="#" class="sq-forgot">Forgot password?</a>
                        </div>
                        <div class="sq-input-wrap">
                            <input id="password" :type="showPw ? 'text' : 'password'" name="password" class="sq-input"
                                placeholder="••••••••" autocomplete="current-password" />
                            <button type="button" class="sq-toggle-btn" @click="showPw = !showPw"
                                :aria-label="showPw ? 'Hide password' : 'Show password'">
                                <template x-if="!showPw">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </template>
                                <template x-if="showPw">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                        <path
                                            d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                        <path
                                            d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                        <line x1="2" y1="2" x2="22" y2="22" />
                                    </svg>
                                </template>
                            </button>
                        </div>
                        @error('password')
                            <p class="sq-error">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    {{-- Submit --}}
                    <button type="submit" class="sq-btn" :disabled="loading">
                        <template x-if="!loading">
                            <span style="display:flex;align-items:center;gap:8px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" aria-hidden="true">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                    <polyline points="10 17 15 12 10 7" />
                                    <line x1="15" y1="12" x2="3" y2="12" />
                                </svg>
                                Sign In
                            </span>
                        </template>
                        <template x-if="loading">
                            <span style="display:flex;align-items:center;gap:8px;">
                                <span class="sq-spinner"></span>
                                Signing in…
                            </span>
                        </template>
                    </button>
                </form>
                <div class="sq-divider">or</div>
                <p class="sq-footer">
                    Don't have an account?
                    <a href="{{ route('admin.register') }}">Sign up</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.auth>
