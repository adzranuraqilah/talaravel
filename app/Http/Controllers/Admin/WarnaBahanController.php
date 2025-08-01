<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\WarnaBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WarnaBahanController extends Controller
{
    public function index()
    {
        $warnaBahans = WarnaBahan::with('bahans')->orderBy('created_at', 'desc')->get();
        return view('admin.warna-bahan', compact('warnaBahans'));
    }

    // Menampilkan form tambah warna bahan
    public function create()
    {
        $bahans = Bahan::all();
        return view('admin.warna-bahan-tambah', compact('bahans'));
    }

    // Menyimpan warna bahan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_warna' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:7',
            'bahan_ids' => 'required|array|min:1',
            'bahan_ids.*' => 'exists:bahans,id',
            'deskripsi' => 'nullable|string'
        ]);

        $warnaBahan = WarnaBahan::create([
            'nama_warna' => $request->nama_warna,
            'kode_warna' => $request->kode_warna,
            'deskripsi' => $request->deskripsi
        ]);

        // Attach bahan yang dipilih
        $warnaBahan->bahans()->attach($request->bahan_ids);

        return redirect()->route('admin.warna-bahan.index')->with('success', 'Warna bahan berhasil ditambahkan!');
    }

    // Menampilkan form edit warna bahan
    public function edit($id)
    {
        $warnaBahan = WarnaBahan::with('bahans')->findOrFail($id);
        $bahans = Bahan::all();
        return view('admin.warna-bahan-edit', compact('warnaBahan', 'bahans'));
    }

    // Update warna bahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_warna' => 'required|string|max:255',
            'kode_warna' => 'required|string|max:7',
            'bahan_ids' => 'required|array|min:1',
            'bahan_ids.*' => 'exists:bahans,id',
            'deskripsi' => 'nullable|string'
        ]);

        $warnaBahan = WarnaBahan::findOrFail($id);
        $warnaBahan->update([
            'nama_warna' => $request->nama_warna,
            'kode_warna' => $request->kode_warna,
            'deskripsi' => $request->deskripsi
        ]);

        // Sync bahan yang dipilih (hapus yang lama, tambah yang baru)
        $warnaBahan->bahans()->sync($request->bahan_ids);

        return redirect()->route('admin.warna-bahan.index')->with('success', 'Warna bahan berhasil diperbarui!');
    }

    // Hapus warna bahan
    public function destroy($id)
    {
        $warnaBahan = WarnaBahan::findOrFail($id);
        $warnaBahan->delete(); // Relasi akan otomatis terhapus karena onDelete('cascade')

        return redirect()->route('admin.warna-bahan.index')->with('success', 'Warna bahan berhasil dihapus!');
    }

    public function getAll()
    {
        $warnaBahans = WarnaBahan::with('bahans')->orderBy('nama_warna')->get();
        return response()->json($warnaBahans);
    }
}
