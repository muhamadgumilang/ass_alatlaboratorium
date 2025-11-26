@extends('layouts.dashboard')

@section('title', 'Tambah Detail Peminjaman')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tambah Detail Peminjaman</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('peminjaman_detail.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Peminjaman</label>
                <select name="peminjaman_id" class="form-control">
                    @foreach ($peminjaman as $p)
                        <option value="{{ $p->id }}">{{ $p->kode_pinjam }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alat</label>
                <select name="alat_id" class="form-control">
                    @foreach ($alat as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('peminjaman_detail.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>

@endsection
