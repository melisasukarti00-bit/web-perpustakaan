@extends('kepala.layouts')

@section('title', 'Dashboard')

@section('content')

<style>
    /* ── PAGE HEADER ── */
    .page-header {
        margin-bottom: 28px;
    }
    .page-header h2 {
        font-size: 22px;
        font-weight: 800;
        color: #0f1923;
        letter-spacing: -0.3px;
    }
    .page-header p {
        font-size: 13px;
        color: #8fa3b8;
        margin-top: 4px;
    }

    /* ── STAT CARDS ── */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .card-box {
        background: #fff;
        border-radius: 16px;
        padding: 20px 22px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 16px rgba(59,170,244,0.07);
        border: 1px solid #f0f5fb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 24px rgba(59,170,244,0.13);
    }
    .card-box::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(180deg, #3baaf4, #1a8fd1);
        border-radius: 4px 0 0 4px;
    }
    .card-box-info { display: flex; flex-direction: column; gap: 6px; }
    .card-box h4 {
        font-size: 11px;
        color: #8fa3b8;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin: 0;
    }
    .card-box h2 {
        font-size: 32px;
        font-weight: 800;
        color: #0f1923;
        line-height: 1;
        letter-spacing: -1px;
        margin: 0;
    }
    .card-box-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #eef7ff, #ddeeff);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .card-box-icon svg { width: 24px; height: 24px; stroke: #3baaf4; }

    /* ── TABLE CARD ── */
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 16px rgba(59,170,244,0.07);
        border: 1px solid #f0f5fb;
        overflow: hidden;
    }
    .card-header {
        padding: 18px 22px;
        border-bottom: 1px solid #f0f5fb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-header-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        font-weight: 700;
        color: #0f1923;
    }
    .accent-bar {
        width: 4px; height: 18px;
        background: linear-gradient(180deg, #3baaf4, #1a8fd1);
        border-radius: 2px;
        display: inline-block;
        flex-shrink: 0;
    }
    .record-count {
        font-size: 12px;
        color: #3baaf4;
        background: #eef7ff;
        padding: 5px 14px;
        border-radius: 20px;
        font-weight: 700;
        border: 1px solid #d4ecff;
    }

    /* ── TABLE ── */
    .table-wrap { overflow-x: auto; }

    .lap-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .lap-table thead tr { background: #f8fbfe; }
    .lap-table thead th {
        padding: 13px 18px;
        text-align: left;
        font-size: 10.5px;
        font-weight: 700;
        color: #8fa3b8;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        border-bottom: 1px solid #f0f5fb;
        white-space: nowrap;
    }
    .lap-table tbody tr {
        border-bottom: 1px solid #f5f8fc;
        transition: background 0.15s;
    }
    .lap-table tbody tr:last-child { border-bottom: none; }
    .lap-table tbody tr:hover { background: #f8fbff; }
    .lap-table tbody td {
        padding: 13px 18px;
        color: #2c3e50;
        vertical-align: middle;
    }

    .no-cell { font-weight: 700; color: #c5d5e8; font-size: 12px; }

    .member-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .member-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ddeeff, #c8e8ff);
        color: #3baaf4;
        font-size: 12px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .member-name { font-weight: 600; color: #0f1923; }

    .book-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .book-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: linear-gradient(135deg, #eef7ff, #ddeeff);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .book-icon svg { width: 14px; height: 14px; stroke: #3baaf4; }
    .book-title { font-weight: 600; color: #0f1923; }

    .date-cell { color: #5a7a9a; white-space: nowrap; }
    .due-cell  { color: #d35400; font-weight: 600; white-space: nowrap; }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 13px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.7;
    }
    .badge-belum    { background: #eef7ff; color: #1a74b8; border: 1px solid #d4ecff; }
    .badge-selesai  { background: #eafaf1; color: #1e8449; border: 1px solid #d5f5e3; }
    .badge-terlambat{ background: #fef0f0; color: #c0392b; border: 1px solid #fdd8d8; }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 64px 20px;
    }
    .empty-icon {
        width: 64px; height: 64px;
        background: #f5f9fd;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }
    .empty-icon svg { width: 28px; height: 28px; stroke: #c5d5e8; }
    .empty-state p {
        font-size: 14px;
        font-weight: 600;
        color: #8fa3b8;
        margin-bottom: 4px;
    }
    .empty-state small { font-size: 12px; color: #b8ccd8; }
</style>

<!-- Page Header -->
<div class="page-header">
    <h2>Dashboard</h2>
    <p>Selamat datang kembali 👋</p>
</div>

<!-- Stat Cards -->
<div class="cards">
    <div class="card-box">
        <div class="card-box-info">
            <h4>Total Buku</h4>
            <h2>{{ $totalBuku }}</h2>
        </div>
        <div class="card-box-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
        </div>
    </div>

    <div class="card-box">
        <div class="card-box-info">
            <h4>Buku Dipinjam</h4>
            <h2>{{ $bukuDipinjam }}</h2>
        </div>
        <div class="card-box-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="17 1 21 5 17 9"/>
                <path d="M3 11V9a4 4 0 0 1 4-4h14"/>
                <polyline points="7 23 3 19 7 15"/>
                <path d="M21 13v2a4 4 0 0 1-4 4H3"/>
            </svg>
        </div>
    </div>

    <div class="card-box">
        <div class="card-box-info">
            <h4>Pengembalian Menunggu</h4>
            <h2>{{ $pengembalianMenunggu }}</h2>
        </div>
        <div class="card-box-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <div class="card-header-title">
            <span class="accent-bar"></span>
            Laporan Peminjaman Terbaru
        </div>
        <div class="record-count">{{ count($riwayatPeminjaman) }} data</div>
    </div>

    <div class="table-wrap">
        <table class="lap-table">
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
                    <td class="no-cell">{{ $index + 1 }}</td>

                    <td>
                        <div class="member-cell">
                            <div class="member-avatar">
                                {{ strtoupper(substr($p->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="member-name">{{ $p->user->name ?? '-' }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="book-cell">
                            <div class="book-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                                </svg>
                            </div>
                            <span class="book-title">{{ $p->judul ?? '-' }}</span>
                        </div>
                    </td>

                    <td class="date-cell">
                        {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="due-cell">
                        {{ \Carbon\Carbon::parse($p->jatuh_tempo)->format('d M Y') }}
                    </td>

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
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                            </div>
                            <p>Tidak ada data peminjaman</p>
                            <small>Belum ada riwayat peminjaman terbaru</small>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection