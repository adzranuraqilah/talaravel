<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriPratinjau;
use Illuminate\Support\Facades\Log;

class CustomController extends Controller
{
    public function showForm()
    {
        $warnaBahan = [
            'Katun Combed' => [
                ['hex' => '#800020', 'nama' => 'Burgundy'],
                ['hex' => '#800000', 'nama' => 'Maroon'],
                ['hex' => '#E34234', 'nama' => 'Chili Red'],
                ['hex' => '#FF00FF', 'nama' => 'Fuchsia'],
                ['hex' => '#FFC0CB', 'nama' => 'Pink'],
                ['hex' => '#DAA5A4', 'nama' => 'Dusty Rose'],
                ['hex' => '#E2725B', 'nama' => 'Terracotta'],
                ['hex' => '#FFA500', 'nama' => 'Orange'],
                ['hex' => '#FF5E00', 'nama' => 'Bright Orange'],
                ['hex' => '#FFD700', 'nama' => 'Gold'],
                ['hex' => '#FFF44F', 'nama' => 'Lemon Yellow'],
                ['hex' => '#FFDB58', 'nama' => 'Mustard'],
                ['hex' => '#4B3621', 'nama' => 'Coffee Brown'],
                ['hex' => '#F5F5DC', 'nama' => 'Beige'],
                ['hex' => '#FFFDD0', 'nama' => 'Cream'],
                ['hex' => '#4B5320', 'nama' => 'Army Green'],
                ['hex' => '#708238', 'nama' => 'Olive Green'],
                ['hex' => '#93E9BE', 'nama' => 'Seafoam Green'],
                ['hex' => '#CCFF00', 'nama' => 'Electric Lime'],
                ['hex' => '#98FF98', 'nama' => 'Mint Green'],
                ['hex' => '#1560BD', 'nama' => 'Denim Blue'],
                ['hex' => '#4682B4', 'nama' => 'Steel Blue'],
                ['hex' => '#AEC6CF', 'nama' => 'Pastel Blue'],
                ['hex' => '#87CEEB', 'nama' => 'Sky Blue'],
                ['hex' => '#40E0D0', 'nama' => 'Turquois'],
                ['hex' => '#000080', 'nama' => 'Navy'],
                ['hex' => '#4B0082', 'nama' => 'Dark Purple'],
                ['hex' => '#7851A9', 'nama' => 'Royal Purple'],
                ['hex' => '#E6E6FA', 'nama' => 'Lavender'],
                ['hex' => '#C8A2C8', 'nama' => 'Lilac'],
                ['hex' => '#FF00FF', 'nama' => 'Magenta'],
                ['hex' => '#000000', 'nama' => 'Jet Black'],
                ['hex' => '#D3D3D3', 'nama' => 'Light Grey'],
                ['hex' => '#F8F8F8', 'nama' => 'Broken White'],
                ['hex' => '#FFFFFF', 'nama' => 'Putih Netral'],
            ],
            'Polyester' => [
                ['hex' => '#FFFFFF', 'nama' => 'Putih'],
                ['hex' => '#000000', 'nama' => 'Hitam'],
                ['hex' => '#000080', 'nama' => 'Navy'],
            ],
            'Katun Bamboo' => [
                ['hex' => '#FF2400', 'nama' => 'Merah Cabe'],
                ['hex' => '#FFFFFF', 'nama' => 'Putih Netral'],
                ['hex' => '#111111', 'nama' => 'Hitam Reaktif Special'],
                ['hex' => '#800000', 'nama' => 'Maroon'],
                ['hex' => '#999999', 'nama' => 'Abu Sedang'],
                ['hex' => '#FFDB58', 'nama' => 'Mustard'],
                ['hex' => '#014421', 'nama' => 'Hijau Botol Special 2'],
                ['hex' => '#F5F5DC', 'nama' => 'Beige'],
                ['hex' => '#DAA5A4', 'nama' => 'Dusty Pink'],
                ['hex' => '#4682B4', 'nama' => 'Steel Blue'],
                ['hex' => '#F7E98E', 'nama' => 'Kuning Kenari'],
                ['hex' => '#D3D3D3', 'nama' => 'Abu Muda'],
                ['hex' => '#A0D6D4', 'nama' => 'Tosca Muda'],
                ['hex' => '#8DA399', 'nama' => 'Mineral Green'],
                ['hex' => '#708238', 'nama' => 'Olive Green'],
                ['hex' => '#C49E54', 'nama' => 'Dark Mustard'],
                ['hex' => '#D2B48C', 'nama' => 'Almond Brown'],
                ['hex' => '#A9746E', 'nama' => 'Coklat Susu'],
                ['hex' => '#003366', 'nama' => 'Deep Blue'],
                ['hex' => '#696969', 'nama' => 'Abu Tua'],
                ['hex' => '#000033', 'nama' => 'Dark Navy'],
            ],
            'Supima' => [
                ['hex' => '#FFFFFF', 'nama' => 'Pure White'],
                ['hex' => '#000000', 'nama' => 'Jet Black'],
                ['hex' => '#D3D3D3', 'nama' => 'Abu Muda'],
                ['hex' => '#36454F', 'nama' => 'Charcoal'],
                ['hex' => '#000080', 'nama' => 'Navy'],
                ['hex' => '#FFFDD0', 'nama' => 'Cream'],
                ['hex' => '#F5F5DC', 'nama' => 'Beige'],
                ['hex' => '#A9746E', 'nama' => 'Coklat Susu'],
                ['hex' => '#B2AC88', 'nama' => 'Sage Green'],
                ['hex' => '#E2725B', 'nama' => 'Terracotta'],
                ['hex' => '#DAA5A4', 'nama' => 'Dusty Pink'],
                ['hex' => '#4682B4', 'nama' => 'Steel Blue'],
                ['hex' => '#800000', 'nama' => 'Maroon'],
                ['hex' => '#708238', 'nama' => 'Olive'],
                ['hex' => '#FFBF00', 'nama' => 'Mustard Gold'],
            ],
            // ... lanjutkan bahan lain sesuai data Anda
        ];
        $riwayatPratinjau = GaleriPratinjau::latest()->get();
        
        // Debug: cek apakah data ada
        Log::info('Riwayat Pratinjau Count: ' . $riwayatPratinjau->count());
        Log::info('Riwayat Pratinjau Data: ' . $riwayatPratinjau->toJson());
        
        return view('custom-desain', compact('warnaBahan', 'riwayatPratinjau'));
    }



    public function submit(Request $request)
    {
        $validated = $request->validate([
            'jenis_produk' => 'required|string|max:255',
            'file_desain' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'warna' => 'nullable|string|max:100',
            'teks' => 'nullable|string|max:255',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('file_desain')) {
            $validated['file_desain'] = $request->file('file_desain')->store('desain');
        }

        // Simpan ke database jika perlu, misal:
        // Desain::create($validated);

        return redirect()->back()->with('success', 'Desain berhasil dikirim!');
    }


} 