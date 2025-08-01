<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TambahanLain;
use Illuminate\Http\Request;

class TambahanLainController extends Controller
{
    public function index()
    {
        $tambahanLains = TambahanLain::orderBy('nama_tambahan')->get();
        return view('admin.tambahan-lain', compact('tambahanLains'));
    }

    // Menampilkan form tambah jahitan
    public function create()
    {
        return view('admin.tambahan-lain-tambah');
    }

    // Menyimpan jahitan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_tambahan' => 'required|string|max:255|unique:tambahan_lains,nama_tambahan',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        TambahanLain::create([
            'nama_tambahan' => $request->nama_tambahan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.tambahan-lain.index')->with('success', 'Tambahan lain berhasil ditambahkan!');
    }

    // Menampilkan form edit jahitan
    public function edit($id)
    {
        $tambahanLain = TambahanLain::findOrFail($id);
        return view('admin.tambahan-lain-edit', compact('tambahanLain'));
    }

    // Update jahitan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tambahan' => 'required|string|max:255|unique:tambahan_lains,nama_tambahan,' . $id
        ]);

        $tambahanLain = TambahanLain::findOrFail($id);
        $tambahanLain->update([
            'nama_tambahan' => $request->nama_tambahan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.tambahan-lain.index')->with('success', 'Tambahan lain berhasil diperbarui!');
    }

    // Hapus jahitan
    public function destroy($id)
    {
        $tambahanLain = TambahanLain::findOrFail($id);
        $tambahanLain->delete();

        return redirect()->route('admin.tambahan-lain.index')->with('success', 'Tambahan lain berhasil dihapus!');
    }

    public function getAll()
    {
        $tambahanLains = TambahanLain::orderBy('nama_tambahan')->get();
        return response()->json($tambahanLains);
    }
}
