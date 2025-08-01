<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Produk;
use App\Models\Bahan;
use App\Models\WarnaBahan;
use App\Models\Sablon;
use App\Models\Jahitan;
use App\Models\WaktuPengerjaan;
use App\Models\TambahanLain;

class EstimasiHargaController extends Controller
{
    public function getProdukList()
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return response()->json($produks->pluck('nama_produk', 'id'));
    }

    public function getBahanByProduk($jenisProduk)
    {
        // Debug: log parameter yang diterima
        Log::info('getBahanByProduk called with:', ['jenisProduk' => $jenisProduk]);
        
        // Coba cari berdasarkan ID dulu
        $produk = Produk::find($jenisProduk);
        
        // Jika tidak ditemukan, cari berdasarkan nama
        if (!$produk) {
            $produk = Produk::where('nama_produk', 'like', '%' . $jenisProduk . '%')->first();
        }
        
        if (!$produk) {
            Log::warning('Produk tidak ditemukan:', ['jenisProduk' => $jenisProduk]);
            return response()->json([]);
        }

        Log::info('Produk ditemukan:', ['produk_id' => $produk->id, 'nama_produk' => $produk->nama_produk]);

        $bahans = $produk->bahans()->with('warnaBahans')->get();
        Log::info('Bahans found:', ['count' => $bahans->count(), 'bahans' => $bahans->toArray()]);
        
        $result = [];
        
        foreach ($bahans as $bahan) {
            $result[$bahan->id] = [
                'nama' => $bahan->nama_bahan,
                'deskripsi' => $bahan->deskripsi,
                'harga' => $bahan->harga,
                'warna' => $bahan->warnaBahans->pluck('nama_warna')->toArray()
            ];
        }
        
        Log::info('Result:', $result);
        return response()->json($result);
    }

    public function getWarnaByBahan($jenisProduk, $jenisBahan)
    {
        // Coba cari produk berdasarkan ID dulu
        $produk = Produk::find($jenisProduk);
        
        // Jika tidak ditemukan, cari berdasarkan nama
        if (!$produk) {
            $produk = Produk::where('nama_produk', 'like', '%' . $jenisProduk . '%')->first();
        }
        
        if (!$produk) {
            return response()->json([]);
        }

        $bahan = $produk->bahans()->where('bahans.id', $jenisBahan)->first();
        
        if (!$bahan) {
            return response()->json([]);
        }

        $warnaBahans = $bahan->warnaBahans()->get();
        return response()->json($warnaBahans->pluck('nama_warna'));
    }

    public function store(Request $request)
    {
        // Debug: log request data
        Log::info('Store request data:', $request->all());
        
        $request->validate([
            'jenis_produk' => 'required',
            'kuantitas' => 'required|integer|min:24',
            'jenis_bahan' => 'required',
            'warna_bahan' => 'required',
            'ukuran' => 'required|array|min:1',
            'model_jahitan' => 'required',
            'sablon' => 'required',
            'jumlah_warna_sablon' => 'required|integer|min:1',
            'tambahan_lain' => 'nullable|array',
            'waktu_pengerjaan' => 'required'
        ]);

        // Ambil data produk - coba berdasarkan ID dulu
        $produk = Produk::find($request->jenis_produk);
        if (!$produk) {
            $produk = Produk::where('nama_produk', 'like', '%' . $request->jenis_produk . '%')->first();
        }
        if (!$produk) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        // Ambil data bahan
        $bahan = Bahan::find($request->jenis_bahan);
        if (!$bahan) {
            return response()->json(['error' => 'Bahan tidak ditemukan'], 404);
        }

        // Ambil data sablon
        $sablon = Sablon::where('nama_sablon', 'like', '%' . $request->sablon . '%')->first();
        
        // Ambil data jahitan
        $jahitan = Jahitan::where('nama_jahitan', 'like', '%' . $request->model_jahitan . '%')->first();

        // Ambil data waktu pengerjaan
        $waktuPengerjaan = WaktuPengerjaan::where('produk_id', $produk->id)
            ->where('nama_waktu', 'like', '%' . $request->waktu_pengerjaan . '%')
            ->first();

        // Hitung harga sablon berdasarkan jumlah warna
        $hargaSablon = $this->hitungHargaSablon($request->jumlah_warna_sablon);

        // Hitung harga tambahan lain
        $hargaTambahan = 0;
        if ($request->tambahan_lain) {
            foreach ($request->tambahan_lain as $tambahan) {
                $tambahanLain = TambahanLain::where('nama_tambahan', 'like', '%' . $tambahan . '%')->first();
                if ($tambahanLain) {
                    $hargaTambahan += $tambahanLain->harga;
                }
            }
        }

        // Hitung total harga per item
        $hargaPerItem = $produk->harga + $bahan->harga + $hargaSablon + $hargaTambahan;

        // Hitung total estimasi
        $totalEstimasi = $hargaPerItem * $request->kuantitas;

        // Estimasi pengerjaan
        $estimasiPengerjaan = $waktuPengerjaan ? $waktuPengerjaan->durasi_hari . ' hari kerja' : '7-14 hari kerja';

        return response()->json([
            'harga_per_item' => $hargaPerItem,
            'total_estimasi' => $totalEstimasi,
            'estimasi_pengerjaan' => $estimasiPengerjaan,
            'detail' => [
                'produk' => [
                    'nama' => $produk->nama_produk,
                    'harga' => $produk->harga
                ],
                'bahan' => [
                    'nama' => $bahan->nama_bahan,
                    'harga' => $bahan->harga
                ],
                'warna_bahan' => [
                    'nama' => $request->warna_bahan,
                    'harga' => 0 // Warna bahan tidak ada harga
                ],
                'sablon' => [
                    'nama' => $request->sablon,
                    'harga' => $hargaSablon
                ],
                'jahitan' => [
                    'nama' => $request->model_jahitan,
                    'harga' => 0 // Jahitan tidak ada harga
                ],
                'tambahan_lain' => [
                    'items' => $request->tambahan_lain ?: [],
                    'harga' => $hargaTambahan
                ],
                'kuantitas' => $request->kuantitas
            ]
        ]);
    }

    private function hitungHargaSablon($jumlahWarna)
    {
        if ($jumlahWarna <= 4) {
            return 20000; // Rp. 20.000 untuk 1-4 warna
        } else {
            return 30000; // Rp. 30.000 untuk lebih dari 4 warna
        }
    }
} 