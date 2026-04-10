@extends('anggota.layouts')
@section('title', 'Profil Anggota')
@section('content')

<style>
    .profile-card {
        max-width: 560px;
        margin: auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .profile-header {
        background: linear-gradient(135deg, #4da3ff, #3b8eea);
        padding: 30px 20px 50px;
        text-align: center;
        position: relative;
    }
    .avatar-wrap {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto;
    }
    .avatar-wrap img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,0.85);
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: white;
        border: none;
        cursor: pointer;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 5px rgba(0,0,0,0.2);
        color: #4da3ff;
        font-weight: bold;
    }
    .profile-body {
        padding: 24px;
        margin-top: -24px;
        background: #fff;
        border-radius: 20px 20px 0 0;
    }
    .name-display {
        text-align: center;
        margin-bottom: 24px;
    }
    .name-display h3 { margin: 0 0 6px; font-size: 18px; color: #1a1a2e; }
    .badge-anggota {
        display: inline-block;
        background: #e6f1fb;
        color: #185fa5;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .form-group { margin-bottom: 16px; }
    .form-group label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #8a8a9a;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 7px;
    }
    .form-group input {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 14px;
        border-radius: 10px;
        border: 1.5px solid #e0e0ee;
        background: #f7f9fc;
        font-size: 14px;
        color: #222;
        font-family: Arial, sans-serif;
        transition: 0.2s;
    }
    .form-group input:focus {
        outline: none;
        border-color: #4da3ff;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(77,163,255,0.12);
    }
    .btn-save {
        width: 100%;
        padding: 13px;
        background: #4da3ff;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 15px;
        margin-top: 8px;
        transition: 0.2s;
    }
    .btn-save:hover { background: #3b8eea; }
    .alert-success {
        background: #eafaf1;
        color: #1a6e3c;
        border: 1px solid #a3d9b1;
        padding: 11px 16px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 16px;
        font-size: 14px;
    }
    input[type="file"] { display: none; }
</style>

<div class="profile-card">
    <div class="profile-header">
        <div class="avatar-wrap">
            <img id="avatarPreview"
                 src="{{ $user->photo ? asset('storage/photos/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4da3ff&color=fff&size=200' }}"
                 alt="Foto Profil">
            <button type="button" class="avatar-edit-btn" onclick="document.getElementById('photoInput').click()" title="Ganti foto">✎</button>
        </div>
    </div>

    <div class="profile-body">
        <div class="name-display">
            <h3 id="displayName">{{ $user->name }}</h3>
            <span class="badge-anggota">Anggota</span>
        </div>

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div style="background:#fef0f0;color:#c0392b;border:1px solid #f5a8a8;padding:11px 16px;border-radius:10px;margin-bottom:16px;font-size:13px;">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('anggota.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="photo" id="photoInput" accept="image/*">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" id="nameInput" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label>Password Baru <span style="font-weight:400;color:#bbb;">(kosongkan jika tidak diganti)</span></label>
                <input type="password" name="password" placeholder="••••••••">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="••••••••">
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    const photoInput = document.getElementById('photoInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const nameInput = document.getElementById('nameInput');
    const displayName = document.getElementById('displayName');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            avatarPreview.style.opacity = '0.5';
            avatarPreview.src = URL.createObjectURL(file);
            avatarPreview.onload = () => avatarPreview.style.opacity = '1';
        }
    });

    nameInput.addEventListener('input', function () {
        displayName.textContent = this.value || 'Anggota';
    });
</script>
@endsection