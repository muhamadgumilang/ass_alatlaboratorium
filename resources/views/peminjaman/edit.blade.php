@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Peminjaman</h3>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Kode Peminjaman</label>
            <input type="text" name="kode_pinjam" value="{{ $peminjaman->kode_pinjam }}" readonly class="form-control">
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" class="form-control">
        </div>

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
                @foreach($peminjaman->alats as $index => $item)
                <tr>
                    <td>
                        <select name="items[{{ $index }}][alat_id]" class="form-control" required>
                            <option value="">-- pilih alat --</option>
                            @foreach($alat as $a)
                            <option value="{{ $a->id }}" {{ $a->id == $item->id ? 'selected' : '' }}>
                                {{ $a->nama_alat }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="items[{{ $index }}][jumlah]" value="{{ $item->pivot->jumlah }}" min="1" class="form-control" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="button" id="add-row" class="btn btn-secondary mt-2">+ Tambah Baris</button>

        <div class="mt-4">
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<script>
    let index = {
        {
            $peminjaman - > alats - > count()
        }
    };

    document.getElementById('add-row').addEventListener('click', () => {
        let row = `
        <tr>
            <td>
                <select name="items[${index}][alat_id]" class="form-control" required>
                    <option value="">-- pilih alat --</option>
                    @foreach($alat as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${index}][jumlah]" value="1" min="1" class="form-control" required>
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