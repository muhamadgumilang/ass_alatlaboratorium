@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Peminjaman</h3>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-body">

                <div class="mb-3">
                    <label>Kode Peminjaman</label>
                    <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
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
                        <tr>
                            <td>
                                <select name="items[0][alat_id]" class="form-control" required>
                                    <option value="">-- pilih alat --</option>
                                  @foreach ($alat as $row)
                                  <option value="{{ $row->id }}">{{ $row->nama_alat }}</option>
                                  @endforeach

                                </select>
                            </td>

                            <td>
                                <input type="number" name="items[0][jumlah]" value="1" min="1" class="form-control">
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="add-row" class="btn btn-secondary mt-2">+ Tambah Baris</button>

                <div class="mt-4">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </div>
        </div>

    </form>
</div>

<script>
    let index = 1;

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