<x-guest-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body { font-family: 'Outfit', sans-serif !important; background: #0d1117 !important; }

    .auth-page {
        min-height: 100vh;
        display: flex;
        font-family: 'Outfit', sans-serif;
    }

    .auth-left {
        display: none;
        flex: 1;
        position: relative;
        overflow: hidden;
        background: #0d1117;
        border-right: 1px solid rgba(255,255,255,0.05);
    }
    @media (min-width: 1024px) {
        .auth-left { display: flex; flex-direction: column; justify-content: center; padding: 3.5rem; }
    }
    .left-grid {
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(59,130,246,0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(59,130,246,0.05) 1px, transparent 1px);
        background-size: 40px 40px; pointer-events: none;
    }
    .left-glow {
        position: absolute; width: 500px; height: 500px; border-radius: 50%;
        background: radial-gradient(circle, rgba(59,130,246,0.15) 0%, transparent 70%);
        top: 50%; left: 45%; transform: translate(-50%, -50%); pointer-events: none;
    }
    .left-content { position: relative; z-index: 1; }

    .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 3rem; }
    .brand-icon {
        width: 44px; height: 44px; border-radius: 10px; background: #3b82f6;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 18px; color: #fff; flex-shrink: 0;
    }
    .brand-name { font-size: 22px; font-weight: 700; color: #fff; }
    .brand-name span { color: #3b82f6; }

    .left-headline { font-size: 2.8rem; font-weight: 700; line-height: 1.18; color: #f1f5f9; margin-bottom: 1.1rem; }
    .left-headline span { color: #3b82f6; }
    .left-sub { font-size: 0.95rem; color: #64748b; line-height: 1.75; max-width: 400px; margin-bottom: 2.5rem; }

    .info-cards { display: flex; flex-direction: column; gap: 14px; }
    .info-card {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 16px 18px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
    }
    .info-icon {
        width: 36px; height: 36px; border-radius: 8px;
        background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.2);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .info-icon svg { width: 16px; height: 16px; color: #3b82f6; }
    .info-title { font-size: 0.875rem; font-weight: 600; color: #e2e8f0; margin-bottom: 2px; }
    .info-desc { font-size: 0.8rem; color: #64748b; line-height: 1.5; }

    .auth-right {
        width: 100%; display: flex; align-items: center; justify-content: center;
        padding: 2.5rem 1.5rem; background-color: #0d1117;
        background-image: radial-gradient(ellipse 80% 50% at 50% -5%, rgba(59,130,246,0.12) 0%, transparent 65%);
    }
    @media (min-width: 1024px) { .auth-right { width: 480px; flex-shrink: 0; } }

    .form-card { width: 100%; max-width: 400px; }

    .mobile-brand {
        display: flex; align-items: center; gap: 10px;
        justify-content: center; margin-bottom: 2.2rem;
    }
    @media (min-width: 1024px) { .mobile-brand { display: none; } }
    .mobile-brand-icon {
        width: 40px; height: 40px; border-radius: 9px; background: #3b82f6;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 16px; color: #fff;
    }
    .mobile-brand-name { font-size: 21px; font-weight: 700; color: #fff; }
    .mobile-brand-name span { color: #3b82f6; }

    .icon-wrap {
        width: 56px; height: 56px; border-radius: 14px;
        background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    }
    .icon-wrap svg { width: 24px; height: 24px; color: #3b82f6; }

    .form-heading { font-size: 1.65rem; font-weight: 700; color: #f1f5f9; margin-bottom: 5px; }
    .form-subheading { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; line-height: 1.6; }

    .form-group { margin-bottom: 1.15rem; }
    .form-label {
        display: block; font-size: 0.72rem; font-weight: 500;
        letter-spacing: 0.06em; text-transform: uppercase; color: #94a3b8; margin-bottom: 7px;
    }
    .form-input {
        width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;
        color: #f1f5f9; font-size: 0.9rem; font-family: 'Outfit', sans-serif;
        outline: none; transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }
    .form-input:focus {
        border-color: #3b82f6; background: rgba(59,130,246,0.06);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }
    .form-input::placeholder { color: #475569; }
    .form-error { font-size: 0.78rem; color: #f87171; margin-top: 5px; }

    .btn-submit {
        width: 100%; padding: 12px; background: #3b82f6; border: none; border-radius: 8px;
        color: #fff; font-size: 0.95rem; font-weight: 600; font-family: 'Outfit', sans-serif;
        cursor: pointer; box-shadow: 0 4px 16px rgba(59,130,246,0.3);
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover { background: #2563eb; box-shadow: 0 4px 22px rgba(59,130,246,0.45); }
    .btn-submit:active { transform: scale(0.99); }
    .btn-submit svg { width: 16px; height: 16px; }

    .session-status {
        padding: 12px 14px;
        background: rgba(16,185,129,0.1);
        border: 1px solid rgba(16,185,129,0.25);
        border-radius: 8px;
        font-size: 0.85rem; color: #6ee7b7; margin-bottom: 1.4rem;
        display: flex; align-items: center; gap: 10px;
    }
    .session-status svg { width: 16px; height: 16px; flex-shrink: 0; }

    .divider { height: 1px; background: rgba(255,255,255,0.07); margin: 1.6rem 0; }
    .auth-link-row { text-align: center; font-size: 0.875rem; color: #64748b; }
    .auth-link-row a { color: #3b82f6; text-decoration: none; font-weight: 500; }
    .auth-link-row a:hover { text-decoration: underline; }

    .back-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 14px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        color: #94a3b8; font-size: 0.82rem; font-family: 'Outfit', sans-serif;
        text-decoration: none; margin-bottom: 2rem;
        transition: background 0.2s, color 0.2s, border-color 0.2s;
    }
    .back-btn:hover { background: rgba(255,255,255,0.08); color: #f1f5f9; border-color: rgba(255,255,255,0.2); }
    .back-btn svg { width: 14px; height: 14px; flex-shrink: 0; }
</style>

<div class="auth-page">

    <div class="auth-left">
        <div class="left-grid"></div>
        <div class="left-glow"></div>
        <div class="left-content">
            <div class="brand">
                <div class="brand-icon">A</div>
                <div class="brand-name">Apex<span>IMS</span></div>
            </div>
            <h1 class="left-headline">Recover your<br><span>account access.</span></h1>
            <p class="left-sub">We'll send a secure reset link to your email. Follow the steps below to regain access to your account.</p>
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    </div>
                    <div>
                        <div class="info-title">Enter your email</div>
                        <div class="info-desc">Provide the email address linked to your ApexIMS account</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                    </div>
                    <div>
                        <div class="info-title">Check your inbox</div>
                        <div class="info-desc">Click the secure link in the email we send you</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                    </div>
                    <div>
                        <div class="info-title">Set a new password</div>
                        <div class="info-desc">Choose a strong new password and regain full access</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="form-card">
            <div class="mobile-brand">
                <div class="mobile-brand-icon">A</div>
                <div class="mobile-brand-name">Apex<span>IMS</span></div>
            </div>
            <a href="{{ route('login') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Back to Sign In
            </a>

            <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            </div>

            <h2 class="form-heading">Forgot your password?</h2>
            <p class="form-subheading">No worries — enter your email and we'll send you a secure reset link right away.</p>

            @if (session('status'))
                <div class="session-status">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="you@example.com" />
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    Send Reset Link
                </button>
            </form>

            <div class="divider"></div>
            <div class="auth-link-row">
                Remember your password? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>

</div>
</x-guest-layout>
