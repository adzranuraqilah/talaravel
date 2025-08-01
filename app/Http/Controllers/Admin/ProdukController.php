<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\WarnaBahan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with(['bahans', 'warnaBahans'])->orderBy('created_at', 'desc')->get();
        return view('admin.produk', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bahans = Bahan::all();
        $warnaBahans = WarnaBahan::with('bahans')->get();
        return view('admin.produk-tambah', compact('bahans', 'warnaBahans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'bahan_ids' => 'required|array|min:1',
            'bahan_ids.*' => 'exists:bahans,id',
            'warna_bahan_ids' => 'nullable|array',
            'warna_bahan_ids.*' => 'exists:warna_bahans,id'
        ]);

        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        // Attach bahan yang dipilih
        $produk->bahans()->attach($request->bahan_ids);

        // Attach warna bahan yang dipilih (jika ada)
        if ($request->warna_bahan_ids) {
            $produk->warnaBahans()->attach($request->warna_bahan_ids);
        }

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
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
        $produk = Produk::with(['bahans', 'warnaBahans'])->findOrFail($id);
        $bahans = Bahan::all();
        $warnaBahans = WarnaBahan::with('bahans')->get();
        return view('admin.produk-edit', compact('produk', 'bahans', 'warnaBahans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'bahan_ids' => 'required|array|min:1',
            'bahan_ids.*' => 'exists:bahans,id',
            'warna_bahan_ids' => 'nullable|array',
            'warna_bahan_ids.*' => 'exists:warna_bahans,id'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        // Sync bahan yang dipilih
        $produk->bahans()->sync($request->bahan_ids);

        // Sync warna bahan yang dipilih
        $produk->warnaBahans()->sync($request->warna_bahan_ids ?? []);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Get warna bahan berdasarkan bahan yang dipilih
     */
    public function getWarnaBahanByBahan(Request $request)
    {
        $bahanIds = $request->bahan_ids;
        $warnaBahans = WarnaBahan::whereHas('bahans', function($query) use ($bahanIds) {
            $query->whereIn('bahans.id', $bahanIds);
        })->with('bahans')->get();

        return response()->json($warnaBahans);
    }

    public function getAll()
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return response()->json($produks);
    }
}
