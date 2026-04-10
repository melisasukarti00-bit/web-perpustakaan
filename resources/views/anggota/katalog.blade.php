@extends('anggota.layouts')

@section('title', 'Katalog Buku')

@section('content')

<style>
.katalog-title {
    margin-bottom: 20px;
    color: #4ea8de;
}

/* GRID */
.katalog {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

/* CARD */
.buku-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.buku-card:hover {
    transform: translateY(-5px);
}

.buku-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.buku-body {
    padding: 15px;
}

.buku-judul {
    font-weight: bold;
}

.buku-penulis {
    font-size: 13px;
    color: gray;
    margin-bottom: 10px;
}

/* BUTTON */
.btn-pinjam {
    display: block;
    width: 100%;
    text-align: center;
    background: #4ea8de;
    color: white;
    padding: 8px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.btn-pinjam:hover {
    background: #3b95c9;
}

.btn-disabled {
    background: gray;
    cursor: not-allowed;
}
</style>

<h2 class="katalog-title">📚 Katalog Buku</h2>

{{-- SEARCH FORM --}}
<form action="{{ route('anggota.katalog') }}" method="GET" style="margin-bottom: 20px;">
    <div style="display: flex; gap: 10px;">
        <input 
            type="text" 
            name="search" 
            placeholder="Cari buku berdasarkan judul, pengarang, penerbit, atau tahun..." 
            value="{{ $search ?? '' }}"
            style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;"
        >
        <button 
            type="submit" 
            style="padding: 10px 20px; background: #4ea8de; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;"
        >
            🔍 Cari
        </button>
        <a 
            href="{{ route('anggota.katalog') }}" 
            style="padding: 10px 20px; background: #999; color: white; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: bold;"
        >
            ↺ Reset
        </a>
    </div>
</form>

{{-- SEARCH INFO --}}
@if($search)
    <p style="color: #666; margin-bottom: 15px; font-size: 14px;">
        Hasil pencarian untuk: <strong>"{{ $search }}"</strong> ({{ $buku->count() }} buku ditemukan)
    </p>
@endif

<div class="katalog">

@forelse($buku as $b)
<div class="buku-card">

    {{-- COVER --}}
    @if($b->cover)
        <img src="{{ asset('storage/'.$b->cover) }}" class="buku-img">
    @else
        <img src="https://via.placeholder.com/200x180" class="buku-img">
    @endif

    <div class="buku-body">
    <div class="buku-judul">{{ $b->judul }}</div>
    <div class="buku-penulis">Penulis: {{ $b->pengarang }}</div>

    {{-- Tambahkan ini --}}
    @if($b->stok > 0)
        <form action="{{ route('anggota.pinjam', $b->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-pinjam">📖 Pinjam</button>
        </form>
    @else
        <button class="btn-pinjam btn-disabled" disabled>Stok Habis</button>
    @endif
</div>

</div>
@empty
<div style="text-align: center; padding: 40px; color: #999;">
    @if($search)
        <p style="font-size: 16px;">🔍 Tidak ada buku yang cocok dengan pencarian "<strong>{{ $search }}</strong>"</p>
        <p style="font-size: 14px; margin-top: 10px;">
            <a href="{{ route('anggota.katalog') }}" style="color: #4ea8de; text-decoration: none;">Kembali ke katalog lengkap</a>
        </p>
    @else
        <p style="font-size: 16px;">📚 Tidak ada buku tersedia</p>
    @endif
</div>
@endforelse

</div>

@endsection