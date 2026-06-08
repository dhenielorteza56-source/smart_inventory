<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apex Inventory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.19.1/umd/index.min.js"></script>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #0a0c10;
            --surface: #111318;
            --surface-2: #181b22;
            --surface-3: #1f2330;
            --border: rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.14);
            --text: #f0f2f7;
            --text-2: #8a91a8;
            --text-3: #555d75;
            --accent: #4f7cff;
            --accent-light: rgba(79,124,255,0.12);
            --accent-glow: rgba(79,124,255,0.25);
            --green: #22c55e;
            --green-bg: rgba(34,197,94,0.1);
            --amber: #f59e0b;
            --amber-bg: rgba(245,158,11,0.1);
            --red: #ef4444;
            --red-bg: rgba(239,68,68,0.1);
            --radius: 12px;
            --radius-lg: 18px;
            --radius-xl: 24px;
            --shadow: 0 4px 24px rgba(0,0,0,0.4);
            --shadow-lg: 0 16px 48px rgba(0,0,0,0.5);
            --font-display: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
            --sidebar-w: 240px;
            --header-h: 60px;
            --transition: 0.18s cubic-bezier(0.4,0,0.2,1);
        }

        body.light {
            --bg: #f4f6fb;
            --surface: #ffffff;
            --surface-2: #f0f2f8;
            --surface-3: #e8ebf4;
            --border: rgba(0,0,0,0.07);
            --border-hover: rgba(0,0,0,0.14);
            --text: #0d1117;
            --text-2: #5a6278;
            --text-3: #9aa0b8;
            --accent: #3b6ef5;
            --accent-light: rgba(59,110,245,0.1);
            --accent-glow: rgba(59,110,245,0.2);
            --shadow: 0 4px 24px rgba(0,0,0,0.08);
            --shadow-lg: 0 16px 48px rgba(0,0,0,0.12);
        }

        html, body { height: 100%; }
        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            transition: background var(--transition), color var(--transition);
        }

        /* ─── LAYOUT ─── */
        .app { display: flex; height: 100vh; overflow: hidden; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width var(--transition);
        }

        .sidebar-logo {
            height: var(--header-h);
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .logo-icon {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: white; font-weight: 700;
        }
        .logo-text {
            font-family: var(--font-display);
            font-size: 16px; font-weight: 700;
            color: var(--text); letter-spacing: -0.02em;
        }
        .logo-text span { color: var(--accent); }

        .sidebar-nav {
            flex: 1; overflow-y: auto; padding: 12px 10px;
        }
        .nav-section-label {
            font-size: 10px; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--text-3);
            padding: 8px 10px 4px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: var(--radius);
            cursor: pointer; color: var(--text-2);
            font-size: 13.5px; font-weight: 500;
            transition: all var(--transition);
            margin-bottom: 2px; white-space: nowrap;
        }
        .nav-item .nav-icon {
            width: 18px; text-align: center; font-size: 13px; flex-shrink: 0;
        }
        .nav-item:hover { background: var(--surface-2); color: var(--text); }
        .nav-item.active {
            background: var(--accent-light);
            color: var(--accent);
        }
        .nav-item.active .nav-icon { color: var(--accent); }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--border);
        }
        .user-block {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 12px; border-radius: var(--radius);
            cursor: pointer;
        }
        .user-avatar {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--accent); display: flex; align-items: center;
            justify-content: center; font-size: 11px; font-weight: 700;
            color: white; flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 500; color: var(--text); }
        .user-role { font-size: 11px; color: var(--text-3); }

        /* ─── MAIN CONTENT ─── */
        .main {
            flex: 1; display: flex; flex-direction: column; overflow: hidden;
        }

        .topbar {
            height: var(--header-h); flex-shrink: 0;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 24px; gap: 12px;
        }
        .topbar-title {
            font-family: var(--font-display);
            font-size: 17px; font-weight: 700; letter-spacing: -0.02em;
            color: var(--text); flex: 1;
        }
        .topbar-actions { display: flex; align-items: center; gap: 8px; }

        .icon-btn {
            width: 34px; height: 34px; border-radius: var(--radius);
            background: var(--surface-2); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-2);
            font-size: 13px; transition: all var(--transition);
        }
        .icon-btn:hover { background: var(--surface-3); color: var(--text); border-color: var(--border-hover); }

        .content { flex: 1; overflow-y: auto; padding: 24px; }

        /* ─── PAGE SECTIONS ─── */
        .page { display: none; animation: fadeIn 0.2s ease; }
        .page.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }

        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 24px; gap: 16px; flex-wrap: wrap;
        }
        .page-title {
            font-family: var(--font-display);
            font-size: 22px; font-weight: 700; letter-spacing: -0.03em;
            color: var(--text);
        }
        .page-subtitle { font-size: 13px; color: var(--text-2); margin-top: 2px; }

        /* ─── STATS GRID ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px; margin-bottom: 24px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            transition: all var(--transition);
            cursor: default;
        }
        .stat-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }
        .stat-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; margin-bottom: 14px;
        }
        .stat-icon.blue { background: var(--accent-light); color: var(--accent); }
        .stat-icon.amber { background: var(--amber-bg); color: var(--amber); }
        .stat-icon.red { background: var(--red-bg); color: var(--red); }
        .stat-icon.green { background: var(--green-bg); color: var(--green); }
        .stat-value {
            font-family: var(--font-display);
            font-size: 26px; font-weight: 700; letter-spacing: -0.04em;
            color: var(--text); line-height: 1;
        }
        .stat-label {
            font-size: 12px; color: var(--text-2); margin-top: 6px;
            text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500;
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
        }
        .card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 20px; border-bottom: 1px solid var(--border);
            flex-wrap: wrap; gap: 12px;
        }
        .card-title {
            font-family: var(--font-display);
            font-size: 15px; font-weight: 700; letter-spacing: -0.02em;
            color: var(--text); display: flex; align-items: center; gap: 8px;
        }
        .card-title i { font-size: 13px; color: var(--text-2); }
        .card-body { padding: 20px; }

        /* ─── TABLE ─── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 0 16px 12px;
            text-align: left; font-size: 11px; font-weight: 600;
            color: var(--text-3); text-transform: uppercase;
            letter-spacing: 0.07em; white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }
        tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text); font-size: 13.5px; vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--transition); }
        tbody tr:hover td { background: var(--surface-2); }

        .product-thumb {
            width: 34px; height: 34px; border-radius: 8px;
            object-fit: cover; border: 1px solid var(--border);
        }
        .thumb-placeholder {
            width: 34px; height: 34px; border-radius: 8px;
            background: var(--surface-2); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-3); font-size: 12px;
        }

        .col-name { font-weight: 500; }
        .col-sku { font-family: 'DM Mono', monospace; font-size: 12px; color: var(--text-2); }

        .row-actions { display: flex; gap: 4px; }
        .row-btn {
            width: 28px; height: 28px; border-radius: 7px;
            background: transparent; border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-3); font-size: 12px;
            transition: all var(--transition);
        }
        .row-btn:hover { background: var(--surface-2); color: var(--text-2); }
        .row-btn.danger:hover { background: var(--red-bg); color: var(--red); }

        /* ─── BADGES ─── */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 99px;
            font-size: 11px; font-weight: 600; letter-spacing: 0.02em;
        }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; }
        .badge-ok { background: var(--green-bg); color: var(--green); }
        .badge-ok::before { background: var(--green); }
        .badge-low { background: var(--amber-bg); color: var(--amber); }
        .badge-low::before { background: var(--amber); }
        .badge-out { background: var(--red-bg); color: var(--red); }
        .badge-out::before { background: var(--red); }

        /* ─── BUTTONS ─── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 16px; border-radius: var(--radius);
            font-family: var(--font-body); font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all var(--transition);
            border: 1px solid transparent; white-space: nowrap;
        }
        .btn i { font-size: 11px; }
        .btn-primary {
            background: var(--accent); color: white;
            box-shadow: 0 0 0 0 var(--accent-glow);
        }
        .btn-primary:hover {
            filter: brightness(1.1);
            box-shadow: 0 4px 16px var(--accent-glow);
        }
        .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; filter: none; }
        .btn-ghost {
            background: var(--surface-2); color: var(--text-2);
            border-color: var(--border);
        }
        .btn-ghost:hover { background: var(--surface-3); color: var(--text); border-color: var(--border-hover); }
        .btn-danger { background: var(--red-bg); color: var(--red); border-color: transparent; }
        .btn-danger:hover { background: var(--red); color: white; }

        /* ─── SEARCH / FILTER BAR ─── */
        .filter-bar {
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
        }
        .search-wrap { position: relative; }
        .search-wrap i {
            position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
            color: var(--text-3); font-size: 12px; pointer-events: none;
        }
        .search-input, .select-input {
            background: var(--surface-2); border: 1px solid var(--border);
            color: var(--text); padding: 7px 12px 7px 32px;
            border-radius: var(--radius); font-family: var(--font-body);
            font-size: 13px; outline: none;
            transition: border-color var(--transition);
            min-width: 200px;
        }
        .select-input { padding-left: 12px; min-width: 150px; }
        .search-input:focus, .select-input:focus { border-color: var(--accent); }
        .search-input::placeholder { color: var(--text-3); }

        /* ─── FORMS ─── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label {
            font-size: 11.5px; font-weight: 600; color: var(--text-2);
            text-transform: uppercase; letter-spacing: 0.05em;
        }
        .form-input, .form-select, .form-textarea {
            background: var(--surface-2); border: 1.5px solid var(--border);
            color: var(--text); padding: 9px 12px;
            border-radius: var(--radius); font-family: var(--font-body);
            font-size: 13.5px; outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }
        .form-input::placeholder { color: var(--text-3); }
        .form-textarea { resize: vertical; min-height: 80px; }
        .field-error { font-size: 12px; color: var(--red); }

        /* ─── UPLOAD AREA ─── */
        .upload-area {
            border: 1.5px dashed var(--border);
            border-radius: var(--radius);
            padding: 24px; text-align: center;
            cursor: pointer; transition: all var(--transition);
            color: var(--text-2);
        }
        .upload-area:hover, .upload-area.drag-over {
            border-color: var(--accent); background: var(--accent-light);
        }
        .upload-area i { font-size: 22px; color: var(--text-3); margin-bottom: 8px; display: block; }
        .upload-area p { font-size: 13px; color: var(--text-2); }
        .upload-area span { font-size: 12px; color: var(--text-3); }

        /* ─── MODAL ─── */
        .modal-backdrop {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
            z-index: 500; align-items: center; justify-content: center;
            padding: 20px;
        }
        .modal-backdrop.open { display: flex; }
        .modal {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius-xl); padding: 28px;
            width: 100%; max-width: 560px; max-height: 90vh;
            overflow-y: auto; box-shadow: var(--shadow-lg);
            animation: modalIn 0.2s cubic-bezier(0.34,1.56,0.64,1);
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(8px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-sm { max-width: 380px; }
        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 22px;
        }
        .modal-title {
            font-family: var(--font-display);
            font-size: 17px; font-weight: 700; color: var(--text);
        }
        .modal-close {
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--surface-2); border: none;
            color: var(--text-2); cursor: pointer; font-size: 13px;
            display: flex; align-items: center; justify-content: center;
            transition: all var(--transition);
        }
        .modal-close:hover { background: var(--surface-3); color: var(--text); }
        .modal-footer {
            display: flex; gap: 8px; justify-content: flex-end;
            margin-top: 22px; padding-top: 18px;
            border-top: 1px solid var(--border);
        }

        /* ─── TOAST ─── */
        .toast-container {
            position: fixed; bottom: 20px; right: 20px;
            display: flex; flex-direction: column; gap: 8px;
            z-index: 9999;
        }
        .toast {
            background: var(--surface);
            border: 1px solid var(--border);
            border-left: 3px solid var(--accent);
            padding: 12px 16px; border-radius: var(--radius);
            font-size: 13px; font-weight: 500; color: var(--text);
            box-shadow: var(--shadow-lg); min-width: 240px;
            animation: toastIn 0.25s ease;
        }
        .toast.error { border-left-color: var(--red); }
        .toast.warning { border-left-color: var(--amber); }
        .toast.ok { border-left-color: var(--green); }
        @keyframes toastIn { from { opacity: 0; transform: translateX(16px); } to { opacity: 1; transform: translateX(0); } }

        /* ─── LOADING ─── */
        .loading-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.3); backdrop-filter: blur(2px);
            z-index: 400; align-items: center; justify-content: center;
        }
        .loading-overlay.active { display: flex; }
        .loading-spinner {
            width: 40px; height: 40px; border: 3px solid var(--border);
            border-top-color: var(--accent); border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes scanAnim { 0%,100% { top: 0%; } 50% { top: calc(100% - 2px); } }
        .btn-spinner {
            display: inline-block; width: 14px; height: 14px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white; border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        /* ─── STATUS MESSAGES ─── */
        .status-msg {
            padding: 11px 14px; border-radius: var(--radius);
            font-size: 13px; margin-top: 12px;
            display: flex; align-items: flex-start; gap: 8px;
        }
        .status-info { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(79,124,255,0.2); }
        .status-success { background: var(--green-bg); color: var(--green); }
        .status-warning { background: var(--amber-bg); color: var(--amber); }
        .status-error { background: var(--red-bg); color: var(--red); }

        /* ─── PAGINATION ─── */
        .pagination {
            display: flex; align-items: center; gap: 4px;
            justify-content: center; padding: 16px 20px;
            border-top: 1px solid var(--border);
        }
        .page-btn {
            min-width: 32px; height: 32px; border-radius: 8px;
            background: transparent; border: 1px solid transparent;
            color: var(--text-2); font-size: 13px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all var(--transition); font-family: var(--font-body);
        }
        .page-btn:hover { background: var(--surface-2); color: var(--text); }
        .page-btn.active { background: var(--accent); color: white; border-color: var(--accent); }

        /* ─── ANALYTICS ─── */
        .analytics-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .bar-item {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 0; font-size: 13px;
        }
        .bar-label { width: 110px; color: var(--text); font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .bar-track { flex: 1; height: 6px; background: var(--surface-3); border-radius: 99px; overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 99px; transition: width 0.6s cubic-bezier(0.4,0,0.2,1); }
        .bar-count { min-width: 30px; text-align: right; color: var(--text-2); font-size: 12px; }

        .top-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 0; border-bottom: 1px solid var(--border);
            font-size: 13px;
        }
        .top-item:last-child { border-bottom: none; }
        .top-rank {
            width: 22px; height: 22px; border-radius: 6px;
            background: var(--surface-2); color: var(--text-3);
            font-size: 11px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
        }
        .top-name { flex: 1; font-weight: 500; }
        .top-value { font-weight: 700; color: var(--accent); font-family: var(--font-display); font-size: 14px; }

        .alert-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 12px; border-radius: var(--radius);
            background: var(--surface-2); margin-bottom: 6px;
            font-size: 13px;
        }
        .alert-name { font-weight: 500; }
        .alert-count { font-weight: 700; color: var(--red); }

        /* ─── SCAN PAGE ─── */
        .detail-row {
            display: flex; gap: 12px; padding: 10px 0;
            border-bottom: 1px solid var(--border); font-size: 13.5px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { width: 100px; color: var(--text-2); font-weight: 500; flex-shrink: 0; }
        .detail-value { color: var(--text); }
        .detail-image { max-width: 160px; max-height: 160px; border-radius: var(--radius); border: 1px solid var(--border); }

        /* ─── SETTINGS ─── */
        .settings-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 0; border-bottom: 1px solid var(--border);
        }
        .settings-row:last-child { border-bottom: none; }
        .settings-label { font-size: 14px; font-weight: 500; color: var(--text); }
        .settings-desc { font-size: 12px; color: var(--text-2); margin-top: 2px; }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center; padding: 48px 20px;
            color: var(--text-2);
        }
        .empty-state i { font-size: 32px; color: var(--text-3); margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }

        /* ─── PREVIEW IMAGE ─── */
        .preview-img { max-width: 100%; max-height: 160px; border-radius: var(--radius); border: 1px solid var(--border); margin-top: 10px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .sidebar { width: 60px; }
            .logo-text, .nav-item .nav-label, .user-name, .user-role, .nav-section-label { display: none; }
            .nav-item { justify-content: center; padding: 10px; }
            .sidebar-logo { justify-content: center; padding: 0 14px; }
            .content { padding: 16px; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .analytics-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .search-input { min-width: unset; width: 100%; }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">A</div>
            <div class="logo-text">Apex<span>IMS</span></div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>
            <div class="nav-item active" data-page="dashboardPage">
                <span class="nav-icon"><i class="fas fa-table-cells-large" style="font-size:13px;"></i></span>
                <span class="nav-label">Dashboard</span>
            </div>
            <div class="nav-item" data-page="stockPage">
                <span class="nav-icon"><i class="fas fa-boxes-stacked"></i></span>
                <span class="nav-label">Products</span>
            </div>
            <div class="nav-item" data-page="scanPage">
                <span class="nav-icon"><i class="fas fa-barcode"></i></span>
                <span class="nav-label">Scan</span>
            </div>

            <div class="nav-section-label" style="margin-top:8px;">Insights</div>
            <div class="nav-item" data-page="analyticsPage">
                <span class="nav-icon"><i class="fas fa-chart-simple"></i></span>
                <span class="nav-label">Analytics</span>
            </div>

            <div class="nav-section-label" style="margin-top:8px;">Config</div>
            <div class="nav-item" data-page="categoriesPage">
                <span class="nav-icon"><i class="fas fa-tag"></i></span>
                <span class="nav-label">Categories</span>
            </div>
            <div class="nav-item" data-page="suppliersPage">
                <span class="nav-icon"><i class="fas fa-truck"></i></span>
                <span class="nav-label">Suppliers</span>
            </div>
            <div class="nav-item" data-page="settingsPage">
                <span class="nav-icon"><i class="fas fa-sliders"></i></span>
                <span class="nav-label">Settings</span>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-block">
                <div class="user-avatar" id="userAvatar">U</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Admin</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:6px;">
                @csrf
                <button type="submit" class="btn btn-ghost" style="width:100%;justify-content:center;font-size:12px;padding:7px;">
                    <i class="fas fa-arrow-right-from-bracket"></i>
                    <span class="nav-label">Sign out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══ MAIN ═══ -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-title" id="topbarTitle">Dashboard</div>
            <div class="topbar-actions">
                <button class="icon-btn" onclick="toggleTheme()" title="Toggle theme" id="themeBtn">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </button>
                <button class="btn btn-primary" onclick="openAddProductModal()">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- ──── DASHBOARD ──── -->
            <div id="dashboardPage" class="page active">
                <div class="page-header">
                    <div>
                        <div class="page-title">Overview</div>
                        <div class="page-subtitle">Your inventory at a glance</div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-boxes-stacked"></i></div>
                        <div class="stat-value" id="totalProductsStat">{{ $stats['total_products'] }}</div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon amber"><i class="fas fa-triangle-exclamation"></i></div>
                        <div class="stat-value" id="lowStockStat">{{ $stats['low_stock'] }}</div>
                        <div class="stat-label">Low Stock</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon red"><i class="fas fa-circle-xmark"></i></div>
                        <div class="stat-value" id="outOfStockStat">{{ $stats['out_of_stock'] }}</div>
                        <div class="stat-label">Out of Stock</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                        <div class="stat-value" id="totalValueStat">₱{{ number_format($stats['total_value'], 0) }}</div>
                        <div class="stat-label">Inventory Value</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-clock-rotate-left"></i> Recent Products</div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:48px;"></th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th style="width:80px;"></th>
                                </tr>
                            </thead>
                            <tbody id="recentList">
                                <tr><td colspan="7"><div class="empty-state"><i class="fas fa-circle-notch fa-spin"></i><p>Loading...</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ──── PRODUCTS / STOCK ──── -->
            <div id="stockPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Products</div>
                        <div class="page-subtitle">Manage your inventory items</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="filter-bar">
                            <div class="search-wrap">
                                <i class="fas fa-magnifying-glass"></i>
                                <input type="text" id="searchStock" class="search-input" placeholder="Search name or SKU...">
                            </div>
                            <select id="filterCategory" class="select-input">
                                <option value="">All categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:48px;"></th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th style="width:80px;"></th>
                                </tr>
                            </thead>
                            <tbody id="stockList">
                                <tr><td colspan="8"><div class="empty-state"><i class="fas fa-circle-notch fa-spin"></i><p>Loading...</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="stockPagination" class="pagination" style="display:none;"></div>
                </div>
            </div>

            <!-- ──── SCAN ──── -->
            <div id="scanPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Scan</div>
                        <div class="page-subtitle">Look up products by barcode using your camera</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><i class="fas fa-barcode"></i> Barcode Scanner</div>
                    </div>
                    <div class="card-body">

                        {{-- Camera panel --}}
                        <div id="cameraScanPanel">
                            <div id="cameraContainer" style="position:relative;width:100%;max-width:500px;margin:0 auto;border-radius:12px;overflow:hidden;background:#000;aspect-ratio:16/9;">
                                <video id="cameraFeed" style="width:100%;height:100%;object-fit:cover;" playsinline muted></video>
                                {{-- Barcode scanner line overlay --}}
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;pointer-events:none;">
                                    <div style="width:80%;height:30%;border:2px solid rgba(255,255,255,0.6);border-radius:8px;box-shadow:0 0 0 9999px rgba(0,0,0,0.45);position:relative;">
                                        <div id="scanLine" style="position:absolute;top:0;left:0;right:0;height:2px;background:var(--accent);box-shadow:0 0 8px var(--accent);animation:scanAnim 1.8s ease-in-out infinite;"></div>
                                    </div>
                                </div>
                                <div id="cameraHint" style="position:absolute;bottom:12px;left:0;right:0;text-align:center;color:#fff;font-size:12px;text-shadow:0 1px 3px #000;">Point camera at barcode</div>
                            </div>
                            <div style="display:flex;gap:8px;justify-content:center;margin-top:12px;">
                                <button id="startCameraBtn" class="btn btn-primary" onclick="startCamera()">
                                    <i class="fas fa-video"></i> Start Camera
                                </button>
                                <button id="stopCameraBtn" class="btn btn-ghost" onclick="stopCamera()" style="display:none;">
                                    <i class="fas fa-stop"></i> Stop
                                </button>
                            </div>
                        </div>

                        <div id="scannerStatus" style="display:none;margin-top:12px;"></div>

                        <div class="status-msg status-info" style="margin-top:14px;">
                            <i class="fas fa-lightbulb"></i>
                            <span>Supports EAN-13, UPC-A, Code 128, Code 39 and more. Hold barcode steady inside the box. You can also type the SKU below.</span>
                        </div>

                        {{-- ── Drag & Drop / Click-to-Upload Image Barcode Scanner ── --}}
                        <div style="margin-top:18px;">
                            <div class="form-label" style="margin-bottom:6px;">Or scan a barcode image</div>
                            <div id="barcodeDropZone"
                                 style="border:2px dashed var(--border);border-radius:12px;padding:28px 16px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;background:var(--surface-2);position:relative;"
                                 onclick="document.getElementById('barcodeImageInput').click()"
                                 ondragover="handleDragOver(event)"
                                 ondragleave="handleDragLeave(event)"
                                 ondrop="handleImageDrop(event)">
                                <input type="file" id="barcodeImageInput" accept="image/*" style="display:none;" onchange="handleImageFile(this.files[0])">
                                <div id="dropZoneIdle">
                                    <i class="fas fa-image" style="font-size:28px;color:var(--text-3);margin-bottom:8px;display:block;"></i>
                                    <div style="font-size:14px;font-weight:600;color:var(--text-2);">Drop a barcode image here</div>
                                    <div style="font-size:12px;color:var(--text-3);margin-top:4px;">or click to browse &mdash; PNG, JPG, GIF, WebP</div>
                                </div>
                                <div id="dropZoneProcessing" style="display:none;">
                                    <i class="fas fa-spinner fa-spin" style="font-size:24px;color:var(--accent);margin-bottom:8px;display:block;"></i>
                                    <div style="font-size:14px;color:var(--text-2);">Reading barcode&hellip;</div>
                                </div>
                                <div id="dropZoneResult" style="display:none;align-items:center;gap:10px;justify-content:center;flex-wrap:wrap;">
                                    <img id="dropZoneThumb" style="width:56px;height:56px;object-fit:contain;border-radius:8px;border:1px solid var(--border);background:#fff;" src="" alt="scanned image">
                                    <div style="text-align:left;">
                                        <div id="dropZoneResultText" style="font-size:13px;font-weight:600;color:var(--text-1);"></div>
                                        <button class="btn btn-ghost" style="font-size:11px;padding:3px 10px;margin-top:4px;" onclick="event.stopPropagation();resetDropZone()">
                                            <i class="fas fa-rotate-left"></i> Scan another image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:18px;">
                            <div class="form-label" style="margin-bottom:6px;">Or enter SKU / Barcode manually</div>
                            <div style="display:flex;gap:8px;">
                                <div class="search-wrap" style="flex:1;">
                                    <i class="fas fa-magnifying-glass"></i>
                                    <input type="text" id="manualBarcode" class="search-input" placeholder="Type barcode or SKU..." style="width:100%;" onkeydown="if(event.key==='Enter') manualSubmit()">
                                </div>
                                <button class="btn btn-primary" onclick="manualSubmit()">Lookup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="productDetail" class="card" style="display:none;">
                    <div class="card-header">
                        <div class="card-title" id="detailCardTitle"><i class="fas fa-box"></i> Product Found</div>
                        <span id="detailSourceBadge" style="font-size:11px;padding:3px 10px;border-radius:99px;font-weight:600;"></span>
                    </div>
                    <div class="card-body">
                        <div style="display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap;">
                            <div id="detailImageContainer" style="flex-shrink:0;"></div>
                            <div style="flex:1;min-width:200px;">
                                <div class="detail-row"><div class="detail-label">Barcode</div><div class="detail-value col-sku" id="detailBarcode"></div></div>
                                <div class="detail-row"><div class="detail-label">Name</div><div class="detail-value" id="detailName" style="font-weight:600;"></div></div>
                                <div class="detail-row" id="detailBrandRow" style="display:none;"><div class="detail-label">Brand</div><div class="detail-value" id="detailBrand"></div></div>
                                <div class="detail-row" id="detailCategoryRow"><div class="detail-label">Category</div><div class="detail-value" id="detailCategory"></div></div>
                                <div class="detail-row" id="detailSupplierRow"><div class="detail-label">Supplier</div><div class="detail-value" id="detailSupplier"></div></div>
                                <div class="detail-row"><div class="detail-label">Price</div><div class="detail-value" id="detailPrice"></div></div>
                                <div class="detail-row" id="detailStockRow"><div class="detail-label">Stock</div><div class="detail-value" id="detailStock"></div></div>
                                <div class="detail-row"><div class="detail-label">Description</div><div class="detail-value" id="detailDesc" style="color:var(--text-2);font-size:13px;"></div></div>
                            </div>
                        </div>
                        <div style="display:flex;gap:8px;margin-top:18px;flex-wrap:wrap;">
                            <button class="btn btn-primary" id="detailEditBtn" onclick="editFoundProduct()" style="display:none;"><i class="fas fa-pen"></i> Edit Product</button>
                            <button class="btn btn-primary" id="detailAddBtn" onclick="addFoundExternalProduct()" style="display:none;"><i class="fas fa-plus"></i> Add to Inventory</button>
                            <button class="btn btn-ghost" onclick="resetScan()"><i class="fas fa-barcode"></i> Scan Another</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ──── ANALYTICS ──── -->
            <div id="analyticsPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Analytics</div>
                        <div class="page-subtitle">Insights into your inventory health</div>
                    </div>
                </div>

                <div class="stats-grid" style="margin-bottom:20px;">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-boxes-stacked"></i></div>
                        <div class="stat-value" id="anTotalProducts">0</div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                        <div class="stat-value" id="anTotalValue">$0</div>
                        <div class="stat-label">Inventory Value</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon amber"><i class="fas fa-triangle-exclamation"></i></div>
                        <div class="stat-value" id="anLowStock">0</div>
                        <div class="stat-label">Low Stock Items</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-tag"></i></div>
                        <div class="stat-value" id="anAvgPrice">$0</div>
                        <div class="stat-label">Avg. Price</div>
                    </div>
                </div>

                <div class="analytics-grid">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-tag"></i> Stock by Category</div>
                        </div>
                        <div class="card-body" id="categoryBars"></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-trophy"></i> Top 5 by Value</div>
                        </div>
                        <div class="card-body" id="topValueList"></div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-heart-pulse"></i> Stock Health</div>
                        </div>
                        <div class="card-body">
                            <div id="stockHealthChart"></div>
                            <div id="stockHealthLegend" style="display:flex;gap:16px;margin-top:12px;font-size:12px;color:var(--text-2);flex-wrap:wrap;"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-triangle-exclamation" style="color:var(--red);"></i> Low Stock Alerts</div>
                        </div>
                        <div class="card-body" id="lowStockAlerts"></div>
                    </div>
                </div>
            </div>

            <!-- ──── CATEGORIES ──── -->
            <div id="categoriesPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Categories</div>
                        <div class="page-subtitle">Organize your product catalog</div>
                    </div>
                    <button class="btn btn-primary" onclick="openAddCategoryModal()">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>

                <div class="card">
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Products</th>
                                    <th style="width:80px;"></th>
                                </tr>
                            </thead>
                            <tbody id="categoriesList">
                                <tr><td colspan="4"><div class="empty-state"><i class="fas fa-circle-notch fa-spin"></i><p>Loading...</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ──── SUPPLIERS ──── -->
            <div id="suppliersPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Suppliers</div>
                        <div class="page-subtitle">Manage your vendor relationships</div>
                    </div>
                    <button class="btn btn-primary" onclick="openAddSupplierModal()">
                        <i class="fas fa-plus"></i> Add Supplier
                    </button>
                </div>

                <div class="card">
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Products</th>
                                    <th style="width:80px;"></th>
                                </tr>
                            </thead>
                            <tbody id="suppliersList">
                                <tr><td colspan="6"><div class="empty-state"><i class="fas fa-circle-notch fa-spin"></i><p>Loading...</p></div></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ──── SETTINGS ──── -->
            <div id="settingsPage" class="page">
                <div class="page-header">
                    <div>
                        <div class="page-title">Settings</div>
                        <div class="page-subtitle">Configure your preferences</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="settings-row">
                            <div>
                                <div class="settings-label">Low Stock Threshold</div>
                                <div class="settings-desc">Alert when quantity falls below this number</div>
                            </div>
                            <input type="number" id="stockThreshold" value="10" min="1"
                                class="form-input" style="width:100px; text-align:center;">
                        </div>
                        <div class="settings-row">
                            <div>
                                <div class="settings-label">Appearance</div>
                                <div class="settings-desc">Choose your preferred color scheme</div>
                            </div>
                            <select id="themeSelect" class="form-select" style="width:140px;">
                                <option value="dark">Dark</option>
                                <option value="light">Light</option>
                            </select>
                        </div>
                        <div style="margin-top:20px;">
                            <button class="btn btn-primary" onclick="saveSettings()">
                                <i class="fas fa-floppy-disk"></i> Save Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->
</div><!-- /app -->

<!-- ═══ TOAST CONTAINER ═══ -->
<div class="toast-container" id="toastContainer"></div>

<!-- ═══ LOADING ═══ -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<!-- ═══ PRODUCT MODAL ═══ -->
<div class="modal-backdrop" id="productModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="productModalTitle">Add Product</div>
            <button class="modal-close" onclick="closeModal('productModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Product Name *</label>
                <input type="text" id="pm_name" class="form-input" placeholder="Enter product name">
                <div class="field-error" id="err_name"></div>
            </div>
            <div class="form-group">
                <label class="form-label">SKU *</label>
                <input type="text" id="pm_sku" class="form-input" placeholder="e.g. PRD-001">
                <div class="field-error" id="err_sku"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Price *</label>
                <input type="number" id="pm_price" class="form-input" placeholder="0.00" step="0.01" min="0">
                <div class="field-error" id="err_price"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Quantity *</label>
                <input type="number" id="pm_quantity" class="form-input" placeholder="0" min="0">
                <div class="field-error" id="err_quantity"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Category *</label>
                <select id="pm_category" class="form-select">
                    <option value="">Select category...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <div class="field-error" id="err_category"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Supplier *</label>
                <select id="pm_supplier" class="form-select">
                    <option value="">Select supplier...</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                    @endforeach
                </select>
                <div class="field-error" id="err_supplier"></div>
            </div>
            <div class="form-group full">
                <label class="form-label">Product Image</label>
                <div class="upload-area" id="pm_dropZone" style="padding:16px;">
                    <i class="fas fa-image" style="font-size:18px;margin-bottom:4px;"></i>
                    <p style="font-size:12px;">Click to upload image</p>
                    <input type="file" id="pm_imageFile" accept="image/jpeg,image/png" style="display:none;">
                </div>
                <div id="pm_imagePreview" style="text-align:center;"></div>
            </div>
            <div class="form-group full">
                <label class="form-label">Description</label>
                <textarea id="pm_description" class="form-textarea" placeholder="Product description..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('productModal')">Cancel</button>
            <button class="btn btn-primary" id="pm_saveBtn" onclick="saveProduct()">
                <i class="fas fa-floppy-disk"></i> Save Product
            </button>
        </div>
    </div>
</div>

<!-- ═══ CATEGORY MODAL ═══ -->
<div class="modal-backdrop" id="categoryModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div class="modal-title" id="categoryModalTitle">Add Category</div>
            <button class="modal-close" onclick="closeModal('categoryModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label class="form-label">Category Name *</label>
            <input type="text" id="cm_name" class="form-input" placeholder="Category name">
            <div class="field-error" id="err_cm_name"></div>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea id="cm_description" class="form-textarea" placeholder="Optional description..." style="min-height:60px;"></textarea>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('categoryModal')">Cancel</button>
            <button class="btn btn-primary" onclick="saveCategory()">Save</button>
        </div>
    </div>
</div>

<!-- ═══ SUPPLIER MODAL ═══ -->
<div class="modal-backdrop" id="supplierModal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="supplierModalTitle">Add Supplier</div>
            <button class="modal-close" onclick="closeModal('supplierModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" id="sm_name" class="form-input" placeholder="Supplier name">
                <div class="field-error" id="err_sm_name"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" id="sm_email" class="form-input" placeholder="supplier@email.com">
                <div class="field-error" id="err_sm_email"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Phone *</label>
                <input type="text" id="sm_phone" class="form-input" placeholder="+1 234 567 8900">
                <div class="field-error" id="err_sm_phone"></div>
            </div>
            <div class="form-group">
                <label class="form-label">Address *</label>
                <input type="text" id="sm_address" class="form-input" placeholder="Full address">
                <div class="field-error" id="err_sm_address"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('supplierModal')">Cancel</button>
            <button class="btn btn-primary" onclick="saveSupplier()">Save</button>
        </div>
    </div>
</div>

<!-- ═══ STOCK UPDATE MODAL ═══ -->
<div class="modal-backdrop" id="stockModal">
    <div class="modal modal-sm">
        <div class="modal-header">
            <div class="modal-title">Update Stock</div>
            <button class="modal-close" onclick="closeModal('stockModal')"><i class="fas fa-xmark"></i></button>
        </div>
        <div id="stockModalProductName" style="font-size:13px;color:var(--text-2);margin-bottom:14px;"></div>
        <div class="form-group">
            <label class="form-label">New Quantity *</label>
            <input type="number" id="stockModal_qty" class="form-input" min="0" placeholder="Enter quantity">
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('stockModal')">Cancel</button>
            <button class="btn btn-primary" onclick="confirmUpdateStock()">Update</button>
        </div>
    </div>
</div>

<script>
// ─── CONFIG & STATE ───
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let settings = (() => {
    try { return JSON.parse(localStorage.getItem('apexSettings')) || { stockThreshold: 10, theme: 'dark' }; }
    catch { return { stockThreshold: 10, theme: 'dark' }; }
})();

let allProducts = [], allCategories = [], allSuppliers = [];
let editingProductId = null, editingCategoryId = null, editingSupplierId = null;
let stockUpdateProductId = null, currentProductImageData = null;
let foundProduct = null;

// ─── API ───
async function apiFetch(url, options = {}) {
    const defaults = { headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' } };
    const merged = { ...defaults, ...options, headers: { ...defaults.headers, ...(options.headers || {}) } };
    const res = await fetch(url, merged);
    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw { status: res.status, data };
    return data;
}

function showLoading() { document.getElementById('loadingOverlay').classList.add('active'); }
function hideLoading() { document.getElementById('loadingOverlay').classList.remove('active'); }

// ─── TOAST ───
function showToast(msg, type = 'success') {
    const t = document.createElement('div');
    t.className = `toast ${type === 'error' ? 'error' : type === 'warning' ? 'warning' : 'ok'}`;
    t.textContent = msg;
    document.getElementById('toastContainer').appendChild(t);
    setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(16px)'; t.style.transition = '0.25s ease'; setTimeout(() => t.remove(), 250); }, 3000);
}

// ─── THEME ───
function applyTheme(theme) {
    document.body.classList.toggle('light', theme === 'light');
    const icon = document.getElementById('themeIcon');
    if (icon) icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    const sel = document.getElementById('themeSelect');
    if (sel) sel.value = theme;
}
function toggleTheme() {
    settings.theme = settings.theme === 'dark' ? 'light' : 'dark';
    localStorage.setItem('apexSettings', JSON.stringify(settings));
    applyTheme(settings.theme);
}
applyTheme(settings.theme);

// set user avatar initial
const uname = '{{ auth()->user()->name }}';
const avatarEl = document.getElementById('userAvatar');
if (avatarEl && uname) avatarEl.textContent = uname.charAt(0).toUpperCase();

// ─── MODALS ───
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-backdrop').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) m.classList.remove('open'); });
});

// ─── NAVIGATION ───
const PAGES = ['dashboardPage','scanPage','stockPage','analyticsPage','categoriesPage','suppliersPage','settingsPage'];
const PAGE_TITLES = {
    dashboardPage: 'Dashboard', scanPage: 'Scan', stockPage: 'Products',
    analyticsPage: 'Analytics', categoriesPage: 'Categories',
    suppliersPage: 'Suppliers', settingsPage: 'Settings'
};

function showPage(page) {
    PAGES.forEach(p => {
        const el = document.getElementById(p);
        if (el) { el.classList.remove('active'); el.style.display = ''; }
    });
    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
    const target = document.getElementById(page);
    if (target) target.classList.add('active');
    const navItem = document.querySelector(`[data-page="${page}"]`);
    if (navItem) navItem.classList.add('active');
    const titleEl = document.getElementById('topbarTitle');
    if (titleEl) titleEl.textContent = PAGE_TITLES[page] || '';

    if (page === 'dashboardPage') loadDashboard();
    if (page === 'stockPage') loadStock();
    if (page === 'analyticsPage') renderAnalytics();
    if (page === 'scanPage') resetScan();
    else stopCamera();
    if (page === 'categoriesPage') loadCategories();
    if (page === 'suppliersPage') loadSuppliers();
    if (page === 'settingsPage') {
        document.getElementById('stockThreshold').value = settings.stockThreshold;
        document.getElementById('themeSelect').value = settings.theme;
    }
}

document.querySelectorAll('.nav-item[data-page]').forEach(item => {
    item.addEventListener('click', () => showPage(item.dataset.page));
});

// ─── BADGE ───
function stockBadge(qty) {
    if (qty === 0) return `<span class="badge badge-out">Out of stock</span>`;
    if (qty < settings.stockThreshold) return `<span class="badge badge-low">${qty} low</span>`;
    return `<span class="badge badge-ok">${qty}</span>`;
}

function thumbHtml(img) {
    if (img) return `<img src="${img}" class="product-thumb" loading="lazy">`;
    return `<div class="thumb-placeholder"><i class="fas fa-image"></i></div>`;
}

// ─── PRODUCTS ───
async function loadProducts() {
    try { allProducts = await apiFetch('/api/products'); }
    catch { showToast('Failed to load products', 'error'); }
}

async function loadDashboard() {
    await loadProducts();
    const th = settings.stockThreshold;
    const total = allProducts.length;
    const low = allProducts.filter(p => p.quantity > 0 && p.quantity < th).length;
    const out = allProducts.filter(p => p.quantity === 0).length;
    const value = allProducts.reduce((s, p) => s + (p.price * p.quantity), 0);
    document.getElementById('totalProductsStat').textContent = total;
    document.getElementById('lowStockStat').textContent = low;
    document.getElementById('outOfStockStat').textContent = out;
    document.getElementById('totalValueStat').textContent = '₱' + value.toFixed(0);

    const recent = [...allProducts].sort((a, b) => new Date(b.created_at) - new Date(a.created_at)).slice(0, 8);
    document.getElementById('recentList').innerHTML = recent.length
        ? recent.map(p => `<tr>
            <td>${thumbHtml(p.image)}</td>
            <td class="col-name">${esc(p.name)}</td>
            <td class="col-sku">${esc(p.sku)}</td>
            <td style="color:var(--text-2);">${esc(p.category || '—')}</td>
            <td style="font-weight:500;">₱${parseFloat(p.price).toFixed(2)}</td>
            <td>${stockBadge(p.quantity)}</td>
            <td><div class="row-actions">
                <button class="row-btn" title="Edit" onclick="openEditProductModal(${p.id})"><i class="fas fa-pen"></i></button>
                <button class="row-btn danger" title="Delete" onclick="deleteProduct(${p.id}, '${esc(p.name)}')"><i class="fas fa-trash"></i></button>
            </div></td>
        </tr>`).join('')
        : `<tr><td colspan="7"><div class="empty-state"><i class="fas fa-boxes-stacked"></i><p>No products yet. <a href="#" onclick="openAddProductModal();return false;" style="color:var(--accent);">Add your first →</a></p></div></td></tr>`;
}

async function loadStock() {
    await loadProducts();
    renderStock();
}

let stockPage = 1;
const STOCK_PER_PAGE = 20;

function renderStock() {
    const search = document.getElementById('searchStock')?.value.toLowerCase() || '';
    const catFilter = document.getElementById('filterCategory')?.value || '';
    let filtered = allProducts.filter(p => {
        const ms = p.name.toLowerCase().includes(search) || p.sku.toLowerCase().includes(search);
        const mc = catFilter ? String(p.category_id) === catFilter : true;
        return ms && mc;
    });
    const total = filtered.length;
    const pages = Math.ceil(total / STOCK_PER_PAGE) || 1;
    if (stockPage > pages) stockPage = 1;
    const paged = filtered.slice((stockPage - 1) * STOCK_PER_PAGE, stockPage * STOCK_PER_PAGE);

    document.getElementById('stockList').innerHTML = paged.length
        ? paged.map(p => `<tr>
            <td>${thumbHtml(p.image)}</td>
            <td class="col-name">${esc(p.name)}</td>
            <td class="col-sku">${esc(p.sku)}</td>
            <td style="color:var(--text-2);">${esc(p.category || '—')}</td>
            <td style="color:var(--text-2);">${esc(p.supplier || '—')}</td>
            <td style="font-weight:500;">₱${parseFloat(p.price).toFixed(2)}</td>
            <td>
                ${stockBadge(p.quantity)}
                <button class="row-btn" style="display:inline-flex;vertical-align:middle;margin-left:2px;" title="Quick update" onclick="openStockModal(${p.id},'${esc(p.name)}',${p.quantity})"><i class="fas fa-pencil" style="font-size:10px;"></i></button>
            </td>
            <td><div class="row-actions">
                <button class="row-btn" title="Edit" onclick="openEditProductModal(${p.id})"><i class="fas fa-pen"></i></button>
                <button class="row-btn danger" title="Delete" onclick="deleteProduct(${p.id},'${esc(p.name)}')"><i class="fas fa-trash"></i></button>
            </div></td>
        </tr>`).join('')
        : `<tr><td colspan="8"><div class="empty-state"><i class="fas fa-magnifying-glass"></i><p>No products found.</p></div></td></tr>`;

    const pag = document.getElementById('stockPagination');
    if (pages <= 1) { pag.style.display = 'none'; return; }
    pag.style.display = 'flex';
    pag.innerHTML = Array.from({ length: pages }, (_, i) => i + 1).map(n =>
        `<button class="page-btn ${n === stockPage ? 'active' : ''}" onclick="stockPage=${n};renderStock();">${n}</button>`
    ).join('');
}

document.getElementById('searchStock')?.addEventListener('input', () => { stockPage = 1; renderStock(); });
document.getElementById('filterCategory')?.addEventListener('change', () => { stockPage = 1; renderStock(); });

// ─── PRODUCT MODAL ───
function clearProductModal() {
    ['pm_name','pm_sku','pm_price','pm_quantity','pm_description'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('pm_category').value = '';
    document.getElementById('pm_supplier').value = '';
    currentProductImageData = null;
    document.getElementById('pm_imagePreview').innerHTML = '';
    ['err_name','err_sku','err_price','err_quantity','err_category','err_supplier'].forEach(id => document.getElementById(id).textContent = '');
    editingProductId = null;
}

function openAddProductModal(prefillSku = '') {
    clearProductModal();
    document.getElementById('productModalTitle').textContent = 'Add Product';
    document.getElementById('pm_sku').value = prefillSku;
    document.getElementById('pm_sku').readOnly = false;
    openModal('productModal');
}

function openEditProductModal(id) {
    const p = allProducts.find(p => p.id === id);
    if (!p) return;
    clearProductModal();
    editingProductId = id;
    document.getElementById('productModalTitle').textContent = 'Edit Product';
    document.getElementById('pm_name').value = p.name;
    document.getElementById('pm_sku').value = p.sku;
    document.getElementById('pm_sku').readOnly = true;
    document.getElementById('pm_price').value = p.price;
    document.getElementById('pm_quantity').value = p.quantity;
    document.getElementById('pm_category').value = p.category_id;
    document.getElementById('pm_supplier').value = p.supplier_id;
    document.getElementById('pm_description').value = p.description || '';
    if (p.image) {
        currentProductImageData = p.image;
        document.getElementById('pm_imagePreview').innerHTML = `<img src="${p.image}" style="max-width:80px;border-radius:8px;margin-top:8px;border:1px solid var(--border);"><br><button onclick="removePmImage()" class="btn btn-ghost" style="margin-top:6px;font-size:11px;padding:4px 10px;">Remove</button>`;
    }
    openModal('productModal');
}

function removePmImage() {
    currentProductImageData = null;
    document.getElementById('pm_imagePreview').innerHTML = '';
    document.getElementById('pm_imageFile').value = '';
}

document.getElementById('pm_dropZone').addEventListener('click', () => document.getElementById('pm_imageFile').click());
document.getElementById('pm_imageFile').addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) return;
    if (!file.type.match('image/(jpeg|png)')) { showToast('Only JPG/PNG allowed', 'error'); return; }
    const reader = new FileReader();
    reader.onload = ev => {
        currentProductImageData = ev.target.result;
        document.getElementById('pm_imagePreview').innerHTML = `<img src="${currentProductImageData}" style="max-width:80px;border-radius:8px;margin-top:8px;border:1px solid var(--border);"><br><button onclick="removePmImage()" class="btn btn-ghost" style="margin-top:6px;font-size:11px;padding:4px 10px;">Remove</button>`;
    };
    reader.readAsDataURL(file);
});

async function saveProduct() {
    const name = document.getElementById('pm_name').value.trim();
    const sku = document.getElementById('pm_sku').value.trim();
    const price = document.getElementById('pm_price').value;
    const quantity = document.getElementById('pm_quantity').value;
    const category_id = document.getElementById('pm_category').value;
    const supplier_id = document.getElementById('pm_supplier').value;
    const description = document.getElementById('pm_description').value.trim();

    let valid = true;
    const setErr = (id, msg) => { document.getElementById(id).textContent = msg; if (msg) valid = false; };
    setErr('err_name', name ? '' : 'Required');
    setErr('err_sku', sku ? '' : 'Required');
    setErr('err_price', price !== '' && parseFloat(price) >= 0 ? '' : 'Valid price required');
    setErr('err_quantity', quantity !== '' && parseInt(quantity) >= 0 ? '' : 'Valid quantity required');
    setErr('err_category', category_id ? '' : 'Required');
    setErr('err_supplier', supplier_id ? '' : 'Required');
    if (!valid) return;

    const payload = { name, sku, price: parseFloat(price), quantity: parseInt(quantity), category_id: parseInt(category_id), supplier_id: parseInt(supplier_id), description, image: currentProductImageData || null };
    const btn = document.getElementById('pm_saveBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="btn-spinner"></span> Saving...';
    try {
        if (editingProductId) {
            await apiFetch(`/api/products/${editingProductId}`, { method: 'PUT', body: JSON.stringify(payload) });
            showToast('Product updated');
        } else {
            await apiFetch('/api/products', { method: 'POST', body: JSON.stringify(payload) });
            showToast('Product added');
        }
        closeModal('productModal');
        await loadDashboard();
        if (document.getElementById('stockPage').classList.contains('active')) loadStock();
    } catch (err) {
        if (err.data?.errors) {
            const map = { name: 'err_name', sku: 'err_sku', price: 'err_price', quantity: 'err_quantity', category_id: 'err_category', supplier_id: 'err_supplier' };
            Object.entries(err.data.errors).forEach(([k, v]) => { if (map[k]) document.getElementById(map[k]).textContent = v[0]; });
        } else showToast(err.data?.message || 'Failed to save product', 'error');
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-floppy-disk"></i> Save Product';
    }
}

async function deleteProduct(id, name) {
    if (!confirm(`Delete "${name}"? This cannot be undone.`)) return;
    showLoading();
    try {
        await apiFetch(`/api/products/${id}`, { method: 'DELETE' });
        showToast('Product deleted');
        await loadDashboard();
        if (document.getElementById('stockPage').classList.contains('active')) loadStock();
    } catch (e) {
        showToast(e.data?.message || 'Failed to delete', 'error');
    } finally { hideLoading(); }
}

// ─── STOCK MODAL ───
function openStockModal(id, name, qty) {
    stockUpdateProductId = id;
    document.getElementById('stockModalProductName').textContent = `Product: ${name}`;
    document.getElementById('stockModal_qty').value = qty;
    openModal('stockModal');
}
async function confirmUpdateStock() {
    const qty = parseInt(document.getElementById('stockModal_qty').value);
    if (isNaN(qty) || qty < 0) { showToast('Enter a valid quantity', 'error'); return; }
    showLoading();
    try {
        await apiFetch(`/api/products/${stockUpdateProductId}/stock`, { method: 'PATCH', body: JSON.stringify({ quantity: qty }) });
        showToast('Stock updated');
        closeModal('stockModal');
        await loadDashboard();
        if (document.getElementById('stockPage').classList.contains('active')) loadStock();
    } catch (e) {
        showToast(e.data?.message || 'Failed to update stock', 'error');
    } finally { hideLoading(); }
}

// ─── CATEGORIES ───
async function loadCategories() {
    try {
        allCategories = await apiFetch('/api/categories');
        document.getElementById('categoriesList').innerHTML = allCategories.length
            ? allCategories.map(c => `<tr>
                <td class="col-name">${esc(c.name)}</td>
                <td style="color:var(--text-2);">${esc(c.description || '—')}</td>
                <td><span class="badge badge-ok">${c.products_count ?? 0}</span></td>
                <td><div class="row-actions">
                    <button class="row-btn" onclick="openEditCategoryModal(${c.id})"><i class="fas fa-pen"></i></button>
                    <button class="row-btn danger" onclick="deleteCategory(${c.id},'${esc(c.name)}')"><i class="fas fa-trash"></i></button>
                </div></td>
            </tr>`).join('')
            : `<tr><td colspan="4"><div class="empty-state"><i class="fas fa-tag"></i><p>No categories yet.</p></div></td></tr>`;
    } catch { showToast('Failed to load categories', 'error'); }
}

function openAddCategoryModal() {
    editingCategoryId = null;
    document.getElementById('categoryModalTitle').textContent = 'Add Category';
    document.getElementById('cm_name').value = '';
    document.getElementById('cm_description').value = '';
    document.getElementById('err_cm_name').textContent = '';
    openModal('categoryModal');
}

function openEditCategoryModal(id) {
    const c = allCategories.find(c => c.id === id);
    if (!c) return;
    editingCategoryId = id;
    document.getElementById('categoryModalTitle').textContent = 'Edit Category';
    document.getElementById('cm_name').value = c.name;
    document.getElementById('cm_description').value = c.description || '';
    document.getElementById('err_cm_name').textContent = '';
    openModal('categoryModal');
}

async function saveCategory() {
    const name = document.getElementById('cm_name').value.trim();
    const description = document.getElementById('cm_description').value.trim();
    if (!name) { document.getElementById('err_cm_name').textContent = 'Name is required.'; return; }
    document.getElementById('err_cm_name').textContent = '';
    showLoading();
    try {
        if (editingCategoryId) {
            await apiFetch(`/api/categories/${editingCategoryId}`, { method: 'PUT', body: JSON.stringify({ name, description }) });
            showToast('Category updated');
        } else {
            await apiFetch('/api/categories', { method: 'POST', body: JSON.stringify({ name, description }) });
            showToast('Category added');
        }
        closeModal('categoryModal');
        loadCategories();
    } catch (e) {
        if (e.data?.errors?.name) document.getElementById('err_cm_name').textContent = e.data.errors.name[0];
        else showToast(e.data?.message || 'Failed to save', 'error');
    } finally { hideLoading(); }
}

async function deleteCategory(id, name) {
    if (!confirm(`Delete category "${name}"?`)) return;
    showLoading();
    try {
        await apiFetch(`/api/categories/${id}`, { method: 'DELETE' });
        showToast('Category deleted');
        loadCategories();
    } catch (e) { showToast(e.data?.message || 'Cannot delete', 'error'); }
    finally { hideLoading(); }
}

// ─── SUPPLIERS ───
async function loadSuppliers() {
    try {
        allSuppliers = await apiFetch('/api/suppliers');
        document.getElementById('suppliersList').innerHTML = allSuppliers.length
            ? allSuppliers.map(s => `<tr>
                <td class="col-name">${esc(s.name)}</td>
                <td style="color:var(--text-2);">${esc(s.email)}</td>
                <td style="color:var(--text-2);">${esc(s.phone)}</td>
                <td style="color:var(--text-2);font-size:12.5px;">${esc(s.address)}</td>
                <td><span class="badge badge-ok">${s.products_count ?? 0}</span></td>
                <td><div class="row-actions">
                    <button class="row-btn" onclick="openEditSupplierModal(${s.id})"><i class="fas fa-pen"></i></button>
                    <button class="row-btn danger" onclick="deleteSupplier(${s.id},'${esc(s.name)}')"><i class="fas fa-trash"></i></button>
                </div></td>
            </tr>`).join('')
            : `<tr><td colspan="6"><div class="empty-state"><i class="fas fa-truck"></i><p>No suppliers yet.</p></div></td></tr>`;
    } catch { showToast('Failed to load suppliers', 'error'); }
}

function openAddSupplierModal() {
    editingSupplierId = null;
    document.getElementById('supplierModalTitle').textContent = 'Add Supplier';
    ['sm_name','sm_email','sm_phone','sm_address'].forEach(id => document.getElementById(id).value = '');
    ['err_sm_name','err_sm_email','err_sm_phone','err_sm_address'].forEach(id => document.getElementById(id).textContent = '');
    openModal('supplierModal');
}

function openEditSupplierModal(id) {
    const s = allSuppliers.find(s => s.id === id);
    if (!s) return;
    editingSupplierId = id;
    document.getElementById('supplierModalTitle').textContent = 'Edit Supplier';
    document.getElementById('sm_name').value = s.name;
    document.getElementById('sm_email').value = s.email;
    document.getElementById('sm_phone').value = s.phone;
    document.getElementById('sm_address').value = s.address;
    ['err_sm_name','err_sm_email','err_sm_phone','err_sm_address'].forEach(id => document.getElementById(id).textContent = '');
    openModal('supplierModal');
}

async function saveSupplier() {
    const name = document.getElementById('sm_name').value.trim();
    const email = document.getElementById('sm_email').value.trim();
    const phone = document.getElementById('sm_phone').value.trim();
    const address = document.getElementById('sm_address').value.trim();
    let valid = true;
    const setErr = (id, msg) => { document.getElementById(id).textContent = msg; if (msg) valid = false; };
    setErr('err_sm_name', name ? '' : 'Required');
    setErr('err_sm_email', email ? '' : 'Required');
    setErr('err_sm_phone', phone ? '' : 'Required');
    setErr('err_sm_address', address ? '' : 'Required');
    if (!valid) return;
    showLoading();
    try {
        if (editingSupplierId) {
            await apiFetch(`/api/suppliers/${editingSupplierId}`, { method: 'PUT', body: JSON.stringify({ name, email, phone, address }) });
            showToast('Supplier updated');
        } else {
            await apiFetch('/api/suppliers', { method: 'POST', body: JSON.stringify({ name, email, phone, address }) });
            showToast('Supplier added');
        }
        closeModal('supplierModal');
        loadSuppliers();
    } catch (e) {
        if (e.data?.errors) {
            const map = { name: 'err_sm_name', email: 'err_sm_email', phone: 'err_sm_phone', address: 'err_sm_address' };
            Object.entries(e.data.errors).forEach(([k, v]) => { if (map[k]) document.getElementById(map[k]).textContent = v[0]; });
        } else showToast(e.data?.message || 'Failed to save', 'error');
    } finally { hideLoading(); }
}

async function deleteSupplier(id, name) {
    if (!confirm(`Delete supplier "${name}"?`)) return;
    showLoading();
    try {
        await apiFetch(`/api/suppliers/${id}`, { method: 'DELETE' });
        showToast('Supplier deleted');
        loadSuppliers();
    } catch (e) { showToast(e.data?.message || 'Cannot delete', 'error'); }
    finally { hideLoading(); }
}

// ─── ANALYTICS ───
function renderAnalytics() {
    const th = settings.stockThreshold;
    const total = allProducts.length;
    const totalVal = allProducts.reduce((s, p) => s + (p.price * p.quantity), 0);
    const low = allProducts.filter(p => p.quantity > 0 && p.quantity < th);
    const avgPrice = total ? allProducts.reduce((s, p) => s + parseFloat(p.price), 0) / total : 0;
    document.getElementById('anTotalProducts').textContent = total;
    document.getElementById('anTotalValue').textContent = '₱' + totalVal.toFixed(0);
    document.getElementById('anLowStock').textContent = low.length;
    document.getElementById('anAvgPrice').textContent = '₱' + avgPrice.toFixed(2);

    const cats = {};
    allProducts.forEach(p => { cats[p.category || 'Uncategorized'] = (cats[p.category || 'Uncategorized'] || 0) + p.quantity; });
    const maxCat = Math.max(1, ...Object.values(cats));
    const barColors = ['#4f7cff','#22c55e','#f59e0b','#ef4444','#a78bfa','#06b6d4'];
    document.getElementById('categoryBars').innerHTML = Object.keys(cats).length
        ? Object.entries(cats).sort((a, b) => b[1] - a[1]).map(([cat, qty], i) => `
            <div class="bar-item">
                <div class="bar-label" title="${esc(cat)}">${esc(cat)}</div>
                <div class="bar-track"><div class="bar-fill" style="width:${(qty/maxCat*100).toFixed(1)}%;background:${barColors[i%barColors.length]};"></div></div>
                <div class="bar-count">${qty}</div>
            </div>`).join('')
        : `<div class="empty-state" style="padding:24px 0;"><p>No products yet</p></div>`;

    const top5 = [...allProducts].sort((a, b) => (b.price * b.quantity) - (a.price * a.quantity)).slice(0, 5);
    document.getElementById('topValueList').innerHTML = top5.length
        ? top5.map((p, i) => `<div class="top-item">
            <div class="top-rank">${i+1}</div>
            <div class="top-name">${esc(p.name)}</div>
            <div class="top-value">₱${(p.price*p.quantity).toFixed(0)}</div>
        </div>`).join('')
        : `<div class="empty-state" style="padding:24px 0;"><p>No products yet</p></div>`;

    const healthy = allProducts.filter(p => p.quantity >= th).length;
    const lowCount = low.length;
    const outCount = allProducts.filter(p => p.quantity === 0).length;
    const total3 = healthy + lowCount + outCount || 1;
    const r = 52, cx = 68, cy = 68, circ = 2 * Math.PI * r;
    const hArc = circ * healthy / total3, lArc = circ * lowCount / total3, oArc = circ * outCount / total3;
    document.getElementById('stockHealthChart').innerHTML = `<div style="display:flex;justify-content:center;">
        <svg width="136" height="136" viewBox="0 0 136 136">
            <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="var(--surface-3)" stroke-width="16"/>
            <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="#22c55e" stroke-width="16" stroke-dasharray="${hArc} ${circ}" stroke-dashoffset="${circ*0.25}" stroke-linecap="round"/>
            <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="#f59e0b" stroke-width="16" stroke-dasharray="${lArc} ${circ}" stroke-dashoffset="${circ*0.25-hArc}" stroke-linecap="round"/>
            <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="#ef4444" stroke-width="16" stroke-dasharray="${oArc} ${circ}" stroke-dashoffset="${circ*0.25-hArc-lArc}" stroke-linecap="round"/>
            <text x="${cx}" y="${cy-6}" text-anchor="middle" font-size="20" font-weight="700" fill="var(--text)" font-family="Syne,sans-serif">${total}</text>
            <text x="${cx}" y="${cy+12}" text-anchor="middle" font-size="10" fill="var(--text-2)">products</text>
        </svg></div>`;
    document.getElementById('stockHealthLegend').innerHTML =
        `<span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;border-radius:50%;background:#22c55e;display:inline-block;"></span>Healthy (${healthy})</span>
         <span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;border-radius:50%;background:#f59e0b;display:inline-block;"></span>Low (${lowCount})</span>
         <span style="display:flex;align-items:center;gap:5px;"><span style="width:8px;height:8px;border-radius:50%;background:#ef4444;display:inline-block;"></span>Out (${outCount})</span>`;

    document.getElementById('lowStockAlerts').innerHTML = low.length
        ? [...low].sort((a, b) => a.quantity - b.quantity).map(p => `
            <div class="alert-item">
                <span class="alert-name">${esc(p.name)}</span>
                <span class="alert-count">${p.quantity} left</span>
            </div>`).join('')
        : `<div style="text-align:center;padding:24px 0;color:var(--green);font-size:13px;"><i class="fas fa-circle-check" style="margin-right:6px;"></i>All products well-stocked!</div>`;
}

// ─── IMAGE DROP ZONE (ZXing still-image barcode scanner) ───

function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
    const dz = document.getElementById('barcodeDropZone');
    dz.style.borderColor = 'var(--accent)';
    dz.style.background  = 'var(--accent-light)';
}

function handleDragLeave(e) {
    e.preventDefault();
    e.stopPropagation();
    const dz = document.getElementById('barcodeDropZone');
    dz.style.borderColor = '';
    dz.style.background  = 'var(--surface-2)';
}

function handleImageDrop(e) {
    e.preventDefault();
    e.stopPropagation();
    handleDragLeave(e);
    const file = e.dataTransfer.files && e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        handleImageFile(file);
    } else {
        setScanStatus('error', 'Please drop an image file (PNG, JPG, WebP, GIF).');
    }
}

function handleImageFile(file) {
    if (!file) return;

    // Show processing state
    document.getElementById('dropZoneIdle').style.display       = 'none';
    document.getElementById('dropZoneProcessing').style.display = 'block';
    document.getElementById('dropZoneResult').style.display     = 'none';
    const dz = document.getElementById('barcodeDropZone');
    dz.style.borderColor = 'var(--accent)';

    const reader = new FileReader();
    reader.onload = function(ev) {
        const img = new Image();
        img.onload = function() {
            // Draw to canvas so ZXing can decode it
            const canvas  = document.createElement('canvas');
            canvas.width  = img.naturalWidth;
            canvas.height = img.naturalHeight;
            canvas.getContext('2d').drawImage(img, 0, 0);

            let decoded = false;
            try {
                if (!window.ZXing) throw new Error('ZXing not loaded');

                const hints = new Map();
                hints.set(ZXing.DecodeHintType.POSSIBLE_FORMATS, [
                    ZXing.BarcodeFormat.EAN_13,
                    ZXing.BarcodeFormat.EAN_8,
                    ZXing.BarcodeFormat.UPC_A,
                    ZXing.BarcodeFormat.UPC_E,
                    ZXing.BarcodeFormat.CODE_128,
                    ZXing.BarcodeFormat.CODE_39,
                    ZXing.BarcodeFormat.QR_CODE,
                    ZXing.BarcodeFormat.DATA_MATRIX,
                ]);
                hints.set(ZXing.DecodeHintType.TRY_HARDER, true);

                const imgReader = new ZXing.MultiFormatReader();
                imgReader.setHints(hints);

                const luminance = new ZXing.HTMLCanvasElementLuminanceSource(canvas);
                const bitmap    = new ZXing.BinaryBitmap(new ZXing.HybridBinarizer(luminance));
                const result    = imgReader.decode(bitmap);

                if (result && result.getText().trim()) {
                    decoded = true;
                    const code = result.getText().trim();
                    const fmt  = ZXing.BarcodeFormat[result.getBarcodeFormat()] || 'Unknown';

                    // Show result state in drop zone
                    document.getElementById('dropZoneProcessing').style.display = 'none';
                    document.getElementById('dropZoneThumb').src                = ev.target.result;
                    document.getElementById('dropZoneResultText').textContent   = `Detected (${fmt}): ${code}`;
                    document.getElementById('dropZoneResult').style.display     = 'flex';

                    setScanStatus('success', `Image scan detected (${fmt}): ${code}`);
                    lookupSku(code);
                }
            } catch(err) {
                // ZXing throws NotFoundException when no barcode found
            }

            if (!decoded) {
                resetDropZone();
                setScanStatus('error', 'No barcode found in that image. Try a clearer or closer photo.');
            }
        };
        img.src = ev.target.result;
    };
    reader.readAsDataURL(file);

    // Reset file input so the same file can be re-selected
    document.getElementById('barcodeImageInput').value = '';
}

function resetDropZone() {
    document.getElementById('dropZoneIdle').style.display       = 'block';
    document.getElementById('dropZoneProcessing').style.display = 'none';
    document.getElementById('dropZoneResult').style.display     = 'none';
    const dz = document.getElementById('barcodeDropZone');
    dz.style.borderColor = '';
    dz.style.background  = 'var(--surface-2)';
}

// ─── SCAN (ZXing barcode scanner) ───
let cameraStream = null, zxingReader = null, scanCooldown = false;

const scanStatus = document.getElementById('scannerStatus');

function setScanStatus(type, msg) {
    scanStatus.style.display = 'flex';
    scanStatus.className = `status-msg status-${type}`;
    const icon = type === 'success' ? 'fa-circle-check' : type === 'error' ? 'fa-circle-xmark' : type === 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-info';
    scanStatus.innerHTML = `<i class="fas ${icon}"></i><span>${msg}</span>`;
}

async function startCamera() {
    try {
        if (!window.ZXing) { setScanStatus('error', 'Barcode library not loaded. Please refresh.'); return; }

        // Use ZXing MultiFormatReader — supports EAN-13, UPC-A, Code128, Code39, QR, etc.
        const hints = new Map();
        const formats = [
            ZXing.BarcodeFormat.EAN_13,
            ZXing.BarcodeFormat.EAN_8,
            ZXing.BarcodeFormat.UPC_A,
            ZXing.BarcodeFormat.UPC_E,
            ZXing.BarcodeFormat.CODE_128,
            ZXing.BarcodeFormat.CODE_39,
            ZXing.BarcodeFormat.QR_CODE,
            ZXing.BarcodeFormat.DATA_MATRIX,
        ];
        hints.set(ZXing.DecodeHintType.POSSIBLE_FORMATS, formats);
        hints.set(ZXing.DecodeHintType.TRY_HARDER, true);
        zxingReader = new ZXing.MultiFormatReader();
        zxingReader.setHints(hints);

        cameraStream = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } }
        });
        const video = document.getElementById('cameraFeed');
        video.srcObject = cameraStream;
        await video.play();
        document.getElementById('startCameraBtn').style.display = 'none';
        document.getElementById('stopCameraBtn').style.display  = '';
        document.getElementById('cameraHint').textContent = 'Scanning for barcode…';
        setScanStatus('info', 'Camera active — hold barcode steady inside the box.');
        scanFrameLoop();
    } catch (err) {
        setScanStatus('error', 'Camera access denied. Please allow camera permission and try again.');
    }
}

function stopCamera() {
    if (cameraStream) { cameraStream.getTracks().forEach(t => t.stop()); cameraStream = null; }
    zxingReader = null;
    const video = document.getElementById('cameraFeed');
    video.srcObject = null;
    document.getElementById('startCameraBtn').style.display = '';
    document.getElementById('stopCameraBtn').style.display  = 'none';
    document.getElementById('cameraHint').textContent = 'Point camera at barcode';
}

function scanFrameLoop() {
    if (!cameraStream || !zxingReader) return;
    const video = document.getElementById('cameraFeed');
    if (video.readyState < 2) { requestAnimationFrame(scanFrameLoop); return; }

    if (!scanCooldown) {
        try {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const luminance = new ZXing.HTMLCanvasElementLuminanceSource(canvas);
            const bitmap = new ZXing.BinaryBitmap(new ZXing.HybridBinarizer(luminance));
            const result = zxingReader.decode(bitmap);
            if (result && result.getText().trim()) {
                scanCooldown = true;
                const code = result.getText().trim();
                const fmt  = result.getBarcodeFormat();
                document.getElementById('cameraHint').textContent = `✓ Found: ${code}`;
                setScanStatus('success', `Barcode detected (${ZXing.BarcodeFormat[fmt]}): ${code}`);
                lookupSku(code).finally(() => {
                    setTimeout(() => {
                        scanCooldown = false;
                        if (cameraStream) document.getElementById('cameraHint').textContent = 'Scanning for barcode…';
                    }, 3000);
                });
            }
        } catch(e) {
            // NotFoundException is normal (no barcode in frame) — ignore silently
        }
    }
    requestAnimationFrame(scanFrameLoop);
}

async function manualSubmit() {
    const val = document.getElementById('manualBarcode').value.trim();
    if (!val) { showToast('Enter a barcode or SKU', 'error'); return; }
    setScanStatus('info', `Looking up: ${val}`);
    await lookupSku(val);
}

// externalProduct holds data from Open Food Facts when barcode is not in local inventory
let externalProduct = null;

async function lookupSku(sku) {
    const cleanSku = sku.replace(/[\s\-]/g, '');

    // Step 1: check local inventory
    try {
        foundProduct = await apiFetch(`/api/products/sku/${encodeURIComponent(cleanSku)}`);
        showProductDetail(foundProduct, 'local');
        return;
    } catch (e) {
        if (e.status !== 404) {
            setScanStatus('error', 'Error looking up product in inventory.');
            return;
        }
    }

    // Step 2: proxy through Laravel to Open Food Facts (avoids CORS)
    setScanStatus('info', `Not in inventory. Searching external database for ${esc(cleanSku)}…`);
    try {
        const res = await fetch(
            `/api/barcode-lookup?upc=${encodeURIComponent(cleanSku)}`,
            { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } }
        );
        if (!res.ok) throw new Error('proxy_error');
        const data = await res.json();
        if (data.code === 'OK' && data.items && data.items.length > 0) {
            const item = data.items[0];
            externalProduct = {
                barcode:     cleanSku,
                name:        item.title        || '',
                brand:       item.brand        || '',
                description: item.description  || '',
                category:    item.category     || '',
                image:       (item.images && item.images[0]) ? item.images[0] : null,
                price:       (item.offers && item.offers[0] && item.offers[0].price) ? item.offers[0].price : null,
            };
            setScanStatus('success', `Found on Open Food Facts: ${esc(externalProduct.name)}`);
            showProductDetail(externalProduct, 'external');
        } else {
            setScanStatus('warning', `Barcode "${esc(cleanSku)}" not found anywhere. Fill in the details below.`);
            openAddProductModal(cleanSku);
        }
    } catch (err) {
        setScanStatus('warning', `Barcode "${esc(cleanSku)}" not in inventory. Add it manually.`);
        openAddProductModal(cleanSku);
    }
}

function showProductDetail(p, source) {
    const imgSrc = p.image || p.image_url || null;
    document.getElementById('detailImageContainer').innerHTML = imgSrc
        ? `<img src="${imgSrc}" style="width:90px;height:90px;object-fit:contain;border-radius:10px;border:1px solid var(--border);background:var(--surface-2);">`
        : `<div style="width:90px;height:90px;background:var(--surface-2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--text-3);font-size:22px;"><i class="fas fa-image"></i></div>`;

    document.getElementById('detailBarcode').textContent = p.sku || p.barcode || '—';
    document.getElementById('detailName').textContent    = p.name || '—';
    document.getElementById('detailDesc').textContent    = p.description || 'No description available.';

    if (source === 'local') {
        document.getElementById('detailSourceBadge').textContent  = '✓ In your inventory';
        document.getElementById('detailSourceBadge').style.cssText = 'background:var(--green-bg);color:var(--green);font-size:11px;padding:3px 10px;border-radius:99px;font-weight:600;';
        document.getElementById('detailBrandRow').style.display    = 'none';
        document.getElementById('detailCategoryRow').style.display = '';
        document.getElementById('detailSupplierRow').style.display = '';
        document.getElementById('detailCategory').textContent = p.category || '—';
        document.getElementById('detailSupplier').textContent = p.supplier || '—';
        document.getElementById('detailPrice').textContent    = p.price != null ? '₱' + parseFloat(p.price).toFixed(2) : '—';
        document.getElementById('detailStockRow').style.display = '';
        document.getElementById('detailStock').innerHTML      = stockBadge(p.quantity);
        document.getElementById('detailEditBtn').style.display = '';
        document.getElementById('detailAddBtn').style.display  = 'none';
        document.getElementById('detailCardTitle').innerHTML   = '<i class="fas fa-box"></i> Product Found';
    } else {
        document.getElementById('detailSourceBadge').textContent  = '⟳ From Open Food Facts';
        document.getElementById('detailSourceBadge').style.cssText = 'background:var(--accent-light);color:var(--accent);font-size:11px;padding:3px 10px;border-radius:99px;font-weight:600;';
        document.getElementById('detailBrandRow').style.display    = p.brand    ? '' : 'none';
        document.getElementById('detailBrand').textContent         = p.brand    || '';
        document.getElementById('detailCategoryRow').style.display = p.category ? '' : 'none';
        document.getElementById('detailCategory').textContent      = p.category || '';
        document.getElementById('detailSupplierRow').style.display = 'none';
        document.getElementById('detailPrice').textContent         = p.price ? '₱' + parseFloat(p.price).toFixed(2) : 'Not listed';
        document.getElementById('detailStockRow').style.display    = 'none';
        document.getElementById('detailEditBtn').style.display     = 'none';
        document.getElementById('detailAddBtn').style.display      = '';
        document.getElementById('detailCardTitle').innerHTML       = '<i class="fas fa-globe"></i> Product Info (External)';
    }

    document.getElementById('productDetail').style.display = 'block';
}

function editFoundProduct() { if (foundProduct) openEditProductModal(foundProduct.id); }

function addFoundExternalProduct() {
    if (!externalProduct) return;
    openAddProductModal(externalProduct.barcode);
    setTimeout(() => {
        // Fill text fields
        if (externalProduct.name)        document.getElementById('pm_name').value        = externalProduct.name;
        if (externalProduct.price)       document.getElementById('pm_price').value       = parseFloat(externalProduct.price).toFixed(2);
        if (externalProduct.description) document.getElementById('pm_description').value = externalProduct.description;

        // Set image URL directly into currentProductImageData and show preview
        if (externalProduct.image) {
            currentProductImageData = externalProduct.image;
            document.getElementById('pm_imagePreview').innerHTML =
                `<img src="${externalProduct.image}" style="max-width:80px;border-radius:8px;margin-top:8px;border:1px solid var(--border);">` +
                `<br><button onclick="removePmImage()" class="btn btn-ghost" style="margin-top:6px;font-size:11px;padding:4px 10px;">Remove</button>`;
        }
    }, 100);
}

function resetScan() {
    stopCamera();
    resetDropZone();
    scanStatus.style.display = 'none';
    document.getElementById('productDetail').style.display = 'none';
    document.getElementById('manualBarcode').value = '';
    foundProduct    = null;
    externalProduct = null;
    document.getElementById('cameraHint').textContent = 'Point camera at barcode';
}

// ─── SETTINGS ───
function saveSettings() {
    settings.stockThreshold = parseInt(document.getElementById('stockThreshold').value) || 10;
    settings.theme = document.getElementById('themeSelect').value;
    localStorage.setItem('apexSettings', JSON.stringify(settings));
    applyTheme(settings.theme);
    showToast('Settings saved');
}

// ─── XSS ───
function esc(str) {
    if (str == null) return '';
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#x27;');
}

// ─── INIT ───
loadDashboard();
</script>
</body>
</html>
