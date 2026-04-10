@extends('petugas.layouts')

@section('title', 'Data Anggota')

@section('content')

<style>
.table-box {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background: #f1f1f1;
}

tr:hover {
    background: #f9f9f9;
}
</style>

<h2>👤 Data Anggota</h2>

<div class="table-box">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        @forelse($anggota as $i => $a)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $a->name }}</td>
            <td>{{ $a->email }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="color:gray;">Belum ada data anggota</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection