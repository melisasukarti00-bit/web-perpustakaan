<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Melibrary</title>

  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background: #eef3f8;
    }

    .container {
      display: flex;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background: white;
      padding: 20px;
    }

    .sidebar li {
      list-style: none;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
    }

    .sidebar li.active {
      background: #4ea8de;
      color: white;
    }

    .main {
      flex: 1;
    }

    .navbar {
      background: #4ea8de;
      color: white;
      padding: 15px;
    }

    section {
      padding: 20px;
    }
  </style>
</head>

<body>

<div class="container">

  <!-- Sidebar -->
  <aside class="sidebar">
    <ul>
      <li>Dashboard</li>
      <li>Katalog Buku</li>
      <li>Peminjaman</li>
      <li>Riwayat</li>
      <li>Profil</li>
    </ul>
  </aside>

  
  <main class="main">

    
    <div class="navbar">
      <h2>Melibrary</h2>
    </div>

   
    <section>
      @yield('content')
    </section>

  </main>

</div>

</body>
</html>