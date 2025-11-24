@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
<h3>Data Peminjaman</h3>
<p>
<a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah Data</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Alat Dipinjam</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->kode_pinjam }}</td>
            <td>{{ $d->tanggal_pinjam }}</td>
            <td>{{ $d->tanggal_kembali }}</td>
            <td>{{ $d->alat}}</td>
            <td>
                @foreach($d->alat as $a)
                • {{ $a->nama_alat }} ({{ $a->pivot->jumlah }}) <br>
                @endforeach
            </td>
            <td>
                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection