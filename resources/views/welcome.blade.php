<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Melibrary</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

:root {
    --navy:     #0d1b2a;
    --blue:     #4a90e2;
    --blue-lt:  #e8f2fc;
    --blue-mid: #7ab8f5;
    --white:    #ffffff;
}

html, body { height: 100%; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--navy);
    color: #fff;
    overflow: hidden;
}

/* ── Layout ── */
.layout {
    height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

/* ════════════════════════════
   LEFT
════════════════════════════ */
.left {
    position: relative;
    display: flex;
    flex-direction: column;
    padding: 44px 52px;
    overflow: hidden;
    z-index: 1;
}

/* Background decoration */
.bg-dots {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(74,144,226,0.12) 1px, transparent 1px);
    background-size: 32px 32px;
    opacity: 0.4;
    pointer-events: none;
}
.bg-c1 {
    position: absolute;
    width: 520px; height: 520px;
    border-radius: 50%;
    border: 1px solid rgba(74,144,226,0.08);
    top: -160px; left: -140px;
    pointer-events: none;
}
.bg-c2 {
    position: absolute;
    width: 380px; height: 380px;
    border-radius: 50%;
    border: 1px solid rgba(74,144,226,0.06);
    top: -60px; left: -60px;
    pointer-events: none;
}
.bg-c3 {
    position: absolute;
    width: 600px; height: 600px;
    border-radius: 50%;
    border: 0.5px solid rgba(74,144,226,0.05);
    bottom: -280px; right: -220px;
    pointer-events: none;
}
.bg-glow {
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(74,144,226,0.06);
    bottom: -100px; right: -100px;
    filter: blur(60px);
    pointer-events: none;
}
.bg-glow2 {
    position: absolute;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(74,144,226,0.04);
    top: 40px; left: 0;
    filter: blur(40px);
    pointer-events: none;
}
.bg-book {
    position: absolute;
    bottom: 0; right: 0;
    opacity: 0.04;
    pointer-events: none;
}

/* Nav */
.nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 2;
}
.wordmark {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    letter-spacing: -0.3px;
}
.wordmark em { font-style: normal; color: var(--blue); }

.nav-pill {
    background: rgba(74,144,226,0.1);
    border: 0.5px solid rgba(74,144,226,0.2);
    border-radius: 100px;
    padding: 5px 14px;
    font-size: 11px;
    font-weight: 500;
    color: var(--blue-mid);
    letter-spacing: 0.06em;
}

/* Hero */
.hero {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 32px 0;
    position: relative;
    z-index: 2;
}

.eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
}
.eyebrow-line {
    width: 20px; height: 1px;
    background: var(--blue);
    opacity: 0.6;
}
.eyebrow-text {
    font-size: 10.5px;
    font-weight: 500;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--blue);
    opacity: 0.85;
}

.headline {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(50px, 5.8vw, 76px);
    font-weight: 300;
    line-height: 0.96;
    letter-spacing: -0.025em;
    color: #fff;
}
.headline-em {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(50px, 5.8vw, 76px);
    font-weight: 300;
    font-style: italic;
    line-height: 0.96;
    letter-spacing: -0.025em;
    color: var(--blue);
}
.headline-dim {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(50px, 5.8vw, 76px);
    font-weight: 300;
    line-height: 0.96;
    letter-spacing: -0.025em;
    color: rgba(255,255,255,0.2);
    margin-bottom: 32px;
}

.desc {
    font-size: 13px;
    font-weight: 300;
    color: rgba(255,255,255,0.42);
    line-height: 1.85;
    max-width: 230px;
    margin-bottom: 40px;
}

/* Stats */
.stats {
    display: flex;
    align-items: stretch;
}
.stat {
    display: flex;
    flex-direction: column;
    gap: 4px;
    padding: 16px 24px;
    background: rgba(255,255,255,0.03);
    border: 0.5px solid rgba(255,255,255,0.07);
}
.stat:first-child { border-radius: 12px 0 0 12px; }
.stat:last-child  { border-radius: 0 12px 12px 0; }
.stat + .stat { border-left: none; }

.stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    font-weight: 600;
    color: #fff;
    line-height: 1;
}
.stat-num span { color: var(--blue); }
.stat-label {
    font-size: 10.5px;
    color: rgba(255,255,255,0.3);
    font-weight: 400;
    white-space: nowrap;
}

/* ════════════════════════════
   RIGHT
════════════════════════════ */
.right {
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.r-arc1 {
    position: absolute;
    width: 500px; height: 500px;
    border-radius: 50%;
    border: 1px solid rgba(13,27,42,0.05);
    top: -200px; right: -200px;
    pointer-events: none;
}
.r-arc2 {
    position: absolute;
    width: 360px; height: 360px;
    border-radius: 50%;
    border: 1px solid rgba(13,27,42,0.04);
    top: -130px; right: -130px;
    pointer-events: none;
}
.r-fill {
    position: absolute;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: #ddeef9;
    opacity: 0.35;
    top: -100px; right: -80px;
    pointer-events: none;
}
.r-blob {
    position: absolute;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: #ddeef9;
    opacity: 0.25;
    bottom: -80px; left: -60px;
    pointer-events: none;
}

.right-inner {
    width: 100%;
    max-width: 320px;
    padding: 0 8px;
    position: relative;
    z-index: 2;
}

.r-tag-row {
    display: flex;
    align-items: center;
    margin-bottom: 36px;
}
.r-tag {
    font-size: 10.5px;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #b0c8e0;
    white-space: nowrap;
}
.r-tag-line {
    flex: 1;
    height: 0.5px;
    background: rgba(74,144,226,0.12);
    margin-left: 14px;
}

.book-icon { margin-bottom: 24px; display: block; }

.cta-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 40px;
    font-weight: 300;
    line-height: 1.12;
    color: #0d1b2a;
    margin-bottom: 10px;
}
.cta-title em { font-style: italic; color: var(--blue); }

.cta-sub {
    font-size: 12.5px;
    font-weight: 300;
    color: #8aabca;
    line-height: 1.75;
    margin-bottom: 32px;
}

.separator {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}
.sep-line { flex: 1; height: 0.5px; background: rgba(74,144,226,0.1); }
.sep-text { font-size: 10.5px; color: #b0c8e0; font-weight: 400; }

.btn-group { display: flex; flex-direction: column; gap: 10px; }

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 14px 20px;
    border-radius: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    border: none;
    position: relative;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.btn-arrow {
    position: absolute;
    right: 18px;
    opacity: 0.5;
    font-size: 16px;
}

.btn-login {
    background: #0d1b2a;
    color: #fff;
}
.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(13,27,42,0.22);
}

.btn-register {
    background: transparent;
    color: #1a2d42;
    border: 0.5px solid rgba(13,27,42,0.14);
}
.btn-register:hover {
    background: #f5f9fd;
    transform: translateY(-1px);
}

.right-foot {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 28px;
}
.foot-copy { font-size: 10.5px; color: #c0d4e4; }
.foot-dots { display: flex; align-items: center; gap: 5px; }
.foot-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: var(--blue);
    opacity: 0.3;
}
.foot-dot:first-child { opacity: 0.7; }
.foot-dot:nth-child(2) { opacity: 0.5; }

/* ── Responsive ── */
@media (max-width: 720px) {
    body { overflow-y: auto; }
    .layout { grid-template-columns: 1fr; height: auto; }
    .left  { padding: 36px 24px; min-height: 46vh; }
    .right { padding: 40px 24px; min-height: 54vh; }
    .headline, .headline-em, .headline-dim { font-size: 44px; }
}
</style>
</head>
<body>

<div class="layout">

    <!-- LEFT -->
    <div class="left">
        <div class="bg-dots"></div>
        <div class="bg-c1"></div>
        <div class="bg-c2"></div>
        <div class="bg-c3"></div>
        <div class="bg-glow"></div>
        <div class="bg-glow2"></div>

        <!-- Decorative book watermark -->
        <svg class="bg-book" width="260" height="200" viewBox="0 0 260 200" fill="none">
            <path d="M130 30C110 10 40 5 5 15V185C40 175 110 180 130 195V30Z" fill="#4a90e2"/>
            <path d="M130 30C150 10 220 5 255 15V185C220 175 150 180 130 195V30Z" fill="#4a90e2"/>
            <path d="M130 30V195" stroke="#fff" stroke-width="2" opacity="0.5"/>
            <path d="M30 55C55 50 90 52 115 60"  stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
            <path d="M30 80C55 75 90 77 115 85"  stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
            <path d="M30 105C55 100 90 102 115 110" stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
            <path d="M145 60C170 52 205 50 230 55"  stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
            <path d="M145 85C170 77 205 75 230 80"  stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
            <path d="M145 110C170 102 205 100 230 105" stroke="#fff" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
        </svg>

        <div class="nav">
            <div class="wordmark">me<em>library</em></div>
            <div class="nav-pill">v2.0</div>
        </div>

        <div class="hero">
            <div class="eyebrow">
                <div class="eyebrow-line"></div>
                <span class="eyebrow-text">Perpustakaan Digital</span>
            </div>

            <div class="headline">Membuka</div>
            <div class="headline-em">Jendela</div>
            <div class="headline-dim">Ilmu Tanpa Batas</div>

            <p class="desc">Temukan, pinjam, dan nikmati ribuan koleksi buku kapan saja dan di mana saja.</p>

            <div class="stats">
                <div class="stat">
                    <span class="stat-num">10<span>K+</span></span>
                    <span class="stat-label">Koleksi buku</span>
                </div>
                <div class="stat">
                    <span class="stat-num">Gratis</span>
                </div>
                <div class="stat">
                    <span class="stat-num">24<span>/7</span></span>
                    <span class="stat-label">Akses katalog</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right">
        <div class="r-arc1"></div>
        <div class="r-arc2"></div>
        <div class="r-fill"></div>
        <div class="r-blob"></div>

        <div class="right-inner">
            <div class="r-tag-row">
                <span class="r-tag">Masuk ke sistem</span>
                <div class="r-tag-line"></div>
            </div>

            <svg class="book-icon" width="58" height="46" viewBox="0 0 58 46" fill="none">
                <path d="M29 8C24 4 10 3 2 5V41C10 39 24 40 29 44V8Z" fill="#e8f2fc" stroke="#4a90e2" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M29 8C34 4 48 3 56 5V41C48 39 34 40 29 44V8Z" fill="#e8f2fc" stroke="#4a90e2" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M29 8V44" stroke="#4a90e2" stroke-width="1" stroke-opacity="0.3"/>
                <path d="M9 14C14 13 21 13.5 26 15"  stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.5"/>
                <path d="M9 20C14 19 21 19.5 26 21"  stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.5"/>
                <path d="M9 26C14 25 21 25.5 26 27"  stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.35"/>
                <path d="M32 15C37 13.5 44 13 49 14" stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.5"/>
                <path d="M32 21C37 19.5 44 19 49 20" stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.5"/>
                <path d="M32 27C37 25.5 44 25 49 26" stroke="#4a90e2" stroke-width="1.2" stroke-linecap="round" stroke-opacity="0.35"/>
                <ellipse cx="29" cy="44" rx="14" ry="2.5" fill="#4a90e2" opacity="0.07"/>
            </svg>

            <div class="cta-title">Selamat <em>datang</em><br>kembali.</div>
            <p class="cta-sub">Pilih cara Anda untuk mengakses perpustakaan digital kami.</p>

            <div class="separator">
                <div class="sep-line"></div>
                <span class="sep-text">akses akun</span>
                <div class="sep-line"></div>
            </div>

            <div class="btn-group">
                <a href="{{ route('login') }}" class="btn btn-login">
                    Login
                    <span class="btn-arrow">→</span>
                </a>
                <a href="{{ route('register') }}" class="btn btn-register">
                    Daftar Akun Baru
                    <span class="btn-arrow" style="opacity:0.25">→</span>
                </a>
            </div>

            <div class="right-foot">
                <span class="foot-copy">© 2025 melibrary</span>
                <div class="foot-dots">
                    <div class="foot-dot"></div>
                    <div class="foot-dot"></div>
                    <div class="foot-dot"></div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>