<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sablon;
use Illuminate\Http\Request;

class SablonController extends Controller
{
    public function index()
    {
        $sablons = Sablon::orderBy('created_at', 'desc')->get();
        return view('admin.sablon', compact('sablons'));
    }

    // Menampilkan form tambah sablon
    public function create()
    {
        return view('admin.sablon-tambah');
    }

    // Menyimpan sablon baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_sablon' => 'required|string|max:255|unique:sablons,nama_sablon',
            'deskripsi' => 'nullable|string|max:1000'
        ]);

        Sablon::create([
            'nama_sablon' => $request->nama_sablon,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.sablon.index')->with('success', 'Sablon berhasil ditambahkan!');
    }

    // Menampilkan form edit sablon
    public function edit($id)
    {
        $sablon = Sablon::findOrFail($id);
        return view('admin.sablon-edit', compact('sablon'));
    }

    // Update sablon
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sablon' => 'required|string|max:255|unique:sablons,nama_sablon,' . $id,
            'deskripsi' => 'nullable|string|max:1000'
        ]);

        $sablon = Sablon::findOrFail($id);
        $sablon->update([
            'nama_sablon' => $request->nama_sablon,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.sablon.index')->with('success', 'Sablon berhasil diperbarui!');
    }

    // Hapus sablon
    public function destroy($id)
    {
        $sablon = Sablon::findOrFail($id);
        $sablon->delete();

        return redirect()->route('admin.sablon.index')->with('success', 'Sablon berhasil dihapus!');
    }

    public function getAll()
    {
        $sablons = Sablon::orderBy('nama_sablon')->get();
        return response()->json($sablons);
    }
} 