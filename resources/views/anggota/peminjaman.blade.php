@extends('anggota.layouts')
@section('title', 'Peminjaman Buku')
@section('content')

<style>
.pem-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}
.pem-title { font-size: 22px; font-weight: bold; color: #1a1a2e; margin: 0; }
.pem-subtitle { font-size: 13px; color: #888; margin: 4px 0 0; }

.pem-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    overflow: hidden;
}

.pem-table { width: 100%; border-collapse: collapse; }

.pem-table th {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #888;
    padding: 13px 16px;
    text-align: left;
    background: #f7f9fc;
    border-bottom: 1px solid #eee;
}

.pem-table td {
    padding: 14px 16px;
    font-size: 13px;
    color: #333;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
}

.pem-table tr:last-child td { border-bottom: none; }
.pem-table tr:hover td { background: #fafbfc; }

.badge-pinjam {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fff8ec;
    color: #b06000;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 11px;
    border-radius: 20px;
    border: 1px solid #fde3a0;
}

.badge-approved {
    background: #e3f2ff;
    color: #1c6ed5;
    border: 1px solid #b6daff;
}

.badge-selesai {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #eafaf1;
    color: #1a7a42;
    font-size: 11px;
    font-weight: 600;
    padding: 5px 11px;
    border-radius: 20px;
    border: 1px solid #a3d9b1;
}

.dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}
.dot-amber { background: #e67e22; }
.dot-blue { background: #3498db; }
.dot-green { background: #27ae60; }

.btn-kembalikan {
    background: #4da3ff;
    color: white;
    border: none;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
}
.btn-kembalikan:hover { background: #3b8eea; }

.btn-done {
    display: inline-block;
    background: #f0f0f0;
    color: #aaa;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
}

.denda-merah { color: #c0392b; font-weight: 600; }

.alert-success {
    background: #eafaf1;
    color: #1a6e3c;
    border: 1px solid #a3d9b1;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 16px;
    font-size: 14px;
}

.no-data {
    text-align: center;
    padding: 3rem;
    color: #aaa;
    font-size: 14px;
}
</style>

<div class="pem-header">
    <div>
        <h2 class="pem-title">📚 Riwayat Peminjaman</h2>
        <p class="pem-subtitle">Semua aktivitas peminjaman buku kamu</p>
    </div>
</div>

@if(session('success'))
    <div class="alert-success">✓ {{ session('success') }}</div>
@endif

<div class="pem-card">
    <table class="pem-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr>
                <td style="color:#aaa;">{{ $loop->iteration }}</td>
                <td style="font-weight:600;">{{ $item->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}</td>

                {{-- STATUS --}}
                <td>
                    @if ($item->status == 'pending')
                        <span class="badge-pinjam">
                            <span class="dot dot-amber"></span> Menunggu
                        </span>

                    @elseif ($item->status == 'approved')
                        <span class="badge-pinjam badge-approved">
                            <span class="dot dot-blue"></span> Dipinjam
                        </span>

                    @elseif ($item->status == 'selesai')
                        <span class="badge-selesai">
                            <span class="dot dot-green"></span> Selesai
                        </span>

                    @else
                        <span class="badge-pinjam">
                            <span class="dot dot-amber"></span> {{ ucfirst($item->status) }}
                        </span>
                    @endif
                </td>

                {{-- DENDA --}}
                <td>
                    @if($item->denda > 0)
                        <span class="denda-merah">
                            Rp {{ number_format($item->denda, 0, ',', '.') }}
                        </span>
                    @else
                        <span style="color:#aaa;">Rp 0</span>
                    @endif
                </td>

                {{-- AKSI --}}
                <td>
                    @if ($item->status == 'approved')
                        <form action="{{ route('anggota.kembalikan', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-kembalikan">Kembalikan</button>
                        </form>
                    @elseif ($item->status == 'dikembalikan')
                       <span class="badge-pinjam" style="background:#fff3cd; color:#856404;">⏳ Menunggu Konfirmasi</span>
                    @else
                        <span class="btn-done">Selesai</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="no-data">
                    Belum ada data peminjaman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection