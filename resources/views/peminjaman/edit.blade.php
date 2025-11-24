@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Peminjaman</h3>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-body">

                <div class="mb-3">
                    <label>Kode Peminjaman</label>
                    <input type="text" class="form-control" value="{{ $peminjaman->kode_pinjam }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}" required>
                </div>

                <hr>

                <h5>Alat yang Dipinjam</h5>

                <table class="table" id="table-items">
                    <thead>
                        <tr>
                            <th>Nama Alat</th>
                            <th width="120">Jumlah</th>
                            <th width="50">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($peminjaman->alat as $a)
                        <tr>
                            <td>
                                <select name="items[{{ $i }}][alat_id]" class="form-control" required>
                                    @foreach($alat as $al)
                                    <option value="{{ $al->id }}" {{ $al->id == $a->id ? 'selected' : '' }}>
                                        {{ $al->nama_alat }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" name="items[{{ $i }}][jumlah]" class="form-control" value="{{ $a->pivot->jumlah }}" min="1">
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>

                <button type="button" id="add-row" class="btn btn-secondary mt-2">+ Tambah Baris</button>

                <div class="mt-4">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </div>
        </div>

    </form>
</div>

<script>
    let index = {
        {
            $i
        }
    };

    document.getElementById('add-row').addEventListener('click', () => {
        let row = `
        <tr>
            <td>
                <select name="items[${index}][alat_id]" class="form-control" required>
                    @foreach($alat as $al)
                    <option value="{{ $al->id }}">{{ $al->nama_alat }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="number" name="items[${index}][jumlah]" value="1" min="1" class="form-control">
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </td>
        </tr>
    `;

        document.querySelector('#table-items tbody').insertAdjacentHTML('beforeend', row);
        index++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

</script>

@endsection