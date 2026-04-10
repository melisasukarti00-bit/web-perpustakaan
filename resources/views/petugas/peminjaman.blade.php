@extends('petugas.layouts')

@section('title', 'Manajemen Peminjaman')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600&display=swap');

* { box-sizing: border-box; }

.page-wrap { font-family: 'Sora', sans-serif; padding: 28px 0; }

.page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; }
.page-header-left h1 { font-size: 22px; font-weight: 600; color: #1a1a2e; margin: 0 0 4px; }
.page-header-left p { font-size: 13px; color: #8a8fa8; margin: 0; }

.badge-count { background: #e6f2fb; color: #185FA5; border: 1px solid #b5d4f4; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 500; }

.alert-success { background: #d4f5e5; color: #1a7a4a; border: 1px solid #a3e4c5; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; }

.table-card { background: #fff; border-radius: 16px; border: 1px solid #e8eaf2; overflow: hidden; }

table { width: 100%; border-collapse: collapse; }
th { background: #f6f8ff; padding: 12px; font-size: 12px; text-align: left; color: #888; font-weight: 600; }
td { padding: 12px; border-bottom: 1px solid #eee; font-size: 13px; vertical-align: middle; }

.status { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; }
.pending  { background: #fff4e0; color: #b36a00; }
.approved { background: #e0f5ea; color: #1a7a4a; }
.kembali  { background: #e3f2ff; color: #1c6ed5; }
.selesai  { background: #eafaf1; color: #1a7a42; }

.btn-konfirmasi {
    background: #185FA5;
    color: white;
    border: none;
    padding: 7px 14px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Sora', sans-serif;
    white-space: nowrap;
}
.btn-konfirmasi:hover { background: #0c447c; }

.denda { color: #e24b4a; font-size: 12px; font-weight: 600; }
</style>

<div class="page-wrap">

    <div class="page-header">
        <div class="page-header-left">
            <h1>Manajemen Peminjaman</h1>
            <p>Konfirmasi peminjaman & pengembalian buku</p>
        </div>
        <span class="badge-count">{{ $peminjaman->count() }} data</span>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="background: #fee; color: #c33; border: 1px solid #fcc; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Judul</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($peminjaman as $p)
                <tr>
                    <td>{{ $p->user->name ?? '-' }}</td>
                    <td>{{ $p->judul ?? $p->buku->judul ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                    <td style="{{ \Carbon\Carbon::parse($p->jatuh_tempo)->isPast() && $p->status != 'selesai' ? 'color:#e24b4a; font-weight:600;' : '' }}">
                        {{ \Carbon\Carbon::parse($p->jatuh_tempo)->format('d M Y') }}
                    </td>

                    <td>
                        @if($p->status == 'pending')
                            <span class="status pending">Menunggu Pinjam</span>
                        @elseif($p->status == 'approved')
                            <span class="status approved">Dipinjam</span>
                        @elseif($p->status == 'dikembalikan')
                            <span class="status kembali">Menunggu Pengembalian</span>
                        @elseif($p->status == 'selesai')
                            <span class="status selesai">Selesai</span>
                        @else
                            <span class="status pending">{{ ucfirst($p->status) }}</span>
                        @endif
                    </td>

                    <td>
                        @if($p->denda > 0)
                            <span class="denda">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
                        @else
                            Rp 0
                        @endif
                    </td>

                   {{-- AKSI --}}
<td>
    @if($p->status == 'pending')
        <form method="POST" action="{{ route('petugas.peminjaman.konfirmasi', $p->id) }}">
            @csrf
            <button type="submit" class="btn-konfirmasi">Konfirmasi Pinjam</button>
        </form>
    @elseif($p->status == 'dikembalikan')
        <form method="POST" action="{{ route('petugas.peminjaman.kembali', $p->id) }}">
            @csrf
            <button type="submit" class="btn-konfirmasi">Konfirmasi Pengembalian</button>
        </form>
    @else
        <span style="color:#aaa; font-size:12px;">Selesai</span>
    @endif
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:30px; color:#aaa;">
                        Tidak ada data peminjaman
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection