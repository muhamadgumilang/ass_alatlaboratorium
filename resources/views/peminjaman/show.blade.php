@extends('layouts.app')
@section('content')
<div class="container">
    <h3>🔍 Detail Peminjaman</h3>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Kode Pinjam:</strong> {{ $peminjaman->kode_pinjam }}</p>
            <p><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $peminjaman->tanggal_kembali }}</p>
            <p><strong>Admin Input:</strong> {{ $peminjaman->user->name }}</p>
        </div>
    </div>

    <h5>Daftar Alat yang Dipinjam</h5>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman->alat as $alat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->pivot->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">⬅ Kembali</a>
</div>
@endsection