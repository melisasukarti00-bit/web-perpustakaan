@extends('kepala.layouts')

@section('title', 'Data Buku')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }
    .page-header-icon {
        width: 44px; height: 44px;
        background: #3baaf4;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        box-shadow: 0 4px 12px rgba(59,170,244,0.3);
    }
    .page-header-text h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
    }
    .page-header-text p {
        font-size: 12px;
        color: #7a94b0;
        margin-top: 2px;
    }

    /* STAT CARD */
    .stat-row {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .stat-card {
        flex: 1 1 150px;
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 2px 12px rgba(59,170,244,0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .stat-card-info { display: flex; flex-direction: column; gap: 4px; }
    .stat-card-label {
        font-size: 12px;
        color: #7a94b0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card-value {
        font-size: 28px;
        font-weight: 800;
        color: #1a1a1a;
        line-height: 1;
    }
    .stat-card-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: #eef7ff;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    /* TABLE CARD */
    .card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(59,170,244,0.08);
        overflow: hidden;
    }
    .card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #eef3f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-header-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
    }
    .card-header-title span {
        width: 4px; height: 16px;
        background: #3baaf4;
        border-radius: 2px;
        display: inline-block;
    }
    .record-count {
        font-size: 12px;
        color: #7a94b0;
        background: #eef3f8;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .table-wrap { overflow-x: auto; }

    .buku-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .buku-table thead tr { background: #f5f9fd; }
    .buku-table thead th {
        padding: 12px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #7a94b0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #eef3f8;
        white-space: nowrap;
    }
    .buku-table tbody tr {
        border-bottom: 1px solid #f0f4f8;
        transition: background 0.15s;
    }
    .buku-table tbody tr:last-child { border-bottom: none; }
    .buku-table tbody tr:hover { background: #f8fbff; }
    .buku-table tbody td {
        padding: 12px 16px;
        color: #2c3e50;
        vertical-align: middle;
    }

    .no-cell { font-weight: 700; color: #3baaf4; }

    .buku-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .buku-icon {
        width: 34px; height: 34px;
        border-radius: 8px;
        background: #eef7ff;
        color: #3baaf4;
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }
    .buku-title {
        font-weight: 600;
        color: #1a1a1a;
    }

    .stok-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    .stok-ok     { background: #eafaf1; color: #27ae60; }
    .stok-sedikit { background: #fef5e7; color: #e67e22; }
    .stok-habis  { background: #fef0f0; color: #e74c3c; }

    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #b0bec5;
    }
    .empty-state svg {
        width: 48px; height: 48px;
        margin-bottom: 12px;
        opacity: 0.4;
    }
    .empty-state p { font-size: 14px; }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-icon">📚</div>
    <div class="page-header-text">
        <h2>Data Buku</h2>
        <p>Daftar seluruh koleksi buku perpustakaan</p>
    </div>
</div>

<!-- Stat Card -->
<div class="stat-row">
    <div class="stat-card">
        <div class="stat-card-info">
            <div class="stat-card-label">Total Buku</div>
            <div class="stat-card-value">{{ $buku->count() }}</div>
        </div>
        <div class="stat-card-icon">📚</div>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <div class="card-header-title">
            <span></span>
            Koleksi Buku
        </div>
        <div class="record-count">{{ $buku->count() }} judul</div>
    </div>

    <div class="table-wrap">
        <table class="buku-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $index => $b)
                <tr>
                    <td class="no-cell">{{ $index + 1 }}</td>

                    <td>
                        <div class="buku-cell">
                            <div class="buku-icon">📖</div>
                            <span class="buku-title">{{ $b->judul }}</span>
                        </div>
                    </td>

                    <td>{{ $b->pengarang }}</td>
                    <td>{{ $b->penerbit }}</td>
                    <td>{{ $b->tahun }}</td>

                    <td>
                        @if($b->stok == 0)
                            <span class="stok-badge stok-habis">Habis</span>
                        @elseif($b->stok <= 3)
                            <span class="stok-badge stok-sedikit">{{ $b->stok }}</span>
                        @else
                            <span class="stok-badge stok-ok">{{ $b->stok }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                            <p>Tidak ada data buku</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection