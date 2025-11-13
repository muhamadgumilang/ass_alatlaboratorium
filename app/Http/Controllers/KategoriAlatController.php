<?php
namespace App\Http\Controllers;

use App\Models\KategoriAlat;
use Illuminate\Http\Request;

class KategoriAlatController extends Controller
{
    public function index()
    {
        $kategori = KategoriAlat::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriAlat::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(KategoriAlat $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriAlat $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(KategoriAlat $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
