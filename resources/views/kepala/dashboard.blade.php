@extends('kepala.layouts')

@section('title', 'Dashboard')

@section('content')

<style>
.dashboard-title {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 5px;
}

.subtitle {
    color: #777;
    margin-bottom: 25px;
}

/* CARD */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card-box {
    background: linear-gradient(135deg, #4da3ff, #3b8eea);
    color: white;
    padding: 20px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.card-box:hover {
    transform: translateY(-5px);
}

.card-box h4 {
    margin-bottom: 8px;
    font-weight: normal;
    font-size: 14px;
}

.card-box h2 {
    font-size: 32px;
    margin: 0;
}

/* TABLE */
.table-box {
    background: white;
    padding: 20px;
    border-radius: 18px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.table-title {
    background: #eaf3ff;
    padding: 6px 15px;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 15px;
    color: #4da3ff;
    font-size: 13px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    font-size: 13px;
    color: #555;
    padding: 10px;
    text-align: left;
}

table td {
    padding: 10px;
    font-size: 13px;
}

table tbody tr {
    border-bottom: 1px solid #eee;
}

table tbody tr:hover {
    background: #f9fbff;
}

/* STATUS */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    color: white;
}

.badge-belum {
    background: #4da3ff;
}

.badge-selesai {
    background: #4CAF50;
}

.badge-terlambat {
    background: #e74c3c;
}
</style>

<div class="dashboard-title">Dashboard</div>
<div class="subtitle">
    Selamat datang kembali 👋
</div>

<!-- CARD -->
<div class="cards">
    <div class="card-box">
        <h4>Total Buku</h4>
        <h2>{{ $totalBuku }}</h2>
    </div>

    <div class="card-box">
        <h4>Buku Dipinjam</h4>
        <h2>{{ $bukuDipinjam }}</h2>
    </div>

    <div class="card-box">
        <h4>Pengembalian Menunggu</h4>
        <h2>{{ $pengembalianMenunggu }}</h2>
    </div>
</div>

<!-- TABLE -->
<div class="table-box">
    <div class="table-title">Laporan Peminjaman Terbaru</div>

    <table>
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
            @forelse($riwayatPeminjaman as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user->name ?? '-' }}</td>
                <td>{{ $p->judul ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($p->jatuh_tempo)->format('d M Y') }}</td>
                <td>
                    @if($p->status == 'pending')
                        <span class="badge badge-belum">Belum Kembali</span>
                    @elseif($p->status == 'selesai')
                        <span class="badge badge-selesai">Selesai</span>
                    @elseif($p->status == 'dikembalikan')
                        <span class="badge badge-belum">Menunggu Konfirmasi</span>
                    @elseif(\Carbon\Carbon::now()->gt($p->jatuh_tempo) && $p->status != 'selesai')
                        <span class="badge badge-terlambat">Terlambat</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">Tidak ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection