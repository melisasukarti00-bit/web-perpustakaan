@extends('petugas.layouts')

@section('title', 'Edit Buku')

@section('content')

<style>
.card {
  background: white;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
  margin-top: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
}

.form-group input:focus {
  border-color: #4da3ff;
  outline: none;
}

/* FILE */
.cover-box {
  border: 2px dashed #ccc;
  padding: 15px;
  border-radius: 10px;
  text-align: center;
}

.cover-box img {
  width: 80px;
  margin-bottom: 10px;
  border-radius: 5px;
}

/* BUTTON */
.actions {
  margin-top: 20px;
  text-align: right;
}

.btn-cancel {
  background: #ccc;
  border: none;
  padding: 8px 15px;
  margin-right: 10px;
  border-radius: 8px;
  cursor: pointer;
}

.btn-save {
  background: #4da3ff;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 8px;
  cursor: pointer;
}

.btn-save:hover {
  background: #3b8eea;
}
</style>

<div class="card">
  <h3>Edit Buku</h3>

  <form action="{{ route('petugas.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-grid">

      <div class="form-group">
        <label>Judul Buku</label>
        <input type="text" name="judul" value="{{ $buku->judul }}">
      </div>

      <div class="form-group">
        <label>Stok Buku</label>
        <input type="number" name="stok" value="{{ $buku->stok }}">
      </div>

      <div class="form-group">
        <label>Pengarang</label>
        <input type="text" name="pengarang" value="{{ $buku->pengarang }}">
      </div>

      <div class="form-group">
        <label>Penerbit</label>
        <input type="text" name="penerbit" value="{{ $buku->penerbit }}">
      </div>

      <div class="form-group">
        <label>Tahun Terbit</label>
        <input type="number" name="tahun" value="{{ $buku->tahun }}">
      </div>

      <div class="form-group cover-box">
        <label>Cover Buku</label>

        @if($buku->cover)
          <img src="{{ asset('storage/'.$buku->cover) }}">
        @endif

        <input type="file" name="cover">
        <small>JPG/PNG, maks 2MB</small>
      </div>

    </div>

    <div class="actions">
      <a href="{{ route('petugas.buku.index') }}">
        <button type="button" class="btn-cancel">Batal</button>
      </a>
      <button type="submit" class="btn-save">Update Buku</button>
    </div>

  </form>
</div>

@endsection