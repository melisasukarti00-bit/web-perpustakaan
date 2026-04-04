@extends('petugas.layouts')

@section('title', 'Profil')

@section('content')

<style>
.container-profile {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

/* CARD */
.profile-card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 420px;
    text-align: center;
}

/* HEADER */
.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.profile-header h3 {
    margin: 5px 0;
    font-weight: 600;
}

.badge {
    display: inline-block;
    background: linear-gradient(to right, #4da3ff, #2f80ed);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    margin-bottom: 20px;
}

/* INPUT STYLE */
.form-group {
    margin-bottom: 12px;
    text-align: left;
}

.input-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 25px;
    padding: 10px 15px;
    font-size: 14px;
}

.input-box span {
    color: #777;
}

.input-box input {
    border: none;
    outline: none;
    text-align: right;
    width: 60%;
}

/* BUTTON */
.btn-primary {
    width: 100%;
    background: linear-gradient(to right, #4da3ff, #2f80ed);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 25px;
    margin-top: 10px;
    cursor: pointer;
}

.btn-secondary {
    width: 100%;
    background: #f1f1f1;
    color: #555;
    border: none;
    padding: 12px;
    border-radius: 25px;
    margin-top: 10px;
    cursor: pointer;
}

.btn-primary:hover {
    opacity: 0.9;
}

.btn-secondary:hover {
    background: #e2e2e2;
}
</style>

<div class="container-profile">

    <div class="profile-card">

        <div class="profile-header">
            <img src="https://via.placeholder.com/100">
            <h3>Dwi Oktapiani</h3>
            <div class="badge">Petugas</div>
        </div>

        <form>

            <div class="form-group">
                <div class="input-box">
                    <span>Email</span>
                    <input type="email" value="dwioktapiani@gmail.com">
                </div>
            </div>

            <div class="form-group">
                <div class="input-box">
                    <span>No Telepon</span>
                    <input type="text" value="0831-7988-6543">
                </div>
            </div>

            <div class="form-group">
                <div class="input-box">
                    <span>NIP</span>
                    <input type="text" value="2026104">
                </div>
            </div>

            <button type="submit" class="btn-primary">Ubah Password</button>
            <button type="button" class="btn-secondary">Log out</button>

        </form>

    </div>

</div>

@endsection