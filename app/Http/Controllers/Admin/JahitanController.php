<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jahitan;
use Illuminate\Http\Request;

class JahitanController extends Controller
{
    public function index()
    {
        $jahitans = Jahitan::orderBy('created_at', 'desc')->get();
        return view('admin.jahitan', compact('jahitans'));
    }

    // Menampilkan form tambah jahitan
    public function create()
    {
        return view('admin.jahitan-tambah');
    }

    // Menyimpan jahitan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_jahitan' => 'required|string|max:255|unique:jahitans,nama_jahitan'
        ]);

        Jahitan::create([
            'nama_jahitan' => $request->nama_jahitan
        ]);

        return redirect()->route('admin.jahitan.index')->with('success', 'Jahitan berhasil ditambahkan!');
    }

    // Menampilkan form edit jahitan
    public function edit($id)
    {
        $jahitan = Jahitan::findOrFail($id);
        return view('admin.jahitan-edit', compact('jahitan'));
    }

    // Update jahitan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jahitan' => 'required|string|max:255|unique:jahitans,nama_jahitan,' . $id
        ]);

        $jahitan = Jahitan::findOrFail($id);
        $jahitan->update([
            'nama_jahitan' => $request->nama_jahitan
        ]);

        return redirect()->route('admin.jahitan.index')->with('success', 'Jahitan berhasil diperbarui!');
    }

    // Hapus jahitan
    public function destroy($id)
    {
        $jahitan = Jahitan::findOrFail($id);
        $jahitan->delete();

        return redirect()->route('admin.jahitan.index')->with('success', 'Jahitan berhasil dihapus!');
    }

    public function getAll()
    {
        $jahitans = Jahitan::orderBy('nama_jahitan')->get();
        return response()->json($jahitans);
    }
} 