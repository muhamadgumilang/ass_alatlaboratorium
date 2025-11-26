@extends('layouts.dashboard')

@section('title', 'Edit Detail Peminjaman')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Detail Peminjaman</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('peminjaman_detail.update', $detail->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Peminjaman</label>
                <select name="peminjaman_id" class="form-control">
                    @foreach ($peminjaman as $p)
                        <option value="{{ $p->id }}"
                            {{ $detail->peminjaman_id == $p->id ? 'selected' : '' }}>
                            {{ $p->kode_pinjam }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Alat</label>
                <select name="alat_id" class="form-control">
                    @foreach ($alat as $a)
                        <option value="{{ $a->id }}"
                            {{ $detail->alat_id == $a->id ? 'selected' : '' }}>
                            {{ $a->nama_alat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control"
                       value="{{ $detail->jumlah }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('peminjaman_detail.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>

@endsection
