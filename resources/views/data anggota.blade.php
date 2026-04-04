@extends('petugas.layouts')

@section('title', 'Data Anggota')

@section('content')

<h2>👤 Data Anggota</h2>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>1</td>
            <td>Budi</td>
            <td>budi@gmail.com</td>
            <td>08123</td>
        </tr>

        <tr>
            <td>2</td>
            <td>Siti</td>
            <td>siti@gmail.com</td>
            <td>08234</td>
        </tr>

        <tr>
            <td>3</td>
            <td>Andi</td>
            <td>andi@gmail.com</td>
            <td>08345</td>
        </tr>
    </tbody>
</table>

@endsection