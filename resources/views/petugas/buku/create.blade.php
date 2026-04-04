@extends('petugas.layouts')

@section('title', 'Tambah Buku')

@section('content')

<style>
/* BREADCRUMB */
.breadcrumb {
    font-size: 14px;
    color: #888;
    margin-bottom: 15px;
}

/* CARD */
.card-box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* TITLE */
.title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* GRID */
.form-grid {
    display: flex;
    gap: 30px;
}

/* FORM */
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

/* INPUT */
input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
}

input:focus {
    border-color: #4da3ff;
    box-shadow: 0 0 5px rgba(77,163,255,0.3);
}

/* FILE */
.file-box {
    border: 2px dashed #ccc;
    padding: 15px;
    text-align: center;
    border-radius: 10px;
}

.file-box:hover {
    border-color: #4da3ff;
    background: #f9fbff;
}

/* BUTTON */
.btn {
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.btn-cancel {
    background: #ddd;
}

.btn-save {
    background: #4da3ff;
    color: white;
}

.btn-save:hover {
    background: #3b8eea;
}

/* ACTION */
.form-action {
    margin-top: 20px;
    text-align: right;
}
</style>

<!-- BREADCRUMB -->
<div class="breadcrumb">
    <strong>Tambah Buku</strong>
</div>

<div class="card-box">

    <div class="title">📚 Tambah Buku</div>

    <form action="{{ route('petugas.buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <!-- KIRI -->
            <div style="flex:1;">

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul') }}">
                    @error('judul')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="{{ old('pengarang') }}">
                    @error('pengarang')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit') }}">
                    @error('penerbit')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <!-- KANAN -->
            <div style="flex:1;">

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}">
                    @error('tahun')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Stok Buku</label>
                    <input type="number" name="stok" value="{{ old('stok') }}">
                    @error('stok')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Cover Buku</label>
                    <div class="file-box">
                        <p>📁 Upload Cover (JPG/PNG max 2MB)</p>
                        <input type="file" name="cover" accept="image/*">
                    </div>
                    @error('cover')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>

            </div>

        </div>

        <div class="form-action">
            <button type="reset" class="btn btn-cancel">Batal</button>
            <button type="submit" class="btn btn-save">Simpan Buku</button>
        </div>

    </form>

</div>

@endsection