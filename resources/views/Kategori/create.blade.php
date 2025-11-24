@extends('layouts.dashboard')

@section('content')
<div class="container ">
    <h1>Tambah Kategori Alat</h1>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
