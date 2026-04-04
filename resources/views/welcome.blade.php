<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Melibrary</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to right, #cde7f4, #f5f7fa);
}

/* Logo kiri atas */
.logo {
    position: absolute;
    top: 20px;
    left: 30px;
    font-weight: bold;
    font-size: 18px;
}

.logo span {
    color: #4a90e2;
}

/* Card utama */
.card {
    background: #fff;
    padding: 35px 30px;
    border-radius: 16px;
    width: 320px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}


.icon {
    font-size: 40px;
    margin-bottom: 5px; 
} 

.title {
    font-size: 20px;
    font-weight: bold;
    margin-top: -5px;  
    margin-bottom: 3px;
}

.title span {
    color: #4a90e2;
}


.subtitle {
    font-size: 12px;
    color: #777;
    margin-top: 0;
    margin-bottom: 20px;
}

/* Tombol utama */
.btn-primary {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(to right, #4a90e2, #5aa9f0);
    color: white;
    cursor: pointer;
    margin-bottom: 10px;
}

/* Tombol kedua */
.btn-outline {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: white;
    color: #4a90e2;
    cursor: pointer;
}

.btn-primary:hover {
    opacity: 0.9;
}

.btn-outline:hover {
    background: #f5f7fa;
}
</style>
</head>

<body>

<!-- Logo kiri atas -->
<div class="logo">me<span>library</span></div>

<!-- Card tengah -->
<div class="card">
    <div class="icon"> <img src="{{ asset('img/logo.png') }}">

    <div class="title">me<span>library</span></div>
    <div class="subtitle">Membuka Jendela Ilmu Tanpa Batas.</div>

    <button class="btn-primary">Login</button>
    <button class="btn-outline">Register</button>
</div>

</body>
</html>