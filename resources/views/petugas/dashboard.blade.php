@extends('petugas.layouts')

@section('title', 'Dashboard Petugas')

@section('content')

<style>
/* HEADER */
.dashboard-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 5px;
}

.dashboard-sub {
    color: #666;
    margin-bottom: 20px;
}

/* CARD BOX */
.card-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: #4da3ff;
    padding: 20px;
    border-radius: 12px;
    color: white;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.card h4 {
    margin: 0;
    font-size: 14px;
}

.card h2 {
    margin: 10px 0 0;
    font-size: 28px;
}

/* TABLE */
.table-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.table-title {
    margin-bottom: 15px;
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background: #f1f1f1;
}

.status {
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}

.success { background: #d4edda; color: #28a745; }
.warning { background: #fff3cd; color: #ffc107; }
.danger { background: #f8d7da; color: #dc3545; }
</style>

<div class="dashboard-title">Dashboard</div>
<div class="dashboard-sub">Selamat datang kembali, Petugas 👋</div>

<!-- CARD -->
<div class="card-container">
    <div class="card">
        <h4>Total Buku</h4>
        <h2>{{ $totalBuku }}</h2>
    </div>

    <div class="card">
        <h4>Total Anggota</h4>
        <h2>{{ $totalAnggota }}</h2>
    </div>

    <div class="card">
        <h4>Buku Dipinjam</h4>
        <h2>{{ $bukuDipinjam }}</h2>
    </div>

    <div class="card">
        <h4>Buku Terlambat</h4>
        <h2>{{ $bukuTerlambat }}</h2>
    </div>
</div>

<!-- TABLE -->
<div class="table-box">
    <div class="table-title">Laporan Peminjaman Terbaru</div>

    <table border="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>{{ $item->buku->judul ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}</td>
                <td>
                    @if ($item->status === 'returned')
                        <span class="status success">Sudah Kembali</span>
                    @elseif ($item->status === 'approved' && \Carbon\Carbon::parse($item->jatuh_tempo)->isPast())
                        <span class="status danger">Terlambat</span>
                    @elseif ($item->status === 'approved')
                        <span class="status warning">Dipinjam</span>
                    @else
                        <span class="status warning">{{ ucfirst($item->status) }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="color: #999; padding: 20px;">Belum ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection