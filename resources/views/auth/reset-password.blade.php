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

    .tip-list { display: flex; flex-direction: column; gap: 10px; }
    .tip-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 10px;
    }
    .tip-dot { width: 8px; height: 8px; border-radius: 50%; background: #3b82f6; flex-shrink: 0; }
    .tip-text { font-size: 0.875rem; color: #94a3b8; }

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

    .icon-wrap {
        width: 56px; height: 56px; border-radius: 14px;
        background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
    }
    .icon-wrap svg { width: 24px; height: 24px; color: #3b82f6; }

    .form-heading { font-size: 1.65rem; font-weight: 700; color: #f1f5f9; margin-bottom: 5px; }
    .form-subheading { font-size: 0.875rem; color: #64748b; margin-bottom: 2rem; line-height: 1.6; }

    .form-group { margin-bottom: 1.1rem; position: relative; }
    .form-label {
        display: block; font-size: 0.72rem; font-weight: 500;
        letter-spacing: 0.06em; text-transform: uppercase; color: #94a3b8; margin-bottom: 7px;
    }
    .input-wrap { position: relative; }
    .form-input {
        width: 100%; padding: 11px 42px 11px 14px; background: rgba(255,255,255,0.04);
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
    .form-hint { font-size: 0.77rem; color: #475569; margin-top: 5px; }

    .toggle-pw {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; color: #475569;
        display: flex; align-items: center; padding: 4px;
        transition: color 0.2s;
    }
    .toggle-pw:hover { color: #94a3b8; }
    .toggle-pw svg { width: 16px; height: 16px; }

    /* Password strength meter */
    .strength-bar { display: flex; gap: 4px; margin-top: 8px; }
    .strength-seg {
        height: 3px; flex: 1; border-radius: 99px;
        background: rgba(255,255,255,0.08);
        transition: background 0.3s;
    }
    .strength-seg.weak   { background: #ef4444; }
    .strength-seg.fair   { background: #f59e0b; }
    .strength-seg.good   { background: #3b82f6; }
    .strength-seg.strong { background: #10b981; }
    .strength-label { font-size: 0.72rem; color: #475569; margin-top: 5px; }

    .btn-submit {
        width: 100%; padding: 12px; background: #3b82f6; border: none; border-radius: 8px;
        color: #fff; font-size: 0.95rem; font-weight: 600; font-family: 'Outfit', sans-serif;
        cursor: pointer; margin-top: 0.5rem; box-shadow: 0 4px 16px rgba(59,130,246,0.3);
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover { background: #2563eb; box-shadow: 0 4px 22px rgba(59,130,246,0.45); }
    .btn-submit:active { transform: scale(0.99); }
    .btn-submit svg { width: 16px; height: 16px; }

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
            <h1 class="left-headline">Create a strong<br><span>new password.</span></h1>
            <p class="left-sub">Your new password will secure your ApexIMS account. Follow these guidelines to keep your data safe.</p>
            <div class="tip-list">
                <div class="tip-item"><div class="tip-dot"></div><span class="tip-text">Use at least 8 characters</span></div>
                <div class="tip-item"><div class="tip-dot"></div><span class="tip-text">Mix uppercase and lowercase letters</span></div>
                <div class="tip-item"><div class="tip-dot"></div><span class="tip-text">Include at least one number or symbol</span></div>
                <div class="tip-item"><div class="tip-dot"></div><span class="tip-text">Avoid using your name or email</span></div>
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

            <h2 class="form-heading">Reset your password</h2>
            <p class="form-subheading">Almost there — set your new password below to restore access to your account.</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-wrap">
                        <input id="email" class="form-input" type="email" name="email"
                            value="{{ old('email', $request->email) }}" required autofocus
                            autocomplete="username" placeholder="you@example.com"
                            style="padding-right: 14px;" />
                    </div>
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <div class="input-wrap">
                        <input id="password" class="form-input" type="password" name="password"
                            required autocomplete="new-password" placeholder="Min. 8 characters"
                            oninput="updateStrength(this.value)" />
                        <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1">
                            <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>
                    </div>
                    <div class="strength-bar">
                        <div class="strength-seg" id="s1"></div>
                        <div class="strength-seg" id="s2"></div>
                        <div class="strength-seg" id="s3"></div>
                        <div class="strength-seg" id="s4"></div>
                    </div>
                    <div class="strength-label" id="strength-label">Enter a password</div>
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <input id="password_confirmation" class="form-input" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Repeat your password" />
                        <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)" tabindex="-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>
                    </div>
                    @error('password_confirmation')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Reset Password
                </button>
            </form>

            <div class="divider"></div>
            <div class="auth-link-row">
                Remember your password? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </div>
    </div>

</div>

<script>
function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.innerHTML = isHidden
        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>`
        : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>`;
}

function updateStrength(val) {
    const segs = [document.getElementById('s1'), document.getElementById('s2'), document.getElementById('s3'), document.getElementById('s4')];
    const label = document.getElementById('strength-label');
    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = ['', 'weak', 'fair', 'good', 'strong'];
    const labels = ['Enter a password', 'Weak', 'Fair', 'Good', 'Strong'];
    const colors = ['#475569', '#ef4444', '#f59e0b', '#3b82f6', '#10b981'];

    segs.forEach((s, i) => {
        s.className = 'strength-seg';
        if (val.length > 0 && i < score) s.classList.add(levels[score]);
    });
    label.textContent = val.length === 0 ? 'Enter a password' : labels[score];
    label.style.color = val.length === 0 ? '#475569' : colors[score];
}
</script>
</x-guest-layout>
