<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Melibrary</title>

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
        background: #f5f7fa;
    }

    .container {
        text-align: center;
    }

    .logo {
        position: absolute;
        top: 20px;
        left: 30px;
        font-weight: bold;
        font-size: 18px;
        color: #000000;
    }

    .logo span{
        color: #4a90e2;
        
    }

    .card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        width: 320px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
    }

  
    .logo-navbar {
        display: block;
        margin: 0 auto 15px auto;
        width: 120px;
    }

    .card h2 {
        margin-bottom: 10px;
    }

    .card p {
        font-size: 12px;
        color: #777;
        margin-bottom: 20px;
    }

    .input-group {
        text-align: left;
        margin-bottom: 15px;
    }

    .input-group label {
        font-size: 12px;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-top: 5px;
    }

    .options {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background: #4a90e2;
        color: white;
        cursor: pointer;
    }

    .btn:hover {
        background: #357abd;
    }
</style>
</head>

<body>

<div class="logo">me<span>library</span></div>

<div class="container">
    <div class="card">
       <img src="{{ asset('img/logo.png') }}" class="logo-navbar">

        <h2>Login</h2>
        <p>Enter your email/username and password</p>

        <div class="input-group">
            <label>Email</label>
            <input type="text" placeholder="Enter your email">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" placeholder="Enter your password">
        </div>

        <div class="options">
            <label><input type="checkbox"> Keep me logged in</label>
            <a href="#">Forgot passwoard?</a>
        </div>

        <button class="btn">Sign in</button>
    </div>
</div>

</body>
</html>