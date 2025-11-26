@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Daftar Peminjaman</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Peminjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Alat yang Dipinjam</th>
                <th>User ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $pinjam)
            <tr>
                <td>{{ $pinjam->kode_pinjam }}</td>
                <td>{{ $pinjam->tanggal_pinjam }}</td>
                <td>{{ $pinjam->tanggal_kembali }}</td>
                <td>
                    <ul>
                        @foreach ($pinjam->alats as $alat)
                        <li>{{ $alat->nama_alat }} — Jumlah: {{ $alat->pivot->jumlah }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $pinjam->user_id }}</td>
                <td>
                    <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection