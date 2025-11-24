<?php
namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Generate kode otomatis
    private function generateKode()
    {
        $last = Peminjaman::latest()->first();
        $next = $last ? ((int) substr($last->kode_pinjam, 3)) + 1 : 1;

        return 'PN-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $alat = Alat::all();
        $data = Peminjaman::with(['alat'])->latest()->get();

        return view('peminjaman.index', compact('data'));
    }

    public function create()
    {
        $alat = Alat::all();

        return view('peminjaman.create', [
            'kode' => $this->generateKode(),
            'alat' => $alat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'alat'            => 'required|array',
            'kode'            => 'required|unique:peminjaman,kode_pinjam',
            'items'           => 'required|array',
            

        ]);

        $kode_pinjam = 'PIN-' . time();

        // Save header
        $peminjaman = Peminjaman::create([
            'kode_pinjam'     => $request->kode_pinjam,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'user_id'         => Auth::id(),
        ]);

        // Save detail
        foreach ($request->items as $item) {
            if (! isset($item['alat_id'])) {
                continue;
            }

            $peminjaman->alat()->attach($item['alat_id'], [
                'jumlah' => $item['jumlah'] ?? 1,
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $alat = Alat::all();

        return view('peminjaman.edit', compact('peminjaman', 'alat'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_pinjam'  => 'required',
            'tanggal_kembali' => 'required',
            'items'           => 'required|array',
        ]);

        // Update header
        $peminjaman->update([
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        // Remove old detail
        $peminjaman->alat()->detach();

        // Save new detail
        foreach ($request->items as $item) {
            if (! isset($item['alat_id'])) {
                continue;
            }

            $peminjaman->alat()->attach($item['alat_id'], [
                'jumlah' => $item['jumlah'] ?? 1,
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman dihapus.');
    }
}
