@extends('kepala.layouts')

@section('title', 'Laporan Peminjaman')

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

    .lap-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .lap-table thead tr {
        background: #f5f9fd;
    }
    .lap-table thead th {
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
    .lap-table tbody tr {
        border-bottom: 1px solid #f0f4f8;
        transition: background 0.15s;
    }
    .lap-table tbody tr:last-child { border-bottom: none; }
    .lap-table tbody tr:hover { background: #f8fbff; }
    .lap-table tbody td {
        padding: 12px 16px;
        color: #2c3e50;
        vertical-align: middle;
    }

    .no-cell { font-weight: 700; color: #3baaf4; }
    .book-title { font-weight: 600; color: #1a1a1a; }

    .borrower-cell {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .borrower-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #ddeeff;
        color: #3baaf4;
        font-size: 11px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .date-cell   { color: #4a6080; white-space: nowrap; }
    .due-cell    { color: #e67e22; font-weight: 600; white-space: nowrap; }
    .return-cell { color: #27ae60; font-weight: 600; white-space: nowrap; }
    .denda-cell  { color: #e74c3c; font-weight: 600; }
    .denda-none  { color: #bdc3c7; }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
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
        opacity: 0.6;
    }
    .badge-pending  { background: #f0f0f0;  color: #7f8c8d; }
    .badge-dipinjam { background: #fef5e7;  color: #e67e22; }
    .badge-selesai  { background: #eafaf1;  color: #27ae60; }
    .badge-default  { background: #f0f0f0;  color: #aaa; }

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
    <div class="page-header-icon">📊</div>
    <div class="page-header-text">
        <h2>Laporan Peminjaman</h2>
        <p>Rekap seluruh data peminjaman buku</p>
    </div>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <div class="card-header-title">
            <span></span>
            Data Peminjaman
        </div>
        <div class="record-count">{{ count($laporan) }} data</div>
    </div>

    <div class="table-wrap">
        <table class="lap-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $item)
                <tr>
                    <td class="no-cell">{{ $loop->iteration }}</td>

                    <td class="book-title">
                        {{ $item->buku->judul ?? $item->judul ?? '-' }}
                    </td>

                    <td>
                        <div class="borrower-cell">
                            <div class="borrower-avatar">
                                {{ strtoupper(substr($item->user->name ?? 'A', 0, 1)) }}
                            </div>
                            {{ $item->user->name ?? '-' }}
                        </div>
                    </td>

                    <td class="date-cell">
                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                    </td>

                    <td class="due-cell">
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}
                    </td>

                    <td class="return-cell">
                        {{ $item->tanggal_kembali
                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y')
                            : '-' }}
                    </td>

                    <td>
                        @if($item->denda > 0)
                            <span class="denda-cell">
                                Rp {{ number_format($item->denda, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="denda-none">-</span>
                        @endif
                    </td>

                    <td>
                        @if($item->status == 'pending')
                            <span class="badge badge-pending">Menunggu</span>
                        @elseif($item->status == 'approved' && !$item->tanggal_kembali)
                            <span class="badge badge-dipinjam">Dipinjam</span>
                        @elseif($item->status == 'selesai')
                            <span class="badge badge-selesai">Sudah Kembali</span>
                        @else
                            <span class="badge badge-default">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                            <p>Belum ada data peminjaman</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection