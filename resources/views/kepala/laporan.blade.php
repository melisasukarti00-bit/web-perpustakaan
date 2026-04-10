@extends('kepala.layouts')

@section('title', 'Laporan Peminjaman')

@section('content')

<h2 class="title" style="color:#4da3ff; margin-bottom:20px;">📊 Laporan Peminjaman</h2>

<div class="table-box" style="background:white; padding:25px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1); overflow-x:auto;">

    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:#eef3f8;">
            <tr>
                <th style="padding:10px; border-bottom:2px solid #ddd;">No</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Judul Buku</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Peminjam</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Tanggal Pinjam</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Jatuh Tempo</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Tanggal Kembali</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Denda</th>
                <th style="padding:10px; border-bottom:2px solid #ddd;">Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($laporan as $item)
            <tr>
                <td style="padding:8px;">{{ $loop->iteration }}</td>
                <td style="padding:8px;">{{ $item->buku->judul ?? $item->judul ?? '-' }}</td>
                <td style="padding:8px;">{{ $item->user->name ?? '-' }}</td>
                <td style="padding:8px;">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                <td style="padding:8px;">{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}</td>
                <td style="padding:8px;">
                    {{ $item->tanggal_kembali 
                        ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') 
                        : '-' }}
                </td>
                <td style="padding:8px;">
                    {{ $item->denda > 0 
                        ? 'Rp ' . number_format($item->denda, 0, ',', '.') 
                        : '-' }}
                </td>
                <td style="padding:8px;">
                    @if($item->status == 'pending')
                        <span class="badge" style="background:gray;">Menunggu</span>
                    @elseif($item->status == 'approved' && !$item->tanggal_kembali)
                        <span class="badge" style="background:#f39c12;">Dipinjam</span>
                    @elseif($item->status == 'selesai')
                        <span class="badge" style="background:#2ecc71;">Sudah Kembali</span>
                    @else
                        <span class="badge" style="background:#999;">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; color:gray; padding:10px;">
                    Belum ada data peminjaman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection