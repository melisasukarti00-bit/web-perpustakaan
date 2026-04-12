@extends('kepala.layouts')

@section('title', 'Data Petugas')

@section('content')

<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .page-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
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
    .btn-tambah {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: #3baaf4;
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(59,170,244,0.3);
        transition: 0.2s;
    }
    .btn-tambah:hover {
        background: #2a9ae0;
        box-shadow: 0 6px 16px rgba(59,170,244,0.4);
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

    .pet-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .pet-table thead tr { background: #f5f9fd; }
    .pet-table thead th {
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
    .pet-table tbody tr {
        border-bottom: 1px solid #f0f4f8;
        transition: background 0.15s;
    }
    .pet-table tbody tr:last-child { border-bottom: none; }
    .pet-table tbody tr:hover { background: #f8fbff; }
    .pet-table tbody td {
        padding: 12px 16px;
        color: #2c3e50;
        vertical-align: middle;
    }

    .no-cell { font-weight: 700; color: #3baaf4; }

    .petugas-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .petugas-avatar {
        width: 34px; height: 34px;
        border-radius: 50%;
        background: #ddeeff;
        color: #3baaf4;
        font-size: 13px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .petugas-name {
        font-weight: 600;
        color: #1a1a1a;
    }

    .email-cell { color: #7a94b0; }

    .aksi-cell {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #fef5e7;
        color: #e67e22;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-edit:hover { background: #fde8c8; }

    .btn-hapus {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #fef0f0;
        color: #e74c3c;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        font-family: Arial;
        transition: 0.2s;
    }
    .btn-hapus:hover { background: #fdd8d8; }

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
    <div class="page-header-left">
        <div class="page-header-icon">👨‍💼</div>
        <div class="page-header-text">
            <h2>Data Petugas</h2>
            <p>Kelola akun petugas perpustakaan</p>
        </div>
    </div>
    <a href="{{ route('kepala.petugas.create') }}" class="btn-tambah">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Petugas
    </a>
</div>

<!-- Table Card -->
<div class="card">
    <div class="card-header">
        <div class="card-header-title">
            <span></span>
            Daftar Petugas
        </div>
        <div class="record-count">{{ count($petugas) }} petugas</div>
    </div>

    <div class="table-wrap">
        <table class="pet-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $no => $p)
                <tr>
                    <td class="no-cell">{{ $no + 1 }}</td>

                    <td>
                        <div class="petugas-cell">
                            <div class="petugas-avatar">
                                {{ strtoupper(substr($p->name, 0, 1)) }}
                            </div>
                            <span class="petugas-name">{{ $p->name }}</span>
                        </div>
                    </td>

                    <td class="email-cell">{{ $p->email }}</td>

                    <td>
                        <div class="aksi-cell">
                            <form action="{{ route('kepala.petugas.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <p>Data petugas kosong</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection