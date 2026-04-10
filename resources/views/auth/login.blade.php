<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: linear-gradient(160deg, #ddeeff 0%, #c8e8ff 50%, #d4eef9 100%);
    font-family: Arial, sans-serif;
}

.topbar {
    padding: 20px 28px;
    display: flex;
    align-items: center;
}
.logo-dot { width: 9px; height: 9px; background: #3b9ce2; border-radius: 50%; margin-right: 6px; }
.logo { font-size: 15px; font-weight: 700; }
.logo .me  { color: #1a1a1a; }
.logo .lib { color: #3b9ce2; }

.page-center {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 16px 48px;
}

.card {
    background: white;
    padding: 44px 36px 36px;
    border-radius: 22px;
    width: 360px;
    box-shadow: 0 8px 32px rgba(59,156,226,0.10);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.icon-wrap {
    width: 68px; height: 68px;
    background: #e6f2fb;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 18px;
}

.brand { font-size: 22px; font-weight: 700; margin-bottom: 4px; }
.brand .me  { color: #1a1a1a; }
.brand .lib { color: #3b9ce2; }

.tagline { font-size: 12px; color: #7a9ab5; margin-bottom: 24px; }
.divider  { width: 100%; height: 1px; background: #e4f0f9; margin-bottom: 22px; }

.error-msg { color: #e24b4a; font-size: 13px; margin-bottom: 12px; text-align: center; }

.field { width: 100%; margin-bottom: 14px; }
.field label {
    font-size: 11px; font-weight: 700;
    color: #4a7fa8; letter-spacing: 0.5px;
    display: block; margin-bottom: 6px;
}
.input-wrap { position: relative; display: flex; align-items: center; }
.input-icon { position: absolute; left: 12px; pointer-events: none; display: flex; }

input[type=text],
input[type=password] {
    width: 100%;
    padding: 12px 14px 12px 38px;
    border-radius: 10px;
    border: 1.5px solid #d0e8f7;
    background: #f7fbff;
    font-size: 14px;
    color: #1a1a1a;
    outline: none;
    font-family: Arial;
}
input:focus { border-color: #3b9ce2; background: #fff; }
input::placeholder { color: #aac4d8; }

.eye-btn {
    position: absolute; right: 12px;
    background: none; border: none;
    cursor: pointer; padding: 0; display: flex;
}

.forgot { text-align: right; font-size: 12px; color: #3b9ce2; margin-bottom: 6px; margin-top: -6px; }
.forgot a { color: #3b9ce2; text-decoration: none; }

button[type=submit] {
    width: 100%;
    padding: 14px;
    background: #185FA5;
    border: none;
    color: white;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 6px;
    font-family: Arial;
}
button[type=submit]:hover { background: #0c447c; }

.or-wrap { display: flex; align-items: center; gap: 10px; width: 100%; margin: 14px 0; }
.or-line  { flex: 1; height: 1px; background: #e4f0f9; }
.or-text  { font-size: 11px; color: #aac4d8; }

.register-link {
    width: 100%;
    padding: 13px;
    background: #f0f8ff;
    border: 1.5px solid #3b9ce2;
    color: #3b9ce2;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    display: block;
}
.register-link:hover { background: #ddeeff; }

.badge { margin-top: 20px; display: flex; align-items: center; gap: 6px; font-size: 11px; color: #9ab8cc; }
.badge-dot { width: 6px; height: 6px; background: #6dcf9e; border-radius: 50%; }
</style>
</head>

<body>

<div class="topbar">
    <div class="logo-dot"></div>
    <div class="logo"><span class="me">me</span><span class="lib">library</span></div>
</div>

<div class="page-center">
    <div class="card">

        <div class="icon-wrap">
            <svg width="36" height="26" viewBox="0 0 72 44" fill="none">
                <path d="M36 8 C28 2,8 4,4 10 L4 38 C8 32,28 30,36 36" stroke="#3b9ce2" stroke-width="3" fill="none" stroke-linejoin="round"/>
                <path d="M36 8 C44 2,64 4,68 10 L68 38 C64 32,44 30,36 36" stroke="#3b9ce2" stroke-width="3" fill="none" stroke-linejoin="round"/>
                <path d="M36 8 L36 36" stroke="#3b9ce2" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M10 14 C18 12,28 12,35 15" stroke="#85b7eb" stroke-width="2" stroke-linecap="round" fill="none"/>
                <path d="M10 20 C18 18,28 18,35 21" stroke="#85b7eb" stroke-width="2" stroke-linecap="round" fill="none"/>
                <path d="M62 14 C54 12,44 12,37 15" stroke="#85b7eb" stroke-width="2" stroke-linecap="round" fill="none"/>
                <path d="M62 20 C54 18,44 18,37 21" stroke="#85b7eb" stroke-width="2" stroke-linecap="round" fill="none"/>
            </svg>
        </div>

        <div class="brand"><span class="me">me</span><span class="lib">library</span></div>
        <p class="tagline">Membuka Jendela Ilmu Tanpa Batas.</p>
        <div class="divider"></div>

        @if(session('error'))
            <p class="error-msg">{{ session('error') }}</p>
        @endif

        <form method="POST" action="/login" style="width:100%">
            @csrf

            <div class="field">
                <label>EMAIL</label>
                <div class="input-wrap">
                    <div class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#aac4d8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <input type="text" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" />
                </div>
            </div>

            <div class="field">
                <label>PASSWORD</label>
                <div class="input-wrap">
                    <div class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#aac4d8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <input type="password" name="password" id="pw" placeholder="Masukkan password" />
                    <button class="eye-btn" type="button" onclick="var p=document.getElementById('pw');p.type=p.type==='password'?'text':'password'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#aac4d8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="forgot"><a href="/forgot-password">Lupa password?</a></div>

            <button type="submit">Login</button>
        </form>

        <div class="or-wrap">
            <div class="or-line"></div>
            <span class="or-text">atau</span>
            <div class="or-line"></div>
        </div>

        <a href="/register" class="register-link">Belum punya akun? Daftar</a>

        <div class="badge">
            <div class="badge-dot"></div>
            <span>Aman &amp; Terenkripsi</span>
        </div>

    </div>
</div>

<script>
</script>

</body>
</html>