@extends('kepala.layouts')

@section('title', 'Tambah Petugas')

@section('content')

<h2 style="color:#4da3ff; margin-bottom:20px;">➕ Tambah Petugas</h2>

<div style="max-width:500px; background:white; padding:25px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1);">

    <form action="{{ route('kepala.petugas.store') }}" method="POST">
        @csrf

        <!-- Nama -->
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Nama</label>
            <input type="text" name="name" required
                style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; font-size:14px;">
        </div>

        <!-- Email -->
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Email</label>
            <input type="email" name="email" required
                style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; font-size:14px;">
        </div>

        <!-- Password -->
        <div style="margin-bottom:20px;">
            <label style="display:block; font-weight:bold; margin-bottom:5px;">Password</label>
            <input type="password" name="password" required
                style="width:100%; padding:10px; border-radius:6px; border:1px solid #ccc; font-size:14px;">
        </div>

        <!-- Tombol -->
        <div style="display:flex; gap:10px;">
            <button type="submit"
                style="flex:1; padding:10px 0; background:#28a745; color:white; border:none; border-radius:8px; font-weight:bold; cursor:pointer; transition:0.2s;">
                💾 Simpan
            </button>

            <a href="{{ route('kepala.petugas.index') }}"
                style="flex:1; text-align:center; padding:10px 0; background:#6c757d; color:white; border-radius:8px; text-decoration:none; font-weight:bold; transition:0.2s;">
                🔙 Kembali
            </a>
        </div>
    </form>

</div>

@endsection