@extends('layouts.dashboard')

@section('title', 'Data Detail Peminjaman')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Data Detail Peminjaman</h5>
        <a href="{{ route('peminjaman_detail.create') }}" class="btn btn-primary">Tambah Detail</a>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Peminjaman</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $item)
                <tr>
                    <td>{{ $item->peminjaman->kode_pinjam }}</td>
                    <td>{{ $item->alat->nama_alat }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        <a href="{{ route('peminjaman_detail.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('peminjaman_detail.destroy', $item->id) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
