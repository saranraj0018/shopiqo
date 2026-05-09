<x-layouts.auth>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        .sq-page {
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f4f8;
            padding: 1rem;
            font-family: 'DM Sans', sans-serif;
            overflow: hidden;
        }

        .sq-card {
            display: flex;
            width: 100%;
            max-width: 960px;
            max-height: 96vh;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(11, 37, 69, 0.13);
            animation: sq-fadeup 0.45s ease both;
        }

        @keyframes sq-fadeup {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Left panel ── */
        .sq-left {
            width: 36%;
            background: #0b2545;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.25rem 1.75rem;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sq-left-circle1 { position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.04); }
        .sq-left-circle2 { position: absolute; bottom: -45px; left: -45px; width: 160px; height: 160px; border-radius: 50%; background: rgba(255,255,255,0.04); }
        .sq-left-circle3 { position: absolute; bottom: 70px; right: -28px; width: 90px; height: 90px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.07); }

        .sq-brand { display: flex; flex-direction: column; align-items: center; gap: .75rem; z-index: 1; }

        .sq-logo-mark {
            width: 56px; height: 56px; background: white;
            border-radius: 14px; display: flex; align-items: center; justify-content: center;
        }

        .sq-brand-name { font-family: 'DM Serif Display', serif; font-size: 26px; color: white; letter-spacing: -.4px; }
        .sq-brand-name span { color: #7CB3FF; }
        .sq-tagline { font-size: 10.5px; color: rgba(255,255,255,0.4); letter-spacing: .1em; text-transform: uppercase; }

        .sq-features { margin-top: 2rem; z-index: 1; width: 100%; display: flex; flex-direction: column; gap: .6rem; }
        .sq-feature { display: flex; align-items: center; gap: 9px; font-size: 12.5px; color: rgba(255,255,255,0.65); }
        .sq-feature-dot { width: 5px; height: 5px; border-radius: 50%; background: #7CB3FF; flex-shrink: 0; }

        /* ── Right panel ── */
        .sq-right {
            width: 64%;
            background: #ffffff;
            padding: 1.75rem 2.25rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .sq-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 500; background: #EEF4FF; color: #134074;
            padding: 3px 11px; border-radius: 20px; margin-bottom: .75rem; width: fit-content;
        }

        .sq-welcome { font-family: 'DM Serif Display', serif; font-size: 23px; color: #0b2545; letter-spacing: -.3px; margin-bottom: 2px; }
        .sq-sub { font-size: 13px; color: #6b7a8d; margin-bottom: 1.25rem; }

        .sq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; }
        .sq-field { display: flex; flex-direction: column; }
        .sq-field.full { grid-column: 1 / -1; }

        .sq-label { font-size: 10.5px; font-weight: 500; color: #6b7a8d; letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
        .sq-label-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }

        .sq-input-wrap { position: relative; }
        .sq-select-wrap { position: relative; }

        .sq-input, .sq-select {
            width: 100%; font-family: 'DM Sans', sans-serif; font-size: 13px;
            padding: 9px 12px; border: 1.5px solid #dde3ec; border-radius: 9px;
            background: #f8fafc; color: #0b2545; outline: none;
            transition: border-color .18s, background .18s, box-shadow .18s;
        }

        .sq-input { padding-right: 38px; }
        .sq-input::placeholder { color: #aab4c0; }
        .sq-input:focus, .sq-select:focus {
            border-color: #134074; background: #fff;
            box-shadow: 0 0 0 3px rgba(19, 64, 116, 0.1);
        }

        .sq-select { appearance: none; cursor: pointer; }

        .sq-select-arrow {
            position: absolute; right: 11px; top: 50%; transform: translateY(-50%);
            color: #aab4c0; pointer-events: none; display: flex; align-items: center;
        }

        .sq-input-icon {
            position: absolute; right: 11px; top: 50%; transform: translateY(-50%);
            color: #aab4c0; display: flex; align-items: center;
        }

        .sq-toggle-btn {
            position: absolute; right: 11px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #aab4c0;
            display: flex; align-items: center; transition: color .15s; padding: 0;
        }
        .sq-toggle-btn:hover { color: #134074; }

        .sq-btn {
            width: 100%; padding: 11px; border: none; border-radius: 9px;
            background: #0b2545; color: white; font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: background .18s; letter-spacing: .01em;
        }
        .sq-btn:hover:not(:disabled) { background: #134074; }
        .sq-btn:active:not(:disabled) { transform: scale(0.99); }
        .sq-btn:disabled { opacity: .75; cursor: not-allowed; }

        .sq-spinner {
            width: 17px; height: 17px;
            border: 2.5px solid rgba(255,255,255,0.35);
            border-top-color: white; border-radius: 50%;
            animation: sq-spin 0.7s linear infinite; flex-shrink: 0;
        }
        @keyframes sq-spin { to { transform: rotate(360deg); } }

        .sq-error { font-size: 12px; color: #c0392b; margin-top: 4px; display: flex; align-items: center; gap: 4px; }

        .sq-footer { font-size: 13px; text-align: center; color: #6b7a8d; margin-top: .9rem; }
        .sq-footer a { color: #13315c; font-weight: 500; text-decoration: none; }
        .sq-footer a:hover { text-decoration: underline; }

        @media (max-width: 680px) {
            .sq-left { display: none; }
            .sq-right { width: 100%; padding: 1.75rem 1.5rem; }
            .sq-card { border-radius: 16px; max-height: none; }
            .sq-page { height: auto; min-height: 100dvh; overflow: auto; padding: 1.25rem 1rem; }
            .sq-grid { grid-template-columns: 1fr; }
            .sq-field.full { grid-column: 1; }
        }
    </style>

    <div class="sq-page">
        <div class="sq-card">

            {{-- ── Left panel ── --}}
            <div class="sq-left">
                <div class="sq-left-circle1"></div>
                <div class="sq-left-circle2"></div>
                <div class="sq-left-circle3"></div>

                <div class="sq-brand">
                    <div class="sq-logo-mark">
                        <img src="{{ asset('assets/images/Shopiqologo.svg') }}"
                             alt="Shopiqo"
                             style="height: 36px; width: auto; object-fit: contain;">
                    </div>
                    <div class="sq-brand-name">Shopiq<span>o</span></div>
                    <div class="sq-tagline">Admin Dashboard</div>
                </div>

                <div class="sq-features">
                    <div class="sq-feature"><div class="sq-feature-dot"></div>Manage orders &amp; inventory</div>
                    <div class="sq-feature"><div class="sq-feature-dot"></div>Real-time analytics</div>
                    <div class="sq-feature"><div class="sq-feature-dot"></div>Customer insights</div>
                    <div class="sq-feature"><div class="sq-feature-dot"></div>Secure &amp; role-based access</div>
                </div>
            </div>

            {{-- ── Right panel ── --}}
            <div class="sq-right">

                <div class="sq-badge">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    New account
                </div>

                <h2 class="sq-welcome">Create an Account</h2>
                <p class="sq-sub">Fill in your details to get started</p>

                @php $roles = \App\Models\Role::get(); @endphp

                <form method="POST"
                      action="{{ route('admin.register.update') }}"
                      x-data="{ showPw: false, showPwC: false, loading: false }"
                      @submit="loading = true"
                      novalidate>
                    @csrf

                    <div class="sq-grid">

                        {{-- Role --}}
                        <div class="sq-field full">
                            <label class="sq-label" for="role">Role</label>
                            <div class="sq-select-wrap">
                                <select id="role" name="role" class="sq-select">
                                    <option value="">Choose Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="sq-select-arrow" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </div>
                            @error('role')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Full Name --}}
                        <div class="sq-field">
                            <label class="sq-label" for="name">Full Name</label>
                            <div class="sq-input-wrap">
                                <input id="name" name="name" type="text"
                                       value="{{ old('name') }}"
                                       class="sq-input" placeholder="John Doe"
                                       autocomplete="name" />
                                <span class="sq-input-icon" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                            </div>
                            @error('name')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Mobile --}}
                        <div class="sq-field">
                            <label class="sq-label" for="mobile_number">Mobile</label>
                            <div class="sq-input-wrap">
                                <input id="mobile_number" name="mobile_number" type="tel"
                                       value="{{ old('mobile_number') }}"
                                       class="sq-input" placeholder="+91 98765 43210"
                                       autocomplete="tel" />
                                <span class="sq-input-icon" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                </span>
                            </div>
                            @error('mobile_number')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="sq-field full">
                            <label class="sq-label" for="email">Email Address</label>
                            <div class="sq-input-wrap">
                                <input id="email" name="email" type="email"
                                       value="{{ old('email') }}"
                                       class="sq-input" placeholder="you@example.com"
                                       autocomplete="email" />
                                <span class="sq-input-icon" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 01-2.06 0L2 7"/></svg>
                                </span>
                            </div>
                            @error('email')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="sq-field">
                            <label class="sq-label" for="password">Password</label>
                            <div class="sq-input-wrap">
                                <input id="password" name="password"
                                       :type="showPw ? 'text' : 'password'"
                                       class="sq-input" placeholder="••••••••"
                                       autocomplete="new-password" />
                                <button type="button" class="sq-toggle-btn"
                                        @click="showPw = !showPw"
                                        :aria-label="showPw ? 'Hide password' : 'Show password'">
                                    <template x-if="!showPw">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </template>
                                    <template x-if="showPw">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                                    </template>
                                </button>
                            </div>
                            @error('password')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="sq-field">
                            <label class="sq-label" for="password_confirmation">Confirm Password</label>
                            <div class="sq-input-wrap">
                                <input id="password_confirmation" name="password_confirmation"
                                       :type="showPwC ? 'text' : 'password'"
                                       class="sq-input" placeholder="••••••••"
                                       autocomplete="new-password" />
                                <button type="button" class="sq-toggle-btn"
                                        @click="showPwC = !showPwC"
                                        :aria-label="showPwC ? 'Hide password' : 'Show password'">
                                    <template x-if="!showPwC">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </template>
                                    <template x-if="showPwC">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                                    </template>
                                </button>
                            </div>
                        </div>

                        {{-- Security Code --}}
                        <div class="sq-field full">
                            <label class="sq-label" for="code">Security Code</label>
                            <div class="sq-input-wrap">
                                <input id="code" name="code" type="text"
                                       value="{{ old('code') }}"
                                       class="sq-input" placeholder="Enter your security code" />
                                <span class="sq-input-icon" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </span>
                            </div>
                            @error('code')
                                <p class="sq-error">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="sq-field full">
                            <button type="submit" class="sq-btn" :disabled="loading">
                                <template x-if="!loading">
                                    <span style="display:flex;align-items:center;gap:8px;">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>
                                        Create Account
                                    </span>
                                </template>
                                <template x-if="loading">
                                    <span style="display:flex;align-items:center;gap:8px;">
                                        <span class="sq-spinner"></span>
                                        Creating account…
                                    </span>
                                </template>
                            </button>
                        </div>

                    </div>
                </form>

                <p class="sq-footer">
                    Already have an account?
                    <a href="{{ route('admin.login') }}">Sign In</a>
                </p>

            </div>
        </div>
    </div>
</x-layouts.auth>
