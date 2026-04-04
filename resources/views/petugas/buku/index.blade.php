@extends('petugas.layouts')

@section('title', 'Data Buku')

@section('content')

<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.btn {
    background: #4da3ff;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}

.card-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background: #f1f3f6;
}

.cover-img {
    width: 50px;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
}

.action-btn {
    padding: 5px 10px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.edit {
    background: #ffc107;
}

.delete {
    background: #dc3545;
    color: white;
}
</style>

<div class="header">
    <h2>📚 Kelola Buku</h2>

    <a href="{{ route('petugas.buku.create') }}" class="btn">
        + Tambah Buku
    </a>
</div>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<div class="card-box">

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($buku as $i => $b)
            <tr>
                <td>{{ $i + 1 }}</td>

                <td>
                    @if($b->cover)
                        <img src="{{ asset('storage/'.$b->cover) }}" class="cover-img">
                    @else
                        -
                    @endif
                </td>

                <td>{{ $b->judul }}</td>
                <td>{{ $b->pengarang }}</td>
                <td>{{ $b->penerbit }}</td>
                <td>{{ $b->tahun }}</td>
                <td>{{ $b->stok }}</td>

                <td>
                    <a href="{{ route('petugas.buku.edit', $b->id) }}">
                        <button class="action-btn edit">Edit</button>
                    </a>

                    <form action="{{ route('petugas.buku.destroy', $b->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn delete" onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="8">Data kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection