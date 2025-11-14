<?php
namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\KategoriAlat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->get();
        return view('alat.index', compact('alat'));
    }

    public function create()
    {
        $kategori = KategoriAlat::all();
        return view('alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'stok'        => 'required|integer',
            'kategori_id' => 'required',
        ]);

        Alat::create($request->all());
        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show(Alat $alat)
    {
        return view('alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {
        $kategori = KategoriAlat::all();
        return view('alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'stok'        => 'required|integer',
            'kategori_id' => 'required',
        ]);

        $alat->update($request->all());
        return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui!');
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus!');
    }
}
