<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $bahans = Bahan::orderBy('created_at', 'desc')->get();
        return view('admin.bahan', compact('bahans'));
    }

    // Menampilkan form tambah bahan
    public function create()
    {
        return view('admin.bahan-tambah');
    }

    // Menyimpan bahan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        Bahan::create([
            'nama_bahan' => $request->nama_bahan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.bahan.index')->with('success', 'Bahan berhasil ditambahkan!');
    }

    // Menampilkan form edit bahan
    public function edit($id)
    {
        $bahan = Bahan::findOrFail($id);
        return view('admin.bahan-edit', compact('bahan'));
    }

    // Update bahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $bahan = Bahan::findOrFail($id);
        $bahan->update([
            'nama_bahan' => $request->nama_bahan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.bahan.index')->with('success', 'Bahan berhasil diperbarui!');
    }

    // Hapus bahan
    public function destroy($id)
    {
        $bahan = Bahan::findOrFail($id);
        $bahan->delete();

        return redirect()->route('admin.bahan.index')->with('success', 'Bahan berhasil dihapus!');
    }

    public function getAll()
    {
        $bahans = Bahan::orderBy('nama_bahan')->get();
        return response()->json($bahans);
    }
}
