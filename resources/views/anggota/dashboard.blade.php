@extends('anggota.layouts')

@section('title', 'Dashboard Anggota')

@section('content')

<style>
.title {
  color: #000000;
  margin-bottom: 5px;
}

.subtitle {
  margin-bottom: 20px;
}

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
  color: white;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
}
</style>

<h2 class="title">Dashboard</h2>
<p class="subtitle">Selamat datang kembali, {{ Auth::user()->name }}</p>

{{-- CARD --}}
<div class="cards">
  <div class="card">
    <p>Total Peminjaman</p>
    <h1>{{ $totalPeminjaman ?? 0 }}</h1>
  </div>

  <div class="card">
    <p>Sedang Dipinjam</p>
    <h1>{{ $sedangDipinjam ?? 0 }}</h1>
  </div>

  <div class="card">
    <p>Sudah Dikembalikan</p>
    <h1>{{ $sudahDikembalikan ?? 0 }}</h1>
  </div>

  <div class="card">
    <p>Total Denda</p>
    <h1>Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h1>
  </div>
</div>

{{-- TABLE --}}
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
      @forelse($riwayat as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->judul }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}</td>
        <td>
          {{ $item->tanggal_kembali 
              ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') 
              : '-' }}
        </td>
        <td>
          {{ $item->denda > 0 
              ? 'Rp ' . number_format($item->denda, 0, ',', '.') 
              : '-' }}
        </td>
        <td>
          @if($item->status == 'pending')
            <span class="badge" style="background:gray;">Menunggu</span>

          @elseif($item->status == 'approved' && !$item->tanggal_kembali)
            <span class="badge" style="background:#f39c12;">Dipinjam</span>

          @elseif($item->status == 'selesai')
            <span class="badge" style="background:#2ecc71;">Sudah Kembali</span>

          @else
            <span class="badge" style="background:#999;">-</span>
          @endif
        </td>
      </tr>

      @empty
      <tr>
        <td colspan="7" style="text-align:center; color:gray;">
          Belum ada riwayat peminjaman
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection