@extends('petugas.layouts')

@section('title', 'Edit Buku')

@section('content')

<style>
.breadcrumb {
    font-size: 14px;
    color: #888;
    margin-bottom: 15px;
}

.card-box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-grid {
    display: flex;
    gap: 30px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
}

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

.file-box img {
    width: 80px;
    margin-bottom: 10px;
    border-radius: 5px;
}

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

.form-action {
    margin-top: 20px;
    text-align: right;
}
</style>

<div class="breadcrumb">
    <strong>Edit Buku</strong>
</div>

<div class="card-box">

    <div class="title">✏️ Edit Buku</div>

    <form action="{{ route('petugas.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" id="bukuForm">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <!-- KIRI -->
            <div style="flex:1;">

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                </div>

                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required>
                </div>

                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
                </div>

            </div>

            <!-- KANAN -->
            <div style="flex:1;">

                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $buku->tahun) }}" min="0" required>
                    <small id="tahunError" style="color:red; display:none;">Tahun tidak boleh negatif</small>
                </div>

                <div class="form-group">
                    <label>Stok Buku</label>
                    <input type="number" id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required>
                    <small id="stokError" style="color:red; display:none;">Stok tidak boleh negatif</small>
                </div>

                <div class="form-group">
                    <label>Cover Buku</label>
                    <div class="file-box">

                        @if($buku->cover)
                            <img src="{{ asset('storage/'.$buku->cover) }}">
                        @endif

                        <p>📁 Ganti Cover (opsional)</p>
                        <input type="file" name="cover" accept="image/*">
                    </div>
                </div>

            </div>

        </div>

        <div class="form-action">
            <a href="{{ route('petugas.buku.index') }}">
                <button type="button" class="btn btn-cancel">Batal</button>
            </a>
            <button type="submit" class="btn btn-save">Update Buku</button>
        </div>

    </form>

</div>

<script>
const stokInput = document.getElementById('stok');
const tahunInput = document.getElementById('tahun');
const stokError = document.getElementById('stokError');
const tahunError = document.getElementById('tahunError');

function validateInput(input, errorElem){
    if(parseInt(input.value) < 0){
        errorElem.style.display = 'block';
        input.value = 0;
    } else {
        errorElem.style.display = 'none';
    }
}

stokInput.addEventListener('input', () => validateInput(stokInput, stokError));
tahunInput.addEventListener('input', () => validateInput(tahunInput, tahunError));

document.getElementById('bukuForm').addEventListener('submit', function(e){
    if(parseInt(stokInput.value) < 0){
        alert('Stok tidak boleh negatif!');
        e.preventDefault();
    }
    if(parseInt(tahunInput.value) < 0){
        alert('Tahun tidak boleh negatif!');
        e.preventDefault();
    }
});
</script>

@endsection