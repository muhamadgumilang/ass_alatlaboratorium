@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kategori Alat</h2>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kategori.destroy', $row->id) }}" method="POST" style="display:inline;">
                        <a href="{{  route('kategori.show', $row->id) }}"
                            class="btn btn-sm btn-primary">Show</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
