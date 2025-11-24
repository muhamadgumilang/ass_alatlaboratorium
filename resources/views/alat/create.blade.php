@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3>Tambah Alat Baru</h3>

    <form action="{{ route('alat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $row)
                    <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
