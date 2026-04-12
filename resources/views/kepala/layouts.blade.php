<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Melibrary</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(160deg, #ddeeff 0%, #c8e8ff 50%, #d4eef9 100%);
            display: flex;
            min-height: 100vh;
        }

        a { text-decoration: none; }

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
        .logo-dot {
            width: 8px; height: 8px;
            background: #3b9ce2;
            border-radius: 50%;
        }

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

        .sidebar-menu {
            flex: 1; padding: 14px 12px;
            display: flex; flex-direction: column; gap: 4px;
        }
        .menu-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 10px;
            font-size: 13px; color: #4a6080;
            text-decoration: none; font-weight: 500;
            transition: 0.2s;
        }
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
            font-family: Arial; transition: 0.2s;
        }
        .menu-logout:hover { background: #fde0e0; }

        /* ── MAIN ── */
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

        .navbar {
            background: #3baaf4;
            color: #fff; padding: 0 24px; height: 58px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 10;
            box-shadow: 0 2px 8px rgba(59,170,244,0.2);
        }
        .navbar-title   { font-size: 15px; font-weight: 700; }
        .navbar-right   { display: flex; align-items: center; gap: 12px; }
        .navbar-greeting { font-size: 13px; opacity: 0.9; }
        .navbar-avatar  {
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff;
        }

        .container {
            padding: 24px;
            overflow-y: auto;
        }
        .container::-webkit-scrollbar { width: 6px; }
        .container::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.15);
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; }
            .sidebar-profile, .sidebar-head { display: none; }
            .sidebar-menu { flex-direction: row; padding: 8px; overflow-x: auto; }
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
        <div class="avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
        <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
        <div class="profile-badge">{{ Auth::user()->role ?? 'Role' }}</div>
    </div>

    <div class="sidebar-menu">
        <a href="{{ route('kepala.dashboard') }}"
           class="menu-item {{ request()->routeIs('kepala.dashboard') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('kepala.buku') }}"
           class="menu-item {{ request()->routeIs('kepala.buku') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
            Data Buku
        </a>

        <a href="{{ route('kepala.petugas.index') }}"
           class="menu-item {{ request()->routeIs('kepala.petugas.index') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Data Petugas
        </a>

        <a href="{{ route('kepala.laporan') }}"
           class="menu-item {{ request()->routeIs('kepala.laporan') ? 'active' : '' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6"  y1="20" x2="6"  y2="14"/>
            </svg>
            Laporan
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="menu-logout">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
            <span class="navbar-greeting">👋 Hi, {{ Auth::user()->name ?? 'User' }}</span>
            <div class="navbar-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
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