@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h4>Detail Peminjaman Alat</h4>

    <div class="card mt-3">
        <div class="card-body">

            <div class="mb-3">
                <strong>Kode Peminjaman:</strong>
                <p>{{ $detail->peminjaman->kode_pinjam }}</p>
            </div>

            <div class="mb-3">
                <strong>Nama Alat:</strong>
                <p>{{ $detail->alat->nama_alat }}</p>
            </div>

            <div class="mb-3">
                <strong>Jumlah Dipinjam:</strong>
                <p>{{ $detail->jumlah }}</p>
            </div>

            <a href="{{ route('peminjaman_detail.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection
