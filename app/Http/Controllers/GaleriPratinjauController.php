<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriPratinjau;
use Illuminate\Support\Facades\Storage;

class GaleriPratinjauController extends Controller
{
    public function index(Request $request) {
        $query = GaleriPratinjau::query();
        if ($request->q) {
            $query->where('nama_produk', 'like', '%'.$request->q.'%');
        }
        $galeri = $query->latest()->get();
        return view('admin.galeri', compact('galeri'));
    }

    public function upload(Request $request) {
        $request->validate([
            'nama_produk' => 'required',
            'foto_pratinjau' => 'required|image',
        ]);
        $path = $request->file('foto_pratinjau')->store('galeri_pratinjau', 'public');
        GaleriPratinjau::create([
            'nama_produk' => $request->nama_produk,
            'jenis_produk' => 'kaos', // Default value
            'foto_pratinjau' => $path,
        ]);
        return redirect('/admin/galeri')->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function edit($id) {
        $item = \App\Models\GaleriPratinjau::findOrFail($id);
        return view('admin.portfolio-edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_produk' => 'required',
            'foto_pratinjau' => 'nullable|image',
        ]);

        $item = GaleriPratinjau::findOrFail($id);
        
        $fotoPath = $item->foto_pratinjau; // Keep existing image if no new image uploaded
        if ($request->hasFile('foto_pratinjau')) {
            // Delete old image if exists
            if ($item->foto_pratinjau && Storage::disk('public')->exists($item->foto_pratinjau)) {
                Storage::disk('public')->delete($item->foto_pratinjau);
            }
            $fotoPath = $request->file('foto_pratinjau')->store('galeri_pratinjau', 'public');
        }

        $item->update([
            'nama_produk' => $request->nama_produk,
            'foto_pratinjau' => $fotoPath,
        ]);

        return redirect('/admin/galeri')->with('success', 'Portfolio berhasil diupdate!');
    }

    public function destroy($id) {
        $item = \App\Models\GaleriPratinjau::findOrFail($id);
        if ($item->foto_pratinjau && Storage::disk('public')->exists($item->foto_pratinjau)) {
            Storage::disk('public')->delete($item->foto_pratinjau);
        }
        $item->delete();
        return redirect('/admin/galeri')->with('success', 'Portfolio berhasil dihapus!');
    }
} 