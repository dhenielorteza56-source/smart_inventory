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

    .feat-list { display: flex; flex-direction: column; gap: 12px; }
    .feat-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px; background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06); border-radius: 10px;
    }
    .feat-dot { width: 8px; height: 8px; border-radius: 50%; background: #3b82f6; flex-shrink: 0; }
    .feat-text { font-size: 0.875rem; color: #94a3b8; }

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

    .form-heading { font-size: 1.65rem; font-weight: 700; color: #f1f5f9; margin-bottom: 5px; }
    .form-subheading { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; }

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

    .form-row {
        display: flex; align-items: center; justify-content: space-between;
        margin: 0.85rem 0 1.5rem;
    }
    .remember-label {
        display: flex; align-items: center; gap: 8px;
        font-size: 0.85rem; color: #64748b; cursor: pointer; user-select: none;
    }
    .remember-checkbox { width: 15px; height: 15px; border-radius: 4px; accent-color: #3b82f6; cursor: pointer; }
    .forgot-link { font-size: 0.85rem; color: #3b82f6; text-decoration: none; }
    .forgot-link:hover { color: #60a5fa; text-decoration: underline; }

    .btn-submit {
        width: 100%; padding: 12px; background: #3b82f6; border: none; border-radius: 8px;
        color: #fff; font-size: 0.95rem; font-weight: 600; font-family: 'Outfit', sans-serif;
        cursor: pointer; box-shadow: 0 4px 16px rgba(59,130,246,0.3);
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s; letter-spacing: 0.01em;
    }
    .btn-submit:hover { background: #2563eb; box-shadow: 0 4px 22px rgba(59,130,246,0.45); }
    .btn-submit:active { transform: scale(0.99); }

    .divider { height: 1px; background: rgba(255,255,255,0.07); margin: 1.6rem 0; }
    .auth-link-row { text-align: center; font-size: 0.875rem; color: #64748b; }
    .auth-link-row a { color: #3b82f6; text-decoration: none; font-weight: 500; }
    .auth-link-row a:hover { text-decoration: underline; }

    .session-status {
        padding: 10px 14px; background: rgba(59,130,246,0.1);
        border: 1px solid rgba(59,130,246,0.2); border-radius: 8px;
        font-size: 0.85rem; color: #93c5fd; margin-bottom: 1.2rem;
    }

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
            <h1 class="left-headline">Manage your inventory<br><span>with precision.</span></h1>
            <p class="left-sub">Real-time stock tracking, barcode lookup, supplier management, and intelligent alerts — all in one unified platform.</p>
            <div class="feat-list">
                <div class="feat-item"><div class="feat-dot"></div><span class="feat-text">Real-time stock tracking &amp; low-stock alerts</span></div>
                <div class="feat-item"><div class="feat-dot"></div><span class="feat-text">Barcode scanning &amp; SKU management</span></div>
                <div class="feat-item"><div class="feat-dot"></div><span class="feat-text">Supplier &amp; category organization</span></div>
                <div class="feat-item"><div class="feat-dot"></div><span class="feat-text">Analytics &amp; inventory value insights</span></div>
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="form-card">
            <div class="mobile-brand">
                <div class="mobile-brand-icon">A</div>
                <div class="mobile-brand-name">Apex<span>IMS</span></div>
            </div>
            <a href="{{ url('/') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Back to Home
            </a>
            <h2 class="form-heading">Welcome back</h2>
            <p class="form-subheading">Sign in to your account to continue</p>

            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email"
                        value="{{ old('email') }}" required autofocus autocomplete="username"
                        placeholder="you@example.com" />
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" class="form-input" type="password" name="password"
                        required autocomplete="current-password" placeholder="••••••••" />
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-row">
                    <label class="remember-label">
                        <input class="remember-checkbox" id="remember_me" type="checkbox" name="remember">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="btn-submit">Sign In</button>
            </form>

            <div class="divider"></div>
            <div class="auth-link-row">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </div>
    </div>

</div>
</x-guest-layout>
