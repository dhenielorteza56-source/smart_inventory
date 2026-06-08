<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ApexIMS — Inventory Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:      #e8ecf5;
            --ink-2:    #c4cad8;
            --ink-3:    #9ca3af;
            --muted:    #9ca3af;
            --muted-2:  #6b7280;
            --accent:   #3b82f6;
            --accent-2: #2563eb;
            --accent-g: #60a5fa;
            --surface:  #0f1117;
            --surface-2:#161922;
            --surface-3:#1c2030;
            --border:   rgba(255,255,255,.07);
            --border-2: rgba(255,255,255,.12);
            --success:  #10b981;
            --warning:  #f59e0b;
            --danger:   #ef4444;

            --font-display: 'Inter', sans-serif;
            --font-body:    'Inter', sans-serif;

            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 22px;
            --radius-xl: 32px;

            --shadow-sm: 0 1px 3px rgba(15,17,23,.06), 0 1px 2px rgba(15,17,23,.04);
            --shadow-md: 0 4px 16px rgba(15,17,23,.08), 0 2px 6px rgba(15,17,23,.04);
            --shadow-lg: 0 12px 40px rgba(15,17,23,.12), 0 4px 12px rgba(15,17,23,.06);
            --shadow-xl: 0 24px 64px rgba(15,17,23,.18), 0 8px 24px rgba(15,17,23,.08);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            background: var(--surface);
            color: var(--ink);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ─── NAV ─────────────────────────────────────────── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            height: 68px;
            background: rgba(22,25,34,0.92);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: box-shadow .3s;
        }
        nav.scrolled { box-shadow: var(--shadow-sm); }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--ink);
        }
        .nav-logo-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--accent), var(--accent-g));
            border-radius: 9px;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: 1rem;
            color: white;
            letter-spacing: -.05em;
        }
        .nav-logo-icon svg { width: 18px; height: 18px; color: white; }
        .nav-logo-text {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.15rem;
            letter-spacing: -.02em;
        }
        .nav-logo-text span { color: var(--accent); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .nav-links a {
            font-size: .875rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            transition: color .2s, background .2s;
        }
        .nav-links a:hover { color: var(--ink); background: var(--surface-3); }

        .nav-actions { display: flex; gap: 10px; align-items: center; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-body);
            font-size: .875rem;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
        }
        .btn-ghost {
            color: var(--ink);
            background: transparent;
            border: 1px solid var(--border-2);
        }
        .btn-ghost:hover { background: var(--surface-3); border-color: rgba(255,255,255,.2); }
        .btn-primary {
            color: white;
            background: var(--accent);
        }
        .btn-primary:hover { background: var(--accent-2); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(59,124,255,.35); }

        /* ─── HERO ────────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 120px 48px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* animated grid background */
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 48px 48px;
            opacity: .6;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 40%, transparent 100%);
        }

        /* gradient orbs */
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 600px 400px at 20% 50%, rgba(59,124,255,.08), transparent),
                radial-gradient(ellipse 500px 350px at 80% 30%, rgba(34,211,238,.07), transparent),
                radial-gradient(ellipse 400px 300px at 60% 80%, rgba(16,185,129,.06), transparent);
            pointer-events: none;
        }

        .hero-content { position: relative; z-index: 1; max-width: 760px; }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,124,255,.08);
            border: 1px solid rgba(59,124,255,.2);
            color: var(--accent);
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 28px;
            animation: fadeUp .6s ease both;
        }
        .hero-badge-dot {
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s ease infinite;
        }

        h1 {
            font-family: var(--font-display);
            font-size: clamp(2.6rem, 6vw, 4.2rem);
            font-weight: 800;
            letter-spacing: -.04em;
            line-height: 1.05;
            color: var(--ink);
            margin-bottom: 22px;
            animation: fadeUp .6s .1s ease both;
        }
        h1 em {
            font-style: normal;
            background: linear-gradient(135deg, var(--accent), var(--accent-g));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: 1.125rem;
            color: var(--muted);
            max-width: 520px;
            margin: 0 auto 40px;
            line-height: 1.65;
            font-weight: 300;
            animation: fadeUp .6s .2s ease both;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            animation: fadeUp .6s .3s ease both;
        }
        .btn-lg { padding: 13px 28px; font-size: 1rem; border-radius: var(--radius-md); }

        .hero-stats {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            margin-top: 72px;
            padding-top: 40px;
            border-top: 1px solid var(--border);
            animation: fadeUp .6s .4s ease both;
        }
        .hero-stat { text-align: center; }
        .hero-stat-num {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -.03em;
        }
        .hero-stat-label { font-size: .8rem; color: var(--muted-2); font-weight: 400; }
        .hero-stat-divider { width: 1px; height: 36px; background: var(--border); }

        /* ─── DASHBOARD PREVIEW ───────────────────────────── */
        .preview-section {
            padding: 0 48px 100px;
            display: flex;
            justify-content: center;
        }
        .preview-wrap {
            position: relative;
            max-width: 1020px;
            width: 100%;
            animation: fadeUp .8s .5s ease both;
        }
        .preview-glow {
            position: absolute;
            inset: -40px;
            background: radial-gradient(ellipse at 50% 0%, rgba(59,124,255,.15), transparent 70%);
            pointer-events: none;
        }
        .preview-card {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            position: relative;
        }
        .preview-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 20px;
            background: var(--surface-3);
            border-bottom: 1px solid var(--border);
        }
        .preview-dot { width: 11px; height: 11px; border-radius: 50%; }
        .pd-red   { background: #ff5f57; }
        .pd-yellow{ background: #febc2e; }
        .pd-green { background: #28c840; }
        .preview-url {
            flex: 1;
            max-width: 320px;
            margin: 0 auto;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 4px 12px;
            font-size: .78rem;
            color: var(--muted-2);
            text-align: center;
        }

        /* mock dashboard UI */
        .mock-dash {
            display: grid;
            grid-template-columns: 220px 1fr;
            min-height: 440px;
        }
        .mock-sidebar {
            background: #161922;
            padding: 24px 0;
        }
        .mock-sidebar-logo {
            padding: 0 20px 20px;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: .95rem;
            color: white;
            letter-spacing: -.01em;
            border-bottom: 1px solid rgba(255,255,255,.07);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 9px;
        }
        .mock-sidebar-logo-icon {
            width: 26px; height: 26px;
            background: linear-gradient(135deg, var(--accent), var(--accent-g));
            border-radius: 7px;
            display: grid;
            place-items: center;
            font-weight: 800;
            font-size: .75rem;
            color: white;
        }
        .mock-sidebar-logo-icon svg { width: 13px; height: 13px; color: white; }
        .mock-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            font-size: .8rem;
            color: rgba(255,255,255,.45);
            cursor: default;
        }
        .mock-nav-item.active {
            color: #60a5fa;
            background: rgba(59,130,246,.15);
        }
        .mock-nav-item svg { width: 15px; height: 15px; flex-shrink: 0; }
        .mock-nav-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--accent);
            margin-left: auto;
        }

        .mock-main { background: #0f1117; padding: 24px; }
        .mock-main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .mock-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: #e8ecf5;
        }
        .mock-sub { font-size: .72rem; color: #6b7280; }
        .mock-add-btn {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 7px;
            padding: 6px 14px;
            font-size: .75rem;
            font-weight: 600;
            cursor: default;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .mock-kpis {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 16px;
        }
        .mock-kpi {
            background: #1a1e2e;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            padding: 14px;
        }
        .mock-kpi-label { font-size: .68rem; color: #6b7280; margin-bottom: 4px; }
        .mock-kpi-val {
            font-family: var(--font-display);
            font-size: 1.3rem;
            font-weight: 700;
            color: #e8ecf5;
            letter-spacing: -.02em;
        }
        .mock-kpi-tag {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: .63rem;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 4px;
            margin-top: 4px;
        }
        .tag-green { background: rgba(16,185,129,.12); color: var(--success); }
        .tag-red   { background: rgba(239,68,68,.12);  color: var(--danger);  }
        .tag-amber { background: rgba(245,158,11,.12); color: var(--warning); }

        .mock-table-wrap {
            background: #1a1e2e;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            overflow: hidden;
        }
        .mock-table-head {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 80px;
            padding: 9px 14px;
            background: rgba(255,255,255,.03);
            border-bottom: 1px solid rgba(255,255,255,.07);
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: #6b7280;
        }
        .mock-table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 80px;
            padding: 8px 14px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            align-items: center;
            font-size: .73rem;
            color: #9ca3af;
        }
        .mock-table-row:last-child { border-bottom: none; }
        .mock-badge {
            display: inline-flex;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: .63rem;
            font-weight: 600;
        }
        .stock-ok   { background: rgba(16,185,129,.1);  color: var(--success); }
        .stock-low  { background: rgba(245,158,11,.1); color: var(--warning); }
        .stock-out  { background: rgba(239,68,68,.1);  color: var(--danger); }
        .mock-item-name { font-weight: 500; color: #e8ecf5; font-size: .75rem; }
        .mock-sku { font-size: .65rem; color: #6b7280; }
        .mock-actions { display: flex; gap: 6px; }
        .mock-action-btn {
            width: 24px; height: 24px;
            border-radius: 5px;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            display: grid;
            place-items: center;
            cursor: default;
        }
        .mock-action-btn svg { width: 11px; height: 11px; color: #6b7280; }

        /* chart strip */
        .mock-chart {
            margin-top: 14px;
            background: #1a1e2e;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            padding: 14px;
            display: flex;
            align-items: flex-end;
            gap: 5px;
            height: 80px;
        }
        .mock-bar {
            flex: 1;
            border-radius: 4px 4px 0 0;
            background: linear-gradient(to top, var(--accent), rgba(59,124,255,.3));
            transition: opacity .2s;
        }

        /* ─── FEATURES ────────────────────────────────────── */
        .section {
            padding: 100px 48px;
            max-width: 1140px;
            margin: 0 auto;
        }
        .section-label {
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
        }
        .section-title {
            font-family: var(--font-display);
            font-size: clamp(1.9rem, 4vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -.03em;
            line-height: 1.1;
            color: var(--ink);
            margin-bottom: 16px;
        }
        .section-desc {
            font-size: 1rem;
            color: var(--muted);
            max-width: 480px;
            line-height: 1.7;
            font-weight: 400;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 56px;
        }
        .feature-card {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: box-shadow .3s, transform .3s, border-color .3s;
        }
        .feature-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
            border-color: rgba(59,130,246,.3);
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-g));
            opacity: 0;
            transition: opacity .3s;
        }
        .feature-card:hover::before { opacity: 1; }

        .feature-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            margin-bottom: 18px;
        }
        .feature-icon svg { width: 22px; height: 22px; }
        .fi-blue  { background: rgba(59,124,255,.1);  color: var(--accent); }
        .fi-green { background: rgba(16,185,129,.1);  color: var(--success); }
        .fi-amber { background: rgba(245,158,11,.1);  color: var(--warning); }
        .fi-cyan  { background: rgba(34,211,238,.12); color: #0891b2; }
        .fi-red   { background: rgba(239,68,68,.1);   color: var(--danger); }
        .fi-violet{ background: rgba(139,92,246,.1);  color: #7c3aed; }

        .feature-title {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
            letter-spacing: -.01em;
        }
        .feature-desc { font-size: .875rem; color: var(--muted); line-height: 1.65; }

        /* big feature card */
        .feature-card.big {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: center;
        }
        .feature-card.big .feature-visual {
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* barcode scan animation */
        .barcode-scan {
            position: relative;
            width: 120px;
        }
        .barcode-lines {
            display: flex;
            gap: 2px;
            height: 60px;
            align-items: stretch;
        }
        .barcode-line {
            background: var(--ink);
            border-radius: 1px;
        }
        .scan-beam {
            position: absolute;
            top: 0; left: -10px; right: -10px;
            height: 2px;
            background: var(--accent);
            box-shadow: 0 0 8px 2px rgba(59,124,255,.5);
            animation: scanBeam 2s ease-in-out infinite;
        }
        @keyframes scanBeam {
            0%   { top: 0; }
            50%  { top: 100%; }
            100% { top: 0; }
        }

        /* stock level bars */
        .stock-bars { width: 100%; }
        .stock-bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .stock-bar-label { font-size: .7rem; color: var(--muted); width: 80px; flex-shrink: 0; }
        .stock-bar-track {
            flex: 1;
            height: 6px;
            background: rgba(255,255,255,.08);
            border-radius: 4px;
            overflow: hidden;
        }
        .stock-bar-fill {
            height: 100%;
            border-radius: 4px;
            animation: growBar 1s ease both;
        }
        @keyframes growBar { from { width: 0; } }

        /* ─── HOW IT WORKS ────────────────────────────────── */
        .steps-wrap {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
            margin-top: 56px;
            position: relative;
        }
        .steps-wrap::before {
            content: '';
            position: absolute;
            top: 28px; left: 0; right: 0;
            height: 1px;
            background: var(--border);
            z-index: 0;
        }
        .step {
            position: relative;
            z-index: 1;
        }
        .step-num {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: var(--surface-3);
            border: 2px solid var(--border-2);
            display: grid;
            place-items: center;
            margin: 0 auto 20px;
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--accent);
            transition: all .3s;
        }
        .step:hover .step-num {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
            box-shadow: 0 0 0 8px rgba(59,130,246,.15);
        }
        .step-title {
            font-family: var(--font-display);
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            text-align: center;
            margin-bottom: 8px;
        }
        .step-desc { font-size: .82rem; color: var(--muted); text-align: center; line-height: 1.6; }

        /* ─── CTA SECTION ─────────────────────────────────── */
        .cta-section {
            margin: 0 48px 100px;
            background: linear-gradient(135deg, #161922 0%, #1c2030 100%);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: var(--radius-xl);
            padding: 80px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 500px 300px at 20% 50%, rgba(59,130,246,.18), transparent),
                radial-gradient(ellipse 400px 250px at 80% 50%, rgba(96,165,250,.1), transparent);
            pointer-events: none;
        }
        .cta-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .cta-inner { position: relative; z-index: 1; }
        .cta-title {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: white;
            letter-spacing: -.03em;
            margin-bottom: 16px;
        }
        .cta-title em {
            font-style: normal;
            background: linear-gradient(135deg, var(--accent-g), #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .cta-desc { color: rgba(255,255,255,.55); font-size: 1rem; margin-bottom: 36px; font-weight: 300; }
        .cta-buttons { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn-white {
            background: white;
            color: #0f1117;
        }
        .btn-white:hover { background: #f0f4ff; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(255,255,255,.2); }
        .btn-outline-white {
            background: transparent;
            border: 1px solid rgba(255,255,255,.25);
            color: rgba(255,255,255,.85);
        }
        .btn-outline-white:hover { border-color: rgba(255,255,255,.5); background: rgba(255,255,255,.06); }

        /* ─── FOOTER ──────────────────────────────────────── */
        footer {
            border-top: 1px solid var(--border);
            padding: 40px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            background: var(--surface-2);
        }
        .footer-brand { display: flex; align-items: center; gap: 10px; }
        .footer-copy { font-size: .82rem; color: var(--muted-2); }

        /* ─── ANIMATIONS ──────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .4; }
        }

        /* scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .reveal.visible { opacity: 1; transform: none; }
        .reveal-delay-1 { transition-delay: .1s; }
        .reveal-delay-2 { transition-delay: .2s; }
        .reveal-delay-3 { transition-delay: .3s; }

        /* ─── RESPONSIVE ──────────────────────────────────── */
        @media (max-width: 1024px) {
            .features-grid { grid-template-columns: repeat(2, 1fr); }
            .feature-card.big { grid-column: span 2; }
            .steps-wrap { grid-template-columns: repeat(2, 1fr); }
            .steps-wrap::before { display: none; }
            .mock-kpis { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .nav-links { display: none; }
            .hero { padding: 100px 24px 60px; }
            .preview-section { padding: 0 24px 60px; }
            .section { padding: 60px 24px; }
            .cta-section { margin: 0 24px 60px; padding: 50px 28px; }
            footer { flex-direction: column; align-items: flex-start; padding: 30px 24px; }
            .features-grid { grid-template-columns: 1fr; }
            .feature-card.big { grid-column: span 1; grid-template-columns: 1fr; }
            .steps-wrap { grid-template-columns: 1fr; }
            .mock-dash { grid-template-columns: 1fr; }
            .mock-sidebar { display: none; }
            .hero-stats { gap: 20px; flex-wrap: wrap; }
            .mock-kpis { grid-template-columns: repeat(2, 1fr); }
            .mock-table-head, .mock-table-row { grid-template-columns: 2fr 1fr 1fr; }
            .mock-table-head > *:nth-child(4),
            .mock-table-head > *:nth-child(5),
            .mock-table-row > *:nth-child(4),
            .mock-table-row > *:nth-child(5) { display: none; }
        }
    </style>
</head>
<body>

<!-- ─── NAV ─────────────────────────────────── -->
<nav id="navbar">
    <a href="#" class="nav-logo">
        <div class="nav-logo-icon">A</div>
        <span class="nav-logo-text">Apex<span>IMS</span></span>
    </a>

    <ul class="nav-links">
        <li><a href="#features">Features</a></li>
        <li><a href="#how-it-works">How It Works</a></li>
    </ul>

    <div class="nav-actions">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/inventory') }}" class="btn btn-ghost">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Log In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<!-- ─── HERO ─────────────────────────────────── -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">
            <div class="hero-badge-dot"></div>
            Smart Inventory Management System
        </div>

        <h1>Manage your inventory<br><em>with precision.</em></h1>

        <p class="hero-sub">
            Real-time stock tracking, barcode lookup, supplier management,
            and intelligent alerts — all in one unified platform.
        </p>

        <div class="hero-cta">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/inventory') }}" class="btn btn-primary btn-lg">
                        <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Get Started Free
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">Sign In</a>
                @endauth
            @endif
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">Real-time</div>
                <div class="hero-stat-label">Stock Updates</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">Barcode</div>
                <div class="hero-stat-label">SKU Lookup</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">Smart</div>
                <div class="hero-stat-label">Low-Stock Alerts</div>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <div class="hero-stat-num">Full</div>
                <div class="hero-stat-label">Supplier Tracking</div>
            </div>
        </div>
    </div>
</section>

<!-- ─── DASHBOARD PREVIEW ─────────────────────── -->
<section class="preview-section">
    <div class="preview-wrap">
        <div class="preview-glow"></div>
        <div class="preview-card">
            <div class="preview-topbar">
                <div class="preview-dot pd-red"></div>
                <div class="preview-dot pd-yellow"></div>
                <div class="preview-dot pd-green"></div>
                <div class="preview-url">localhost/inventory/dashboard</div>
            </div>
            <div class="mock-dash">
                <div class="mock-sidebar">
                    <div class="mock-sidebar-logo">
                        <div class="mock-sidebar-logo-icon">A</div>
                        Apex<span style="color:#60a5fa">IMS</span>
                    </div>
                    <div class="mock-nav-item active">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Dashboard
                        <div class="mock-nav-dot"></div>
                    </div>
                    <div class="mock-nav-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0v10l-8 4m-8-4V7m16 0l-8 4m0 10V11"/></svg>
                        Products
                    </div>
                    <div class="mock-nav-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Analytics
                    </div>
                    <div class="mock-nav-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Categories
                    </div>
                    <div class="mock-nav-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        Suppliers
                    </div>
                    <div class="mock-nav-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </div>
                </div>

                <div class="mock-main">
                    <div class="mock-main-header">
                        <div>
                            <div class="mock-title">Dashboard</div>
                            <div class="mock-sub">Your inventory at a glance</div>
                        </div>
                        <button class="mock-add-btn">
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Add Product
                        </button>
                    </div>

                    <div class="mock-kpis">
                        <div class="mock-kpi">
                            <div class="mock-kpi-label">Total Products</div>
                            <div class="mock-kpi-val">1</div>
                        </div>
                        <div class="mock-kpi">
                            <div class="mock-kpi-label">Low Stock</div>
                            <div class="mock-kpi-val">1</div>
                            <div class="mock-kpi-tag tag-amber">⚠ Needs reorder</div>
                        </div>
                        <div class="mock-kpi">
                            <div class="mock-kpi-label">Out of Stock</div>
                            <div class="mock-kpi-val">0</div>
                        </div>
                        <div class="mock-kpi">
                            <div class="mock-kpi-label">Inventory Value</div>
                            <div class="mock-kpi-val">₱10</div>
                            <div class="mock-kpi-tag tag-green">All active</div>
                        </div>
                    </div>

                    <div class="mock-table-wrap">
                        <div class="mock-table-head">
                            <span>Name</span>
                            <span>SKU</span>
                            <span>Category</span>
                            <span>Price</span>
                            <span>Stock</span>
                        </div>
                        <div class="mock-table-row">
                            <div>
                                <div class="mock-item-name">Pringles Crisps Original 5.2oz</div>
                                <div class="mock-sku">038000138416</div>
                            </div>
                            <span style="font-size:.65rem;color:#6b7280;font-family:monospace">038000138416</span>
                            <span>Snacks</span>
                            <span style="color:#e8ecf5">₱3.49</span>
                            <div class="mock-actions">
                                <span style="display:inline-flex;align-items:center;gap:4px;font-size:.63rem;font-weight:600;padding:2px 8px;border-radius:20px;background:rgba(245,158,11,.12);color:#fbbf24;border:1px solid rgba(245,158,11,.2)"><span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block"></span>3 low</span>
                            </div>
                        </div>
                    </div>

                    <div class="mock-chart">
                        <div class="mock-bar" style="height:40%"></div>
                        <div class="mock-bar" style="height:65%"></div>
                        <div class="mock-bar" style="height:50%"></div>
                        <div class="mock-bar" style="height:80%"></div>
                        <div class="mock-bar" style="height:55%"></div>
                        <div class="mock-bar" style="height:90%"></div>
                        <div class="mock-bar" style="height:70%"></div>
                        <div class="mock-bar" style="height:45%"></div>
                        <div class="mock-bar" style="height:75%"></div>
                        <div class="mock-bar" style="height:60%"></div>
                        <div class="mock-bar" style="height:85%"></div>
                        <div class="mock-bar" style="height:95%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── FEATURES ──────────────────────────────── -->
<section class="section" id="features">
    <div class="reveal">
        <div class="section-label">Features</div>
        <h2 class="section-title">Everything you need to<br>manage your inventory</h2>
        <p class="section-desc">Built for businesses that need precision, speed, and reliability in stock management.</p>
    </div>

    <div class="features-grid">
        <!-- Big card: Barcode -->
        <div class="feature-card big reveal reveal-delay-1">
            <div>
                <div class="feature-icon fi-blue">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                </div>
                <h3 class="feature-title">Barcode Lookup</h3>
                <p class="feature-desc">Instantly scan any product barcode or enter a UPC to fetch detailed product information from our global database. Add it to your inventory in seconds.</p>
            </div>
            <div class="feature-visual">
                <div class="barcode-scan">
                    <div class="scan-beam"></div>
                    <div class="barcode-lines">
                        <div class="barcode-line" style="width:3px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:4px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:2px"></div>
                        <div class="barcode-line" style="width:5px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:3px"></div>
                        <div class="barcode-line" style="width:2px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:4px"></div>
                        <div class="barcode-line" style="width:2px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:3px"></div>
                        <div class="barcode-line" style="width:5px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:2px"></div>
                        <div class="barcode-line" style="width:4px"></div>
                        <div class="barcode-line" style="width:1px"></div>
                        <div class="barcode-line" style="width:3px"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Regular card -->
        <div class="feature-card reveal reveal-delay-2">
            <div class="feature-icon fi-green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="feature-title">Real-Time Stock Tracking</h3>
            <p class="feature-desc">Monitor inventory levels live. Every sale, return, or adjustment is reflected instantly — no more manual counting or spreadsheet headaches.</p>
        </div>

        <!-- Big card: Stock levels -->
        <div class="feature-card big reveal reveal-delay-1" style="grid-template-columns: 1fr 1fr;">
            <div>
                <div class="feature-icon fi-amber">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <h3 class="feature-title">Smart Stock Alerts</h3>
                <p class="feature-desc">Set custom low-stock thresholds per product. Get notified before you run out — so you can reorder at the right time, every time.</p>
            </div>
            <div class="feature-visual">
                <div class="stock-bars" style="width:100%">
                    <div class="stock-bar-row">
                        <div class="stock-bar-label">Keyboards</div>
                        <div class="stock-bar-track"><div class="stock-bar-fill" style="width:78%; background: var(--success); animation-delay:.1s"></div></div>
                    </div>
                    <div class="stock-bar-row">
                        <div class="stock-bar-label">Mice</div>
                        <div class="stock-bar-track"><div class="stock-bar-fill" style="width:22%; background: var(--warning); animation-delay:.2s"></div></div>
                    </div>
                    <div class="stock-bar-row">
                        <div class="stock-bar-label">Monitors</div>
                        <div class="stock-bar-track"><div class="stock-bar-fill" style="width:8%; background: var(--danger); animation-delay:.3s"></div></div>
                    </div>
                    <div class="stock-bar-row">
                        <div class="stock-bar-label">Cables</div>
                        <div class="stock-bar-track"><div class="stock-bar-fill" style="width:91%; background: var(--success); animation-delay:.4s"></div></div>
                    </div>
                    <div class="stock-bar-row">
                        <div class="stock-bar-label">Headsets</div>
                        <div class="stock-bar-track"><div class="stock-bar-fill" style="width:55%; background: var(--accent); animation-delay:.5s"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="feature-card reveal reveal-delay-2">
            <div class="feature-icon fi-cyan">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="feature-title">Supplier Management</h3>
            <p class="feature-desc">Maintain a full directory of your suppliers linked to products. Track contacts, delivery terms, and order history from a single view.</p>
        </div>

        <div class="feature-card reveal reveal-delay-1">
            <div class="feature-icon fi-violet">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <h3 class="feature-title">Category Organisation</h3>
            <p class="feature-desc">Group products into categories for quick filtering and reporting. Keep your catalog structured and easy to navigate as you scale.</p>
        </div>

        <div class="feature-card reveal reveal-delay-2">
            <div class="feature-icon fi-red">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h3 class="feature-title">Secure & Role-Based Access</h3>
            <p class="feature-desc">Built on Laravel's authentication system. Control who can view, edit, or manage inventory with confidence and precision.</p>
        </div>

        <div class="feature-card reveal reveal-delay-3">
            <div class="feature-icon fi-blue">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h3 class="feature-title">SKU Search & Filter</h3>
            <p class="feature-desc">Find any product in milliseconds. Search by SKU, name, or category. Powerful filters help you locate exactly what you need, instantly.</p>
        </div>
    </div>
</section>

<!-- ─── HOW IT WORKS ──────────────────────────── -->
<section class="section" id="how-it-works" style="background: var(--surface-2); max-width: 100%; padding: 100px 48px; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
    <div style="max-width: 1140px; margin: 0 auto;">
        <div class="reveal" style="text-align: center;">
            <div class="section-label">How It Works</div>
            <h2 class="section-title">Up and running in minutes</h2>
            <p class="section-desc" style="max-width: 440px; margin: 0 auto;">No complex setup. No training needed. Just sign in and start managing your inventory.</p>
        </div>

        <div class="steps-wrap">
            <div class="step reveal reveal-delay-1">
                <div class="step-num">01</div>
                <div class="step-title">Create Your Account</div>
                <p class="step-desc">Register with your details and get instant access to the full inventory system.</p>
            </div>
            <div class="step reveal reveal-delay-2">
                <div class="step-num">02</div>
                <div class="step-title">Add Your Products</div>
                <p class="step-desc">Import products manually or use barcode lookup to pull details automatically.</p>
            </div>
            <div class="step reveal reveal-delay-3">
                <div class="step-num">03</div>
                <div class="step-title">Set Up Categories & Suppliers</div>
                <p class="step-desc">Organise your catalog and link each product to its supplier for full traceability.</p>
            </div>
            <div class="step reveal reveal-delay-3">
                <div class="step-num">04</div>
                <div class="step-title">Monitor & Stay Informed</div>
                <p class="step-desc">Watch your stock levels in real time and act on alerts before they become problems.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── CTA ───────────────────────────────────── -->
<div style="padding: 100px 0 0;">
    <div class="cta-section">
        <div class="cta-inner">
            <h2 class="cta-title">Ready to take control of<br><em>your inventory?</em></h2>
            <p class="cta-desc">Start managing your stock smarter with ApexIMS — no credit card required.</p>
            <div class="cta-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/inventory') }}" class="btn btn-white btn-lg">Go to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-white btn-lg">
                            Create Free Account
                            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg">Sign In</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ─── FOOTER ────────────────────────────────── -->
<footer>
    <div class="footer-brand">
        <div class="nav-logo-icon" style="width:28px;height:28px;border-radius:7px;font-size:.7rem;">A</div>
        <span style="font-family:var(--font-display);font-weight:700;font-size:.95rem;letter-spacing:-.01em;">Apex<span style="color:var(--accent)">IMS</span></span>
    </div>
    <p class="footer-copy">© {{ date('Y') }} ApexIMS — Inventory Management System. Built with Laravel.</p>
    <p class="footer-copy" style="margin-top:6px;">
        <a href="{{ route('terms') }}" style="color:#6b7280;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#e8ecf5'" onmouseout="this.style.color='#6b7280'">Terms &amp; Conditions</a>
    </p>
</footer>

<!-- ─── TERMS MODAL ────────────────────────────── -->
<style>
    /* Overlay */
    #tc-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(10,12,18,.82);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity .35s ease;
    }
    #tc-overlay.visible { opacity: 1; pointer-events: auto; }

    /* Modal card */
    .tc-modal {
        background: var(--surface-2);
        border: 1px solid var(--border-2);
        border-radius: var(--radius-xl);
        width: 100%;
        max-width: 640px;
        max-height: 88vh;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-xl);
        transform: translateY(24px) scale(.97);
        transition: transform .35s cubic-bezier(.22,1,.36,1);
        overflow: hidden;
    }
    #tc-overlay.visible .tc-modal { transform: translateY(0) scale(1); }

    /* Modal header */
    .tc-modal-header {
        padding: 28px 32px 20px;
        border-bottom: 1px solid var(--border);
        flex-shrink: 0;
    }
    .tc-modal-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .09em;
        text-transform: uppercase;
        color: var(--accent);
        background: rgba(59,130,246,.1);
        border: 1px solid rgba(59,130,246,.22);
        border-radius: 99px;
        padding: 4px 12px;
        margin-bottom: 12px;
    }
    .tc-modal-title {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -.03em;
        color: var(--ink);
        margin-bottom: 4px;
    }
    .tc-modal-sub {
        font-size: .8rem;
        color: var(--muted);
    }

    /* Scrollable body */
    .tc-modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 24px 32px;
        scroll-behavior: smooth;
    }
    .tc-modal-body::-webkit-scrollbar { width: 5px; }
    .tc-modal-body::-webkit-scrollbar-track { background: transparent; }
    .tc-modal-body::-webkit-scrollbar-thumb { background: var(--border-2); border-radius: 99px; }

    /* Sections inside modal */
    .tc-section {
        margin-bottom: 28px;
    }
    .tc-section h3 {
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 8px;
    }
    .tc-section p, .tc-section li {
        font-size: .875rem;
        color: var(--ink-2);
        line-height: 1.7;
    }
    .tc-section ul {
        padding-left: 18px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-top: 6px;
    }
    .tc-section li::marker { color: var(--accent); }

    /* Scroll-to-bottom hint */
    .tc-scroll-hint {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .75rem;
        color: var(--muted);
        margin-bottom: 20px;
        padding: 10px 14px;
        background: rgba(59,130,246,.06);
        border: 1px solid rgba(59,130,246,.14);
        border-radius: var(--radius-sm);
    }
    .tc-scroll-hint svg { flex-shrink: 0; color: var(--accent); }

    /* Modal footer */
    .tc-modal-footer {
        padding: 20px 32px 28px;
        border-top: 1px solid var(--border);
        flex-shrink: 0;
    }

    /* Checkbox row */
    .tc-check-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
        cursor: pointer;
        user-select: none;
    }
    .tc-check-row input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        border: 2px solid var(--border-2);
        border-radius: 6px;
        background: var(--surface-3);
        cursor: pointer;
        position: relative;
        margin-top: 1px;
        transition: border-color .2s, background .2s;
    }
    .tc-check-row input[type="checkbox"]:checked {
        background: var(--accent);
        border-color: var(--accent);
    }
    .tc-check-row input[type="checkbox"]:checked::after {
        content: '';
        position: absolute;
        left: 4px; top: 1px;
        width: 8px; height: 12px;
        border: 2px solid white;
        border-top: none;
        border-left: none;
        transform: rotate(45deg);
    }
    .tc-check-label {
        font-size: .875rem;
        color: var(--ink-2);
        line-height: 1.55;
    }
    .tc-check-label a {
        color: var(--accent);
        text-decoration: none;
    }
    .tc-check-label a:hover { text-decoration: underline; }

    /* Accept button */
    .tc-accept-btn {
        width: 100%;
        padding: 13px;
        background: var(--accent);
        color: white;
        font-family: var(--font-body);
        font-size: .9375rem;
        font-weight: 600;
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s, opacity .2s;
        letter-spacing: -.01em;
    }
    .tc-accept-btn:disabled {
        opacity: .38;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }
    .tc-accept-btn:not(:disabled):hover {
        background: var(--accent-2);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(59,130,246,.38);
    }
    .tc-accept-btn:not(:disabled):active { transform: translateY(0); }

    /* Decline link */
    .tc-decline {
        display: block;
        text-align: center;
        margin-top: 12px;
        font-size: .8rem;
        color: var(--muted-2);
        cursor: pointer;
        text-decoration: none;
        transition: color .2s;
    }
    .tc-decline:hover { color: var(--ink-3); }

    /* Scroll progress bar */
    .tc-progress {
        height: 3px;
        background: var(--border);
        position: relative;
        flex-shrink: 0;
    }
    .tc-progress-bar {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        background: linear-gradient(90deg, var(--accent), var(--accent-g));
        width: 0%;
        transition: width .1s linear;
        border-radius: 99px;
    }
</style>

<div id="tc-overlay" role="dialog" aria-modal="true" aria-labelledby="tc-title">
    <div class="tc-modal">

        <div class="tc-modal-header">
            <div class="tc-modal-badge">
                <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Legal Agreement
            </div>
            <div class="tc-modal-title" id="tc-title">Terms &amp; Conditions</div>
            <div class="tc-modal-sub">Please read and accept before continuing — Effective {{ date('F Y') }}</div>
        </div>

        <div class="tc-progress"><div class="tc-progress-bar" id="tc-progress-bar"></div></div>

        <div class="tc-modal-body" id="tc-body">

            <div class="tc-scroll-hint" id="tc-hint">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                Scroll down to read all terms before accepting.
            </div>

            <div class="tc-section">
                <h3>1. Acceptance of Terms</h3>
                <p>By accessing ApexIMS, you confirm that you have read, understood, and agree to be bound by these Terms. If you are using the System on behalf of an organisation, you represent that you have authority to bind that organisation.</p>
            </div>

            <div class="tc-section">
                <h3>2. System Access &amp; User Accounts</h3>
                <p>Access is granted on a per-account basis. You agree to:</p>
                <ul>
                    <li>Provide accurate and up-to-date registration information.</li>
                    <li>Keep your login credentials strictly confidential.</li>
                    <li>Not share your account or allow unauthorised access.</li>
                    <li>Notify the administrator immediately of any suspected breach.</li>
                </ul>
            </div>

            <div class="tc-section">
                <h3>3. Permitted Use</h3>
                <p>ApexIMS is exclusively for legitimate inventory management. Prohibited actions include:</p>
                <ul>
                    <li>Entering false or misleading inventory data.</li>
                    <li>Attempting to access or disrupt other accounts or system components.</li>
                    <li>Using the System for any unlawful purpose or audit fraud.</li>
                    <li>Reverse-engineering or extracting the source code of the System.</li>
                    <li>Automated scraping or data harvesting without written permission.</li>
                </ul>
            </div>

            <div class="tc-section">
                <h3>4. Data Accuracy &amp; Inventory Records</h3>
                <p>Users are responsible for ensuring all stock entries, quantities, and supplier records are accurate. ApexIMS is not liable for business losses arising from inaccurate data entered by users.</p>
            </div>

            <div class="tc-section">
                <h3>5. Data Security &amp; Confidentiality</h3>
                <p>You are responsible for securing your device and network. Inventory data and supplier information are confidential and must not be shared with unauthorised parties. Report any suspected breach to the administrator immediately.</p>
            </div>

            <div class="tc-section">
                <h3>6. User Roles &amp; Permissions</h3>
                <p>Access is controlled by role-based permissions (Administrator, Operator, Viewer). You must not attempt to perform actions beyond your assigned permission level. Attempting to bypass access controls may result in immediate suspension.</p>
            </div>

            <div class="tc-section">
                <h3>7. Limitation of Liability</h3>
                <p>ApexIMS and its developers are not liable for data loss due to user error, hardware failure, or unforeseen events; business losses from reliance on System data; or downtime due to maintenance or third-party service failures. You are responsible for maintaining regular data backups.</p>
            </div>

            <div class="tc-section">
                <h3>8. Account Termination</h3>
                <p>ApexIMS reserves the right to suspend or terminate any account for violations of these Terms, suspected fraudulent activity, extended inactivity, or at the request of an administrator. Data may be retained as required by applicable law before permanent deletion.</p>
            </div>

            <div class="tc-section">
                <h3>9. Changes to These Terms</h3>
                <p>These Terms may be updated periodically. Continued use of ApexIMS after any update constitutes your acceptance of the revised Terms. The effective date at the top of this document will reflect the latest revision.</p>
            </div>

        </div>

        <div class="tc-modal-footer">
            <label class="tc-check-row">
                <input type="checkbox" id="tc-checkbox" disabled>
                <span class="tc-check-label">
                    I have read and agree to the <a href="{{ route('terms') }}" target="_blank">Terms &amp; Conditions</a> of ApexIMS. I understand my responsibilities regarding data accuracy, security, and permitted use.
                </span>
            </label>
            <button class="tc-accept-btn" id="tc-accept-btn" disabled>
                Accept &amp; Continue
            </button>
            <a class="tc-decline" id="tc-decline">Decline — I do not agree</a>
        </div>

    </div>
</div>

<script>
    // Nav scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    });

    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => observer.observe(el));

    // ─── T&C MODAL ───────────────────────────────────
    const overlay    = document.getElementById('tc-overlay');
    const body       = document.getElementById('tc-body');
    const progressBar= document.getElementById('tc-progress-bar');
    const hint       = document.getElementById('tc-hint');
    const checkbox   = document.getElementById('tc-checkbox');
    const acceptBtn  = document.getElementById('tc-accept-btn');
    const declineBtn = document.getElementById('tc-decline');

    const TC_KEY = 'apexims_tc_accepted';

    // Show modal only if not previously accepted
    if (!sessionStorage.getItem(TC_KEY)) {
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => overlay.classList.add('visible'));
    }

    // Track scroll progress — unlock checkbox when fully read
    let fullyScrolled = false;
    body.addEventListener('scroll', () => {
        const scrolled = body.scrollTop;
        const total    = body.scrollHeight - body.clientHeight;
        const pct      = total > 0 ? Math.min(100, (scrolled / total) * 100) : 100;

        progressBar.style.width = pct + '%';

        if (pct >= 96 && !fullyScrolled) {
            fullyScrolled = true;
            checkbox.disabled = false;
            hint.style.opacity = '0';
            hint.style.transition = 'opacity .4s';
        }
    });

    // Enable accept button only when checkbox is ticked
    checkbox.addEventListener('change', () => {
        acceptBtn.disabled = !checkbox.checked;
    });

    // Accept
    acceptBtn.addEventListener('click', () => {
        sessionStorage.setItem(TC_KEY, '1');
        overlay.style.opacity = '0';
        overlay.style.transition = 'opacity .3s ease';
        setTimeout(() => {
            overlay.remove();
            document.body.style.overflow = '';
        }, 320);
    });

    // Decline — redirect away
    declineBtn.addEventListener('click', () => {
        window.location.href = 'https://www.google.com';
    });
</script>

</body>
</html>
