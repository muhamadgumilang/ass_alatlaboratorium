@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3>Edit Alat</h3>

    <form action="{{ route('alat.update', $alat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" value="{{ $alat->nama_alat }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $alat->stok }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach ($kategori as $row)
                    <option value="{{ $row->id }}" {{ $alat->kategori_id == $row->id ? 'selected' : '' }}>
                        {{ $row->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
