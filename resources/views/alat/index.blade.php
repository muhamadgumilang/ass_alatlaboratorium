    @extends('layouts.dashboard')

    @section('content')
    <div class="container">

        <h3>Daftar Alat Laboratorium</h3>

        <a href="{{ route('alat.create') }}" class="btn btn-primary mb-3">Tambah Alat</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Alat</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_alat }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('alat.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('alat.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus alat ini?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endsection
