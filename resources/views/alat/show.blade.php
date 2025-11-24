@extends('layouts.dashboard')

@section('content')
<div class="container">

    <h3>Detail Alat</h3>

    <div class="card mt-3">
        <div class="card-body">

            <p><strong>Nama Alat:</strong> {{ $alat->nama_alat }}</p>
            <p><strong>Stok:</strong> {{ $alat->stok }}</p>
            <p><strong>Kategori:</strong> {{ $alat->kategori->nama_kategori }}</p>

            <a href="{{ route('alat.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</div>
@endsection
