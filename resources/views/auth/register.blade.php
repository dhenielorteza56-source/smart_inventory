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

    .steps { display: flex; flex-direction: column; }
    .step { display: flex; gap: 16px; position: relative; }
    .step:not(:last-child)::before {
        content: ''; position: absolute; left: 15px; top: 34px;
        width: 2px; height: calc(100% - 2px); background: rgba(59,130,246,0.2);
    }
    .step-num {
        width: 32px; height: 32px; border-radius: 50%;
        background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 0.78rem; font-weight: 700; color: #3b82f6; flex-shrink: 0; margin-top: 2px;
    }
    .step-body { padding-bottom: 28px; }
    .step-title { font-size: 0.9rem; font-weight: 600; color: #e2e8f0; margin-bottom: 3px; }
    .step-desc { font-size: 0.8rem; color: #64748b; line-height: 1.55; }

    .auth-right {
        width: 100%; display: flex; align-items: center; justify-content: center;
        padding: 2.5rem 1.5rem; background-color: #0d1117;
        background-image: radial-gradient(ellipse 80% 50% at 50% -5%, rgba(59,130,246,0.12) 0%, transparent 65%);
    }
    @media (min-width: 1024px) { .auth-right { width: 500px; flex-shrink: 0; } }

    .form-card { width: 100%; max-width: 420px; }

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

    .form-group { margin-bottom: 1.1rem; }
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
    .form-hint { font-size: 0.77rem; color: #475569; margin-top: 5px; }
    .form-error { font-size: 0.78rem; color: #f87171; margin-top: 5px; }

    .btn-submit {
        width: 100%; padding: 12px; background: #3b82f6; border: none; border-radius: 8px;
        color: #fff; font-size: 0.95rem; font-weight: 600; font-family: 'Outfit', sans-serif;
        cursor: pointer; margin-top: 0.5rem; box-shadow: 0 4px 16px rgba(59,130,246,0.3);
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
    }
    .btn-submit:hover { background: #2563eb; box-shadow: 0 4px 22px rgba(59,130,246,0.45); }
    .btn-submit:active { transform: scale(0.99); }

    .terms-note { font-size: 0.77rem; color: #475569; text-align: center; line-height: 1.55; margin-top: 0.9rem; }
    .divider { height: 1px; background: rgba(255,255,255,0.07); margin: 1.5rem 0; }
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
            <h1 class="left-headline">Get started<br><span>in seconds.</span></h1>
            <p class="left-sub">Create your free account and start managing your inventory with real-time precision today.</p>
            <div class="steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="step-body"><div class="step-title">Create your account</div><div class="step-desc">Fill in your details to get instant access</div></div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="step-body"><div class="step-title">Add your products</div><div class="step-desc">Import or manually add your inventory items</div></div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="step-body"><div class="step-title">Track in real-time</div><div class="step-desc">Monitor stock levels, alerts, and analytics</div></div>
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
            <a href="{{ url('/') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Back to Home
            </a>
            <h2 class="form-heading">Create your account</h2>
            <p class="form-subheading">Join ApexIMS and take control of your inventory</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input id="name" class="form-input" type="text" name="name"
                        value="{{ old('name') }}" required autofocus autocomplete="name"
                        placeholder="Juan dela Cruz" />
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email"
                        value="{{ old('email') }}" required autocomplete="username"
                        placeholder="you@example.com" />
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" class="form-input" type="password" name="password"
                        required autocomplete="new-password" placeholder="Min. 8 characters" />
                    <p class="form-hint">Use at least 8 characters with a mix of letters and numbers</p>
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" class="form-input" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Repeat your password" />
                    @error('password_confirmation')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-submit">Create Account</button>
                <p class="terms-note">By creating an account, you agree to the ApexIMS Terms of Service and Privacy Policy.</p>
            </form>

            <div class="divider"></div>
            <div class="auth-link-row">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>

</div>
</x-guest-layout>
