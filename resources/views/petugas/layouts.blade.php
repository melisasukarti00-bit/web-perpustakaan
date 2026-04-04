<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #eef2f7;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #ffffff;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
            color: #4da3ff;
        }

        .profile {
            text-align: center;
            margin-bottom: 25px;
        }

        .profile img {
            width: 70px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile h4 {
            margin: 5px 0;
        }

        .badge {
            background: #4da3ff;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        /* MENU */
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            margin: 6px 0;
            text-decoration: none;
            color: #333;
            border-radius: 10px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #4da3ff;
            color: white;
        }

        .menu a.active {
            background: #4da3ff;
            color: white;
            font-weight: bold;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(to right, #4da3ff, #3b8eea);
            color: white;
            padding: 15px 25px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar img {
            width: 35px;
            border-radius: 50%;
        }

        /* CONTENT */
        .container {
            padding: 25px;
        }

    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">📚 melibrary</div>

    <div class="profile">
        <img src="https://via.placeholder.com/70">
        <h4>Dwi Oktapiani</h4>
        <span class="badge">Petugas</span>
    </div>

    <div class="menu">
        <a href="{{ route('petugas.dashboard') }}" class="active">🏠 Dashboard</a>
        <a href="{{ route('petugas.buku.index') }}">📚 Kelola Buku</a>
        <a href="#">📄 Data Anggota</a>
        <a href="#">📄 Laporan Pengembalian</a>
        <a href="#">👤 Profil</a>
        <a href="#">🚪 Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
        <div>Dashboard / Petugas</div>

        <div class="right">
            <span>👋 Hi, Dwi</span>
            <img src="https://via.placeholder.com/35">
        </div>
    </div>

    <!-- CONTENT -->
    <div class="container">
        @yield('content')
    </div>

</div>

</body>
</html>