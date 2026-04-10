@extends('kepala.layouts') 

@section('title', 'Data Buku')

@section('content')


<!-- CARD TOTAL COMPACT -->
<div class="cards" style="display:flex; gap:20px; margin-bottom:20px; flex-wrap: wrap;">
    <div class="card-box" style="flex:1 1 150px; padding:15px; background: #4da3ff; color:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); display:flex; align-items:center; justify-content: space-between; font-size:14px;">
        <div>
            <div style="font-weight:500;">Total Buku</div>
            <div style="font-size:24px; font-weight:bold; margin-top:5px;">{{ $buku->count() }}</div>
        </div>
        <div style="font-size:24px; opacity:0.3;">📚</div>
    </div>
</div>

<!-- TABLE BUKU -->
<div class="table-box" style="background:#fff; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">
    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:#007bff; color:#fff;">
            <tr>
                <th style="padding:12px; text-align:left;">No</th>
                <th style="padding:12px; text-align:left;">Judul Buku</th>
                <th style="padding:12px; text-align:left;">Pengarang</th>
                <th style="padding:12px; text-align:left;">Penerbit</th>
                <th style="padding:12px; text-align:left;">Tahun Terbit</th>
                <th style="padding:12px; text-align:left;">Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($buku as $index => $b)
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:12px;">{{ $index + 1 }}</td>
                <td style="padding:12px;">{{ $b->judul }}</td>
                <td style="padding:12px;">{{ $b->pengarang }}</td>
                <td style="padding:12px;">{{ $b->penerbit }}</td>
                <td style="padding:12px;">{{ $b->tahun }}</td>
                <td style="padding:12px;">{{ $b->stok }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:20px;">Tidak ada data buku</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection