<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Generate kode otomatis
    private function generateKode()
    {
        $last = Peminjaman::orderBy('id', 'DESC')->first();

        $next = $last ? ((int) substr($last->kode_pinjam, 3)) + 1 : 1;

        return 'TRX-'.strtoupper(uniqid());
    }

    public function index()
    {
        $peminjaman = Peminjaman::with('alats')->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $last = Peminjaman::orderBy('id', 'desc')->first();
        $next = $last ? intval(substr($last->kode_pinjam, 3)) + 1 : 1;

        $kode_otomatis = 'TRX-'.strtoupper(uniqid());

        $alat = Alat::all();

        return view('peminjaman.create', compact('kode_otomatis', 'alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'items' => 'required|array',
            'items.*.alat_id' => 'required|exists:alats,id',
            'items.*.jumlah' => 'nullable|integer|min:1',
        ]);

        $last = Peminjaman::orderBy('id', 'desc')->first();
        $next = $last ? intval(substr($last->kode_pinjam, 3)) + 1 : 1;
        $kode_pinjam = 'TRX-'.strtoupper(uniqid());

        $peminjaman = Peminjaman::create([
            'kode_pinjam' => $kode_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->items as $item) {
            $peminjaman->alats()->attach($item['alat_id'], [
                'jumlah' => $item['jumlah'] ?? 1,
            ]);
        }

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('alats')->findOrFail($id);
        $alat = Alat::all();

        return view('peminjaman.edit', compact('peminjaman', 'alat'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('alats')->findOrFail($id);

        return view('peminjaman.show', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'items' => 'required|array',
            'items.*.alat_id' => 'required|exists:alats,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->save();

        // Sync alat yang dipinjam dengan jumlahnya
        $syncData = [];
        foreach ($request->items as $item) {
            $syncData[$item['alat_id']] = ['jumlah' => $item['jumlah']];
        }
        $peminjaman->alats()->sync($syncData);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diupdate');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->alats()->detach();
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman dihapus.');
    }
}