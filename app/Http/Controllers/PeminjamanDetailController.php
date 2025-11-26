<?php
namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;

class PeminjamanDetailController extends Controller
{
   public function index()
{
    $detail = PeminjamanDetail::with(['peminjaman', 'alat'])->get();

    return view('peminjaman_detail.index', compact('detail'));
}


    public function create()
    {
        $peminjaman = Peminjaman::all();
        $alat       = Alat::all();
        return view('peminjaman_detail.create', compact('peminjaman', 'alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required',
            'alat_id'       => 'required',
            'jumlah'        => 'required|numeric|min:1',
        ]);

        PeminjamanDetail::create($request->all());

        return redirect()->route('peminjaman_detail.index')
            ->with('success', 'Detail berhasil ditambahkan');
    }

    public function edit(PeminjamanDetail $peminjaman_detail)
    {
        $peminjaman = Peminjaman::all();
        $alat       = Alat::all();
        return view('peminjaman_detail.edit', compact('peminjaman_detail', 'peminjaman', 'alat'));
    }

    public function update(Request $request, PeminjamanDetail $peminjaman_detail)
    {
        $request->validate([
            'peminjaman_id' => 'required',
            'alat_id'       => 'required',
            'jumlah'        => 'required|numeric|min:1',
        ]);

        $peminjaman_detail->update($request->all());

        return redirect()->route('peminjaman_detail.index')
            ->with('success', 'Detail berhasil diupdate');
    }

    public function destroy(PeminjamanDetail $peminjaman_detail)
    {
        $peminjaman_detail->delete();

        return redirect()->route('peminjaman_detail.index')
            ->with('success', 'Detail berhasil dihapus');
    }
}
