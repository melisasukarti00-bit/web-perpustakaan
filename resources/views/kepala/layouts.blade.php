<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Melibrary</title>

    <style>
        /* =========================
           GLOBAL
        ========================= */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: #eef2f7;
            display: flex;
            height: 100vh;
        }
        a {
            text-decoration: none;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            width: 240px;
            background: #fff;
            height: 100%;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }
        .logo {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 25px;
            color: #4da3ff;
        }
        .profile {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .profile h4 {
            margin: 5px 0;
            font-size: 16px;
        }
        .badge {
            background: #4da3ff;
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .menu {
            flex: 1;
        }
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            margin: 6px 0;
            color: #333;
            border-radius: 8px;
            transition: 0.2s;
        }
        .menu a:hover,
        .menu a.active {
            background: #4da3ff;
            color: #fff;
            font-weight: bold;
        }
        .menu form button {
            width: 100%;
            padding: 10px;
            text-align: left;
            background: #f44336;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            transition: 0.2s;
        }

        /* =========================
           MAIN
        ========================= */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(to right, #4da3ff, #3b8eea);
            color: #fff;
            padding: 15px 25px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .navbar .right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* CONTENT */
        .container {
            padding: 25px;
            overflow-y: auto;
        }
        .container::-webkit-scrollbar {
            width: 6px;
        }
        .container::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.2);
            border-radius: 3px;
        }
    </style>
</head>
<body>

    <!-- =========================
         SIDEBAR
    ========================= -->
    <div class="sidebar">
        <div class="logo">📚 Melibrary</div>

        <div class="profile">
            <h4>{{ Auth::user()->name ?? 'User' }}</h4>
            <span class="badge">{{ Auth::user()->role ?? 'Role' }}</span>
        </div>

        <div class="menu">
            <a href="{{ route('kepala.dashboard') }}" class="{{ request()->routeIs('kepala.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('kepala.buku') }}" class="{{ request()->routeIs('kepala.buku') ? 'active' : '' }}">📚 Data Buku</a>
            <a href="{{ route('kepala.petugas.index') }}" class="{{ request()->routeIs('kepala.petugas.index') ? 'active' : '' }}">👨‍💼 Data Petugas</a>
            <a href="{{ route('kepala.laporan') }}" class="{{ request()->routeIs('kepala.laporan') ? 'active' : '' }}">📊 Laporan</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <!-- =========================
         MAIN AREA
    ========================= -->
    <div class="main">
        <!-- NAVBAR -->
        <div class="navbar">
            <div>@yield('title')</div>
            <div class="right">
                <span>👋 Hi, {{ Auth::user()->name ?? 'User' }}</span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="container">
            @yield('content')
        </div>
    </div>

</body>
</html>