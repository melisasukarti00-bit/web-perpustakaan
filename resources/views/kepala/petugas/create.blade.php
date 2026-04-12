@extends('kepala.layouts')

@section('title', 'Tambah Petugas')

@section('content')

<style>
    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }
    .page-header-icon {
        width: 48px; height: 48px;
        background: linear-gradient(135deg, #3baaf4, #1a8fd1);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 6px 16px rgba(59,170,244,0.35);
    }
    .page-header-icon svg { width: 24px; height: 24px; stroke: #fff; }
    .page-header-text h2 {
        font-size: 22px;
        font-weight: 800;
        color: #0f1923;
        letter-spacing: -0.3px;
    }
    .page-header-text p {
        font-size: 13px;
        color: #8fa3b8;
        margin-top: 3px;
    }

    /* ── FORM CARD ── */
    .form-card {
        max-width: 520px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 16px rgba(59,170,244,0.07);
        border: 1px solid #f0f5fb;
        overflow: hidden;
    }
    .form-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f0f5fb;
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
        flex-shrink: 0;
    }
    .form-card-body { padding: 24px; }

    /* ── FORM FIELDS ── */
    .form-group { margin-bottom: 20px; }
    .form-group label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 700;
        color: #5a7a9a;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 8px;
    }
    .form-group label svg {
        width: 14px; height: 14px;
        stroke: #3baaf4;
    }
    .form-group input {
        width: 100%;
        padding: 11px 14px;
        border-radius: 10px;
        border: 1.5px solid #e8f0f8;
        font-size: 13px;
        color: #0f1923;
        background: #f8fbfe;
        transition: border 0.2s, box-shadow 0.2s;
        outline: none;
        box-sizing: border-box;
    }
    .form-group input:focus {
        border-color: #3baaf4;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(59,170,244,0.12);
    }
    .form-group input::placeholder { color: #b8ccd8; }

    /* ── DIVIDER ── */
    .form-divider {
        height: 1px;
        background: #f0f5fb;
        margin: 24px 0;
    }

    /* ── BUTTONS ── */
    .form-actions {
        display: flex;
        gap: 12px;
    }
    .btn-simpan {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 0;
        background: linear-gradient(135deg, #27ae60, #1e8449);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(39,174,96,0.3);
        transition: 0.2s;
    }
    .btn-simpan:hover {
        box-shadow: 0 6px 18px rgba(39,174,96,0.4);
        transform: translateY(-1px);
    }
    .btn-simpan svg { width: 15px; height: 15px; stroke: #fff; }

    .btn-kembali {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 0;
        background: #f5f8fc;
        color: #5a7a9a;
        border: 1.5px solid #e8f0f8;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-kembali:hover {
        background: #eef3f8;
        color: #3baaf4;
        border-color: #d4ecff;
    }
    .btn-kembali svg { width: 15px; height: 15px; stroke: currentColor; }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
        </svg>
    </div>
    <div class="page-header-text">
        <h2>Tambah Petugas</h2>
        <p>Buat akun baru untuk petugas perpustakaan</p>
    </div>
</div>

<!-- Form Card -->
<div class="form-card">
    <div class="form-card-header">
        <span class="accent-bar"></span>
        Informasi Akun Petugas
    </div>

    <div class="form-card-body">
        <form action="{{ route('kepala.petugas.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Nama
                </label>
                <input type="text" name="name" required placeholder="Masukkan nama lengkap">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Email
                </label>
                <input type="email" name="email" required placeholder="contoh@email.com">
            </div>

            <!-- Password -->
            <div class="form-group">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    Password
                </label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter">
            </div>

            <div class="form-divider"></div>

            <!-- Tombol -->
            <div class="form-actions">
                <button type="submit" class="btn-simpan">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Simpan
                </button>

                <a href="{{ route('kepala.petugas.index') }}" class="btn-kembali">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

@endsection