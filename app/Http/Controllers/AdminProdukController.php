<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class AdminProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Produk::orderBy('nama_produk')->orderBy('jenis_bahan')->get();
        return view('admin.produk', compact('produks'));
    }

    public function create()
    {
        return view('admin.produk-tambah');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required',
            'jenis_bahan' => 'nullable',
            'warna_bahan' => 'nullable',
            'ukuran' => 'nullable|array',
            'sablon' => 'nullable',
            'jumlah_warna_sablon' => 'nullable|integer',
            'model_jahitan' => 'nullable',
            'waktu_pengerjaan' => 'nullable',
            'tambahan_lain' => 'nullable|array',
            'harga' => 'nullable|integer',
        ]);

        // Convert arrays to JSON strings
        if (isset($data['ukuran'])) {
            $data['ukuran'] = json_encode($data['ukuran']);
        }
        if (isset($data['tambahan_lain'])) {
            $data['tambahan_lain'] = json_encode($data['tambahan_lain']);
        }

        Produk::create($data);
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk-edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $data = $request->validate([
            'nama_produk' => 'required',
            'jenis_bahan' => 'nullable',
            'warna_bahan' => 'nullable',
            'ukuran' => 'nullable|array',
            'sablon' => 'nullable',
            'jumlah_warna_sablon' => 'nullable|integer',
            'model_jahitan' => 'nullable',
            'waktu_pengerjaan' => 'nullable',
            'tambahan_lain' => 'nullable|array',
            'harga' => 'nullable|integer',
        ]);

        // Convert arrays to JSON strings
        if (isset($data['ukuran'])) {
            $data['ukuran'] = json_encode($data['ukuran']);
        }
        if (isset($data['tambahan_lain'])) {
            $data['tambahan_lain'] = json_encode($data['tambahan_lain']);
        }

        $produk->update($data);
        return redirect('/admin/produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }
} 