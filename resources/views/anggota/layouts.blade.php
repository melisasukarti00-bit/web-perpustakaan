<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Perpustakaan</title>

    <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(160deg, #ddeeff 0%, #c8e8ff 50%, #d4eef9 100%);
        display: flex;
        min-height: 100vh;
    }

    /* ── SIDEBAR ── */
    .sidebar {
        width: 220px;
        background: #fff;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #e4eef7;
        flex-shrink: 0;
        height: 100vh;
        position: sticky;
        top: 0;
    }

    .sidebar-head {
        padding: 22px 20px 18px;
        border-bottom: 1px solid #e4eef7;
    }
    .sidebar-logo {
        font-size: 17px; font-weight: 700;
        display: flex; align-items: center; gap: 8px;
    }
    .sidebar-logo .me  { color: #1a1a1a; }
    .sidebar-logo .lib { color: #3b9ce2; }
    .logo-dot { width: 8px; height: 8px; background: #3b9ce2; border-radius: 50%; }

    .sidebar-profile {
        padding: 20px;
        display: flex; flex-direction: column; align-items: center;
        border-bottom: 1px solid #e4eef7;
    }
    .avatar {
        width: 56px; height: 56px; border-radius: 50%;
        background: #185FA5;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; font-weight: 700; color: #fff;
        margin-bottom: 10px;
    }
    .profile-name  { font-size: 14px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
    .profile-badge {
        background: #e6f2fb; color: #185FA5;
        font-size: 11px; font-weight: 700;
        padding: 3px 12px; border-radius: 20px;
    }

    .sidebar-menu { flex: 1; padding: 14px 12px; display: flex; flex-direction: column; gap: 4px; }
    .menu-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        font-size: 13px; color: #4a6080;
        text-decoration: none; font-weight: 500;
    }
    .menu-item svg { width: 18px; height: 18px; flex-shrink: 0; }
    .menu-item:hover  { background: #e6f2fb; color: #3b9ce2; }
    .menu-item.active { background: #3baaf4; color: #fff; }

    .menu-logout {
        margin: 8px 12px 16px;
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        font-size: 13px; font-weight: 500;
        color: #a32d2d; background: #fff0f0;
        cursor: pointer; border: none;
        width: calc(100% - 24px); text-align: left;
        font-family: Arial;
    }
    .menu-logout svg { width: 18px; height: 18px; }

    /* ── MAIN ── */
    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

    .navbar {
        background: #3baaf4;
        color: #fff; padding: 0 24px; height: 58px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 10;
    }
    .navbar-title   { font-size: 15px; font-weight: 700; }
    .navbar-right   { display: flex; align-items: center; gap: 12px; }
    .navbar-greeting { font-size: 13px; opacity: 0.9; }
    .navbar-avatar  {
        width: 34px; height: 34px; border-radius: 50%;
        background: #3b9ce2;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: #fff;
    }
    .notif-btn {
        width: 34px; height: 34px; border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
    }

    .container { padding: 24px; }

    @media (max-width: 768px) {
        body { flex-direction: column; }
        .sidebar { width: 100%; height: auto; flex-direction: row; overflow-x: auto; position: relative; }
        .sidebar-profile, .sidebar-head { display: none; }
        .sidebar-menu { flex-direction: row; padding: 8px; }
        .menu-logout { margin: 8px; width: auto; }
    }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-head">
        <div class="sidebar-logo">
            <div class="logo-dot"></div>
            <span><span class="me">me</span><span class="lib">library</span></span>
        </div>
    </div>

    <div class="sidebar-profile">
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
        <div class="profile-name">{{ Auth::user()->name ?? 'Anggota' }}</div>
        <div class="profile-badge">Anggota</div>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('anggota.dashboard') }}"
           class="menu-item {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Dashboard
        </a>
        <a href="{{ route('anggota.katalog') }}"
           class="menu-item {{ request()->routeIs('anggota.buku') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
            Katalog Buku
        </a>
        <a href="{{ route('anggota.peminjaman') }}"
           class="menu-item {{ request()->routeIs('anggota.peminjaman') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="17 1 21 5 17 9"/>
                <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                <polyline points="7 23 3 19 7 15"/>
                <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
            </svg>
            Peminjaman
        </a>
        <a href="{{ route('anggota.profile') }}"
           class="menu-item {{ request()->routeIs('anggota.profile') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profile
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Logout
        </button>
    </form>
</div>

<!-- MAIN -->
<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="navbar-title">@yield('title')</div>
        <div class="navbar-right">
            <div class="notif-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
            </div>
            <span class="navbar-greeting">Hi, {{ Auth::user()->name ?? 'Anggota' }}</span>
            <div class="navbar-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container">
        @yield('content')
    </div>

</div>

</body>
</html>