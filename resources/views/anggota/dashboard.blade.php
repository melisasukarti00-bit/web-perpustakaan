@extends('layout')

@section('content')

<style>
/* DASHBOARD */
.dashboard {
  padding: 20px;
}

.title {
  color: #4ea8de;
  margin-bottom: 5px;
}

.subtitle {
  margin-bottom: 20px;
}

/* CARD */
.cards {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-bottom: 30px;
}

.card {
  background: linear-gradient(to right, #4ea8de, #5fa8f5);
  color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}

.card h1 {
  font-size: 40px;
  margin: 10px 0 0;
}

/* TABLE */
.table-box {
  background: white;
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.table-box h3 {
  margin-bottom: 15px;
  background: #eef3f8;
  display: inline-block;
  padding: 8px 15px;
  border-radius: 20px;
  color: #4ea8de;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  padding: 10px;
  text-align: left;
}

table thead {
  border-bottom: 2px solid #ddd;
}

.badge {
  background: #4ea8de;
  color: white;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
}
</style>

<div class="dashboard">

  <h2 class="title">Dashboard</h2>
  <p class="subtitle">Selamat datang kembali, Melisandra</p>

  <!-- CARD -->
  <div class="cards">
    <div class="card">
      <p>Total Peminjaman</p>
      <h1>5</h1>
    </div>

    <div class="card">
      <p>Sedang Dipinjam</p>
      <h1>2</h1>
    </div>

    <div class="card">
      <p>Sudah Dikembalikan</p>
      <h1>3</h1>
    </div>

    <div class="card">
      <p>Total Denda</p>
      <h1>0</h1>
    </div>
  </div>

  <!-- TABLE -->
  <div class="table-box">
    <h3>Riwayat Peminjaman Terbaru</h3>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Judul Buku</th>
          <th>Tanggal Pinjam</th>
          <th>Jatuh Tempo</th>
          <th>Tanggal Kembali</th>
          <th>Denda</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>Pengetahuan Alam</td>
          <td>02 Feb 2026</td>
          <td>04 Feb 2026</td>
          <td>03 Feb 2026</td>
          <td>-</td>
          <td><span class="badge">Sudah Kembali</span></td>
        </tr>

        <tr>
          <td>2</td>
          <td>Si Kancil</td>
          <td>02 Feb 2026</td>
          <td>04 Feb 2026</td>
          <td>03 Feb 2026</td>
          <td>-</td>
          <td><span class="badge">Sudah Kembali</span></td>
        </tr>

      </tbody>
    </table>
  </div>

</div>

@endsection