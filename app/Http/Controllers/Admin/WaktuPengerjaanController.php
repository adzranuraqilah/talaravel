<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaktuPengerjaan;
use App\Models\Produk;

class WaktuPengerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waktuPengerjaans = WaktuPengerjaan::with('produk')->orderBy('nama_waktu')->get();
        return view('admin.waktu-pengerjaan', compact('waktuPengerjaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.waktu-pengerjaan-tambah', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'nama_waktu' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string'
        ]);

        WaktuPengerjaan::create([
            'produk_id' => $request->produk_id,
            'nama_waktu' => $request->nama_waktu,
            'durasi_hari' => $request->durasi_hari,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.waktu-pengerjaan.index')->with('success', 'Waktu pengerjaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $waktuPengerjaan = WaktuPengerjaan::findOrFail($id);
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.waktu-pengerjaan-edit', compact('waktuPengerjaan', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $waktuPengerjaan = WaktuPengerjaan::findOrFail($id);
        
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'nama_waktu' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string'
        ]);

        $waktuPengerjaan->update([
            'produk_id' => $request->produk_id,
            'nama_waktu' => $request->nama_waktu,
            'durasi_hari' => $request->durasi_hari,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.waktu-pengerjaan.index')->with('success', 'Waktu pengerjaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $waktuPengerjaan = WaktuPengerjaan::findOrFail($id);
        $waktuPengerjaan->delete();
        
        return redirect()->route('admin.waktu-pengerjaan.index')->with('success', 'Waktu pengerjaan berhasil dihapus!');
    }

    public function getByProduk(Request $request)
    {
        $produk = $request->get('produk');
        
        if ($produk) {
            // Coba cari berdasarkan ID dulu
            $produkModel = Produk::find($produk);
            
            // Jika tidak ditemukan, cari berdasarkan nama
            if (!$produkModel) {
                $produkModel = Produk::where('nama_produk', 'like', '%' . $produk . '%')->first();
            }
            
            if ($produkModel) {
                $waktuPengerjaans = WaktuPengerjaan::where('produk_id', $produkModel->id)->get();
                return response()->json($waktuPengerjaans);
            }
        }
        
        // Fallback: return semua waktu pengerjaan
        $waktuPengerjaans = WaktuPengerjaan::with('produk')->get();
        return response()->json($waktuPengerjaans);
    }


}
