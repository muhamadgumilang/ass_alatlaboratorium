@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header d-flex justify-content-between align-items-center" 
                    style="background: linear-gradient(90deg, #4e73df, #224abe); color: white; border: none;">
                    <h5 class="mb-0 fw-bold">Detail Kategori Alat</h5>
                    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-light fw-bold" 
                       style="border-radius: 20px;">
                        Kembali
                    </a>
                </div>

                <div class="card-body" style="background-color: #f8f9fc;">
                    <h4 class="fw-bold text-primary">{{ $kategori->nama_kategori }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection