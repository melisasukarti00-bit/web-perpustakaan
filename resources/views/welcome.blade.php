<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Melibrary</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,300&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after {
    margin: 0; padding: 0;
    box-sizing: border-box;
}

:root {
    --bg:       #ddeef9;
    --blue:     #4a90e2;
    --blue-dk:  #2f72c4;
    --blue-lt:  #eef5fd;
    --ink:      #1a2d42;
    --muted:    #7ca3c4;
    --white:    #ffffff;
}

html, body { height: 100%; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    color: var(--ink);
    overflow: hidden;
}

/* ── Layout ── */
.layout {
    height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

/* ── Left ── */
.left {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 48px 56px;
    animation: up 0.7s cubic-bezier(0.16,1,0.3,1) both;
}

.wordmark {
    font-size: 14px;
    font-weight: 600;
    color: var(--ink);
    letter-spacing: -0.2px;
}
.wordmark em { font-style: normal; color: var(--blue); }

.hero {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 32px 0;
}

.eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 20px;
}
.eyebrow::before {
    content: '';
    width: 24px; height: 1.5px;
    background: var(--blue);
    border-radius: 2px;
}

.headline {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(48px, 5.5vw, 72px);
    font-weight: 300;
    line-height: 1.02;
    letter-spacing: -0.02em;
    color: var(--ink);
    margin-bottom: 4px;
}
.headline em {
    font-style: italic;
    color: var(--blue);
}
.headline-muted {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(48px, 5.5vw, 72px);
    font-weight: 300;
    line-height: 1.02;
    letter-spacing: -0.02em;
    color: var(--muted);
    margin-bottom: 28px;
}

.desc {
    font-size: 13.5px;
    font-weight: 300;
    color: var(--muted);
    line-height: 1.75;
    max-width: 260px;
}

.stats {
    display: flex;
    align-items: center;
    gap: 28px;
}
.stat { display: flex; flex-direction: column; gap: 3px; }
.stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px;
    font-weight: 600;
    color: var(--ink);
    line-height: 1;
}
.stat-label {
    font-size: 11px;
    color: var(--muted);
    font-weight: 400;
}
.stat-line {
    width: 1px; height: 32px;
    background: rgba(74,144,226,0.2);
}

/* ── Right ── */
.right {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 48px 56px;
    background: var(--white);
    position: relative;
    overflow: hidden;
    animation: up 0.7s 0.12s cubic-bezier(0.16,1,0.3,1) both;
}

/* big decorative circle bg */
.right::before {
    content: '';
    position: absolute;
    width: 480px; height: 480px;
    border-radius: 50%;
    background: var(--bg);
    opacity: 0.55;
    top: 50%; left: 50%;
    transform: translate(-30%, -55%);
    pointer-events: none;
}

.right-inner {
    width: 100%;
    max-width: 320px;
    position: relative;
    z-index: 1;
}

.right-tag {
    font-size: 11px;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 500;
    margin-bottom: 36px;
}

.book-icon { margin-bottom: 32px; }

.cta-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 34px;
    font-weight: 300;
    line-height: 1.2;
    color: var(--ink);
    margin-bottom: 10px;
}
.cta-title em { font-style: italic; color: var(--blue); }

.cta-sub {
    font-size: 13px;
    font-weight: 300;
    color: var(--muted);
    line-height: 1.65;
    margin-bottom: 36px;
}

.btn-group { display: flex; flex-direction: column; gap: 10px; }

.btn {
    display: block; width: 100%;
    padding: 13px 20px;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-login {
    background: var(--blue);
    color: #fff;
}
.btn-login:hover {
    background: var(--blue-dk);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(74,144,226,0.28);
}

.btn-register {
    background: var(--blue-lt);
    color: var(--blue);
}
.btn-register:hover {
    background: #ddeaf8;
    transform: translateY(-1px);
}

.right-foot {
    position: absolute;
    bottom: 32px; right: 40px;
    font-size: 11px;
    color: var(--muted);
    opacity: 0.5;
}

/* ── Anim ── */
@keyframes up {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Responsive ── */
@media (max-width: 720px) {
    body { overflow-y: auto; }
    .layout { grid-template-columns: 1fr; height: auto; }
    .left { padding: 40px 28px; min-height: 48vh; border-bottom: 1px solid rgba(74,144,226,0.12); }
    .right { padding: 44px 28px; min-height: 52vh; }
    .headline, .headline-muted { font-size: 44px; }
}
</style>
</head>
<body>

<div class="layout">

    <!-- LEFT -->
    <div class="left">
        <div class="wordmark">me<em>library</em></div>

        <div class="hero">
            <div class="eyebrow">Sistem Perpustakaan Digital</div>
            <div class="headline">Membuka</div>
            <div class="headline"><em>Jendela</em></div>
            <div class="headline-muted">Ilmu Tanpa Batas</div>
            <p class="desc">Platform manajemen perpustakaan modern — untuk anggota, petugas, dan kepala perpustakaan.</p>
        </div>

        <div class="stats">
            <div class="stat">
                <span class="stat-num">10K+</span>
                <span class="stat-label">Koleksi buku</span>
            </div>
            <div class="stat-line"></div>
            <div class="stat">
                <span class="stat-num">3</span>
                <span class="stat-label">Tingkat akses</span>
            </div>
            <div class="stat-line"></div>
            <div class="stat">
                <span class="stat-num">24/7</span>
                <span class="stat-label">Akses katalog</span>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="right-inner">
            <div class="right-tag">Masuk ke sistem</div>

            <div class="book-icon">
                <svg width="52" height="40" viewBox="0 0 52 40" fill="none">
                    <path d="M26 7C21 3 9 2 2 4V36C9 34 21 35 26 39V7Z"
                          fill="#ddeef9" stroke="#4a90e2" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M26 7C31 3 43 2 50 4V36C43 34 31 35 26 39V7Z"
                          fill="#ddeef9" stroke="#4a90e2" stroke-width="1.5" stroke-linejoin="round"/>
                    <path d="M26 7V39" stroke="#4a90e2" stroke-width="1" stroke-opacity="0.35"/>
                    <path d="M8 12C13 11 19 11.5 23 13"  stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                    <path d="M8 17C13 16 19 16.5 23 18"  stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                    <path d="M8 22C13 21 19 21.5 23 23"  stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                    <path d="M29 13C33 11.5 39 11 44 12" stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                    <path d="M29 18C33 16.5 39 16 44 17" stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                    <path d="M29 23C33 21.5 39 21 44 22" stroke="#4a90e2" stroke-width="1" stroke-linecap="round" stroke-opacity="0.45"/>
                </svg>
            </div>

            <div class="cta-title">Selamat <em>datang</em><br>kembali.</div>
            <p class="cta-sub">Pilih cara Anda untuk mengakses perpustakaan digital kami.</p>

            <div class="btn-group">
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn btn-register">Daftar Akun Baru</a>
            </div>
        </div>

        <div class="right-foot">© 2025 melibrary</div>
    </div>

</div>

</body>
</html>