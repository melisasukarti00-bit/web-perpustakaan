<!-- resources/views/kepala/data_petugas.blade.php -->
@extends('kepala.layouts')

@section('title', 'Data Petugas')

@section('content')

<h2>👨‍💼 Data Petugas</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('kepala.petugas.create') }}" style="padding:8px 15px; background:#4da3ff; color:white; border-radius:8px; text-decoration:none;">
        ➕ Tambah Petugas
    </a>
</div>

<table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; background:white; border-radius:10px; overflow:hidden;">
    <thead style="background:#4da3ff; color:white; text-align:left;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($petugas as $no => $p)
        <tr style="border-bottom:1px solid #eee;">
            <td>{{ $no + 1 }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->email }}</td>
            <td>
                <a href="{{ route('kepala.petugas.edit', $p->id) }}" style="padding:4px 8px; background:#ffc107; color:white; border-radius:5px; text-decoration:none;">✏️ Edit</a>
                <form action="{{ route('kepala.petugas.destroy', $p->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding:4px 8px; background:#dc3545; color:white; border:none; border-radius:5px; cursor:pointer;">
                        🗑️ Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center; padding:15px;">Data petugas kosong</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection