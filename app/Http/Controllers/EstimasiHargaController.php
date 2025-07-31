<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimasiHarga;
use Illuminate\Support\Facades\Log;

class EstimasiHargaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_produk' => 'required|string',
            'jenis_bahan' => 'required|string',
            'warna_bahan' => 'nullable|string',
            'ukuran' => 'nullable|array',
            'model_jahitan' => 'nullable|string',
            'kuantitas' => 'required|integer|min:1',
            'sablon' => 'nullable|string',
            'jumlah_warna_sablon' => 'nullable|integer',
            'tambahan_lain' => 'nullable|array',
            'waktu_pengerjaan' => 'nullable|string',
        ]);

        // Ambil harga produk dari database
        $produk = \App\Models\Produk::where('nama_produk', $request->jenis_produk)
                                    ->where('jenis_bahan', $request->jenis_bahan)
                                    ->first();
        
        $hargaProduk = $produk ? $produk->harga : 0;

        // Ambil pengaturan dari database
        $settings = \App\Models\Setting::first();
        
        // Harga sablon
        $hargaSablon = $settings && $settings->sablon_pricing ? json_decode($settings->sablon_pricing, true) : [
            'plastisol' => 20000,
            'rubber' => 15000,
            'dtg' => 30000,
            'bordir' => 15000,
        ];

        // Harga tambahan
        $hargaTambahan = $settings && $settings->additional_costs ? json_decode($settings->additional_costs, true) : [
            'hangtag' => 500,
            'woven' => 500,
            'label_brand_sablon' => 1000,
        ];

        // Harga express
        $hargaExpress = $settings && $settings->express_pricing ? json_decode($settings->express_pricing, true)['express_cost_per_piece'] ?? 10000 : 10000;

        // Hitung harga dasar per item
        $harga = $hargaProduk;
        
        // Tambah harga sablon
        if ($request->sablon && isset($hargaSablon[$request->sablon])) {
            $harga += $hargaSablon[$request->sablon];
        }
        
        // Hitung harga sablon berdasarkan jumlah warna
        $jumlahWarna = $request->jumlah_warna_sablon ?? 1;
        if ($jumlahWarna >= 1 && $jumlahWarna <= 4) {
            $harga += 20000; // Harga tetap 20.000 untuk 1-4 warna
        } elseif ($jumlahWarna > 4) {
            // Harga 25.000-30.000 untuk lebih dari 4 warna (gunakan rata-rata 27.500)
            $harga += 27500;
        }
        
        // Tambahan lain
        if ($request->has('tambahan_lain')) {
            foreach ($request->tambahan_lain as $tambahan) {
                if (isset($hargaTambahan[$tambahan])) {
                    $harga += $hargaTambahan[$tambahan];
                }
            }
        }
        
        // Hitung total sebelum diskon
        $totalSebelumDiskon = $harga * $request->kuantitas;
        
        // Hitung diskon berdasarkan kuantitas
        $diskon = 0;
        $quantitySettings = $settings && $settings->quantity_discounts ? json_decode($settings->quantity_discounts, true) : [
            'min_quantity' => 24,
            'discount_per_100' => 5000,
            'discount_threshold' => 100,
        ];
        
        if ($request->kuantitas > $quantitySettings['min_quantity']) {
            $kelipatan100 = floor($request->kuantitas / $quantitySettings['discount_threshold']);
            $diskon = $kelipatan100 * $quantitySettings['discount_per_100'] * $request->kuantitas;
        }
        
        // Hitung total setelah diskon
        $totalSetelahDiskon = $totalSebelumDiskon - $diskon;
        
        // Waktu pengerjaan
        $waktuPengerjaan = $request->waktu_pengerjaan;
        $isExpress = false;
        
        // Ambil pengaturan waktu pengerjaan
        $workingTimeSettings = $settings && $settings->working_time_settings ? json_decode($settings->working_time_settings, true) : [
            'kaos' => '2 minggu',
            'hoodie' => '2 minggu',
            'kemeja' => '3 minggu',
            'almamater' => '3 minggu',
            'jaket' => '2 minggu',
            'large_quantity_threshold' => 300,
            'large_quantity_multiplier' => 1.5,
        ];
        
        $durasiStandard = $workingTimeSettings[$request->jenis_produk] ?? '2 minggu';
        
        // Jika kuantitas > threshold, Standard jadi lebih lama
        if ($request->kuantitas > $workingTimeSettings['large_quantity_threshold'] && $waktuPengerjaan === 'Standard') {
            $durasiStandard = $this->getWaktuPengerjaanLama($request->jenis_produk, $workingTimeSettings);
        }
        
        if ($waktuPengerjaan === 'Express') {
            $isExpress = true;
        }
        
        // Harga express selalu kena jika pilih Express
        if ($isExpress) {
            $harga += $hargaExpress;
        }
        
        // Hitung ulang total dengan harga express
        if ($isExpress) {
            $totalSebelumDiskon = $harga * $request->kuantitas;
            $totalSetelahDiskon = $totalSebelumDiskon - $diskon;
        }
        
        // Info waktu pengerjaan
        if ($isExpress) {
            $estimasiPengerjaan = $this->getWaktuPengerjaanExpress($durasiStandard);
        } else {
            $estimasiPengerjaan = $durasiStandard . ' (Standard)';
        }
        
        // Simpan ke database
        $estimasi = EstimasiHarga::create([
            'jenis_produk' => $request->jenis_produk,
            'jenis_bahan' => $request->jenis_bahan,
            'warna_bahan' => $request->warna_bahan,
            'ukuran' => json_encode($request->ukuran ?? []),
            'model_jahitan' => $request->model_jahitan,
            'kuantitas' => $request->kuantitas,
            'sablon' => $request->sablon,
            'jumlah_warna_sablon' => $request->jumlah_warna_sablon,
            'tambahan_lain' => json_encode($request->tambahan_lain ?? []),
            'waktu_pengerjaan' => $request->waktu_pengerjaan,
            'harga_per_item' => $harga,
            'total_sebelum_diskon' => $totalSebelumDiskon,
            'diskon' => $diskon,
            'total_estimasi' => $totalSetelahDiskon,
            'estimasi_pengerjaan' => $estimasiPengerjaan,
        ]);
        
        // Log untuk debug
        Log::info('Estimasi calculation:', [
            'jenis_produk' => $request->jenis_produk,
            'jenis_bahan' => $request->jenis_bahan,
            'harga_produk' => $hargaProduk,
            'harga_final' => $harga,
            'kuantitas' => $request->kuantitas,
            'total_sebelum_diskon' => $totalSebelumDiskon,
            'diskon' => $diskon,
            'total_setelah_diskon' => $totalSetelahDiskon,
        ]);

        return response()->json([
            'success' => true,
            'harga_per_item' => $harga,
            'total_sebelum_diskon' => $totalSebelumDiskon,
            'diskon' => $diskon,
            'total_estimasi' => $totalSetelahDiskon,
            'estimasi_pengerjaan' => $estimasiPengerjaan,
        ]);
    }

    private function getWaktuPengerjaan($jenisProduk)
    {
        $settings = \App\Models\Setting::first();
        $workingTimeSettings = $settings && $settings->working_time_settings ? json_decode($settings->working_time_settings, true) : [
            'kaos' => '2 minggu',
            'hoodie' => '2 minggu',
            'kemeja' => '3 minggu',
            'almamater' => '3 minggu',
            'jaket' => '2 minggu',
        ];

        return $workingTimeSettings[$jenisProduk] ?? '2 minggu';
    }

    private function getWaktuPengerjaanLama($jenisProduk, $workingTimeSettings = null)
    {
        if (!$workingTimeSettings) {
            $settings = \App\Models\Setting::first();
            $workingTimeSettings = $settings && $settings->working_time_settings ? json_decode($settings->working_time_settings, true) : [
                'kaos' => '2 minggu',
                'hoodie' => '2 minggu',
                'kemeja' => '3 minggu',
                'almamater' => '3 minggu',
                'jaket' => '2 minggu',
                'large_quantity_multiplier' => 1.5,
            ];
        }
        
        $baseTime = $workingTimeSettings[$jenisProduk] ?? '2 minggu';
        $multiplier = $workingTimeSettings['large_quantity_multiplier'] ?? 1.5;
        
        // Extract number from time string and multiply
        if (preg_match('/(\d+)\s+minggu/', $baseTime, $matches)) {
            $weeks = (int)$matches[1];
            $newWeeks = ceil($weeks * $multiplier);
            return $newWeeks . ' minggu';
        }
        
        return $baseTime;
    }

    private function getWaktuPengerjaanExpress($durasiStandard)
    {
        // Extract angka dari string "X minggu"
        if (preg_match('/(\d+)\s+minggu/', $durasiStandard, $matches)) {
            $minggu = (int)$matches[1];
            $mingguExpress = max(1, $minggu - 1); // Minimal 1 minggu
            return $mingguExpress . ' minggu (Express)';
        }
        
        return '1 minggu (Express)';
    }

    public function produkList()
    {
        $produks = \App\Models\Produk::select('nama_produk')->distinct()->get();
        return response()->json($produks->pluck('nama_produk'));
    }

    public function getProdukList()
    {
        $produks = \App\Models\Produk::select('nama_produk')->distinct()->get();
        return response()->json($produks->pluck('nama_produk'));
    }

    public function getBahanByProduk($jenisProduk)
    {
        Log::info('getBahanByProduk called with: ' . $jenisProduk);
        
        // Coba ambil dari database dulu
        $produks = \App\Models\Produk::where('nama_produk', $jenisProduk)->get();
        
        if ($produks->count() > 0) {
            $bahanData = [];
            foreach ($produks as $produk) {
                $bahanData[$produk->jenis_bahan] = [
                    'nama' => ucfirst(str_replace('_', ' ', $produk->jenis_bahan)),
                    'deskripsi' => $this->getDeskripsiBahan($produk->jenis_bahan),
                    'warna' => $produk->warna_bahan
                ];
            }
            return response()->json($bahanData);
        }
        
        // Fallback ke data hardcoded jika database kosong
        $fallbackData = [
            'kaos' => [
                'cotton_combed' => [
                    'nama' => 'Katun Combed',
                    'deskripsi' => 'Katun halus, adem, nyaman untuk sehari-hari.',
                    'warna' => ['burgundy', 'maroon', 'chili red', 'fuchsia', 'pink', 'dusty rose', 'terracotta', 'orange', 'bright orange', 'gold', 'kuning lemon', 'mustard', 'coklat kopi', 'beige', 'cream', 'army green', 'olive green', 'seafoam green', 'electric lime', 'mint green', 'denim blue', 'steel blue', 'pastel blue', 'sky blue', 'turkis', 'navy', 'ungu tua', 'royal purple', 'lavender', 'lilac', 'magenta', 'jet black', 'light grey', 'broken white', 'putih netral']
                ],
                'polyester' => [
                    'nama' => 'Polyester',
                    'deskripsi' => 'Bahan ringan, cepat kering, tapi kurang menyerap keringat.',
                    'warna' => ['putih', 'hitam', 'navy']
                ],
                'cotton_bamboo' => [
                    'nama' => 'Katun Bamboo',
                    'deskripsi' => 'Super lembut, adem, anti-bakteri alami.',
                    'warna' => ['merah cabe', 'putih netral', 'hitam reaktif special', 'maroon', 'abu sedang', 'mustard', 'hijau botol special 2', 'beige', 'dusty pink', 'steel blue', 'kuning kenari', 'abu muda', 'tosca muda', 'mineral green', 'olive green', 'dark mustard', 'almond brown', 'coklat susu', 'deep blue', 'abu tua', 'dark navy']
                ],
                'supima' => [
                    'nama' => 'Supima',
                    'deskripsi' => 'Katun premium, kuat, halus, dan tahan warna.',
                    'warna' => ['putih bersih', 'hitam pekat', 'abu muda', 'abu charcoal', 'navy', 'cream', 'beige', 'coklat susu', 'sage green', 'terracotta', 'dusty pink', 'biru steel', 'maroon', 'olive', 'mustard gold']
                ]
            ],
            'hoodie' => [
                'fleece' => [
                    'nama' => 'Fleece',
                    'deskripsi' => 'Tebal, lembut, dan sangat hangat.',
                    'warna' => ['hitam', 'putih', 'maroon', 'navy', 'merah cabe', 'mustard', 'beige', 'steel blue', 'army green', 'lilac', 'dusty rose', 'cream', 'maroon']
                ],
                'babyterry' => [
                    'nama' => 'Babyterry',
                    'deskripsi' => 'Lebih tipis, bagian dalam halus, tetap nyaman.',
                    'warna' => ['hitam', 'navy', 'maroon', 'putih', 'mustard', 'steel blue', 'beige', 'army green', 'burgundy', 'merah cabe', 'olive green', 'dusty rose', 'seafoam', 'cinnamon', 'toffee', 'cream']
                ],
                'wol' => [
                    'nama' => 'Wol',
                    'deskripsi' => 'Sangat hangat, cocok untuk cuaca dingin berat.',
                    'warna' => ['hitam', 'abu-abu tua', 'abu muda', 'coklat kopi', 'maroon', 'navy', 'olive', 'beige', 'putih tulang', 'dusty pink', 'mustard', 'burgundy', 'charcoal grey']
                ]
            ],
            'almamater' => [
                'drill' => [
                    'nama' => 'Drill',
                    'deskripsi' => 'Kain kuat, sedikit tebal, tekstur diagonal.',
                    'warna' => ['navy', 'abu-abu muda', 'maroon', 'hitam', 'coklat kopi', 'hijau botol']
                ],
                'nagata_drill' => [
                    'nama' => 'Nagata Drill',
                    'deskripsi' => 'Lebih tebal dan adem dibanding drill biasa.',
                    'warna' => ['biru elektrik', 'merah maroon', 'hitam', 'abu-abu', 'coklat susu', 'hijau army']
                ]
            ],
            'kemeja' => [
                'katun' => [
                    'nama' => 'Katun',
                    'deskripsi' => 'Adem, lembut, nyaman untuk dipakai sehari-hari.',
                    'warna' => ['putih', 'hitam', 'biru langit', 'abu muda', 'krem', 'merah bata']
                ],
                'linen' => [
                    'nama' => 'Linen',
                    'deskripsi' => 'Adem, mewah, agak kaku alami.',
                    'warna' => ['putih gading', 'coklat muda', 'abu-abu', 'olive', 'biru pastel']
                ],
                'silk' => [
                    'nama' => 'Silk',
                    'deskripsi' => 'Halus, berkilau, mewah di badan.',
                    'warna' => ['champagne', 'hitam pekat', 'navy deep', 'burgundy', 'emerald']
                ],
                'oxford' => [
                    'nama' => 'Oxford',
                    'deskripsi' => 'Katun tebal bertekstur, formal dan nyaman.',
                    'warna' => ['putih', 'abu silver', 'biru muda', 'cream', 'coklat susu']
                ],
                'rayon' => [
                    'nama' => 'Rayon',
                    'deskripsi' => 'Lembut, jatuh di badan, adem.',
                    'warna' => ['hitam', 'mustard', 'hijau sage', 'lavender', 'dusty pink']
                ],
                'drill' => [
                    'nama' => 'Drill',
                    'deskripsi' => 'Kuat dan kokoh, cocok untuk kerja.',
                    'warna' => ['biru dongker', 'coklat tanah', 'hitam', 'abu-abu tua', 'hijau lumut']
                ],
                'polyester' => [
                    'nama' => 'Polyester',
                    'deskripsi' => 'Tahan lama, cepat kering, kurang adem.',
                    'warna' => ['hitam', 'merah', 'biru', 'orange', 'kuning cerah']
                ]
            ],
            'jaket' => [
                'kanvas' => [
                    'nama' => 'Kanvas',
                    'deskripsi' => 'Kuat, agak kasar, cocok untuk outdoor.',
                    'warna' => ['army', 'hitam', 'abu tua', 'coklat tanah', 'navy']
                ],
                'nilon' => [
                    'nama' => 'Nilon',
                    'deskripsi' => 'Ringan, tahan air, pas untuk jaket hujan.',
                    'warna' => ['hitam', 'abu gelap', 'merah maroon', 'olive', 'kuning stabilo']
                ],
                'fleece' => [
                    'nama' => 'Fleece',
                    'deskripsi' => 'Lembut dan sangat hangat.',
                    'warna' => ['hitam', 'abu', 'merah bata', 'biru navy', 'coklat mocca']
                ],
                'lotto' => [
                    'nama' => 'Lotto',
                    'deskripsi' => 'Elastis, halus, cocok untuk jaket olahraga.',
                    'warna' => ['hitam', 'merah tua', 'abu metalik', 'biru tua', 'hijau botol']
                ],
                'windbraker' => [
                    'nama' => 'Windbraker',
                    'deskripsi' => 'Ringan, tahan angin, pas untuk aktivitas luar ruangan.',
                    'warna' => ['hitam', 'tosca', 'silver', 'kuning cerah', 'merah cabai']
                ]
            ]
        ];
        
        return response()->json($fallbackData[$jenisProduk] ?? []);
    }

    private function getDeskripsiBahan($jenisBahan)
    {
        $deskripsi = [
            'cotton_combed' => 'Katun halus, adem, nyaman untuk sehari-hari.',
            'polyester' => 'Bahan ringan, cepat kering, tapi kurang menyerap keringat.',
            'cotton_bamboo' => 'Super lembut, adem, anti-bakteri alami.',
            'supima' => 'Katun premium, kuat, halus, dan tahan warna.',
            'fleece' => 'Tebal, lembut, dan sangat hangat.',
            'babyterry' => 'Lebih tipis, bagian dalam halus, tetap nyaman.',
            'wol' => 'Sangat hangat, cocok untuk cuaca dingin berat.',
            'drill' => 'Kain kuat, sedikit tebal, tekstur diagonal.',
            'nagata_drill' => 'Lebih tebal dan adem dibanding drill biasa.',
            'katun' => 'Adem, lembut, nyaman untuk dipakai sehari-hari.',
            'linen' => 'Adem, mewah, agak kaku alami.',
            'silk' => 'Halus, berkilau, mewah di badan.',
            'oxford' => 'Katun tebal bertekstur, formal dan nyaman.',
            'rayon' => 'Lembut, jatuh di badan, adem.',
            'kanvas' => 'Kuat, agak kasar, cocok untuk outdoor.',
            'nilon' => 'Ringan, tahan air, pas untuk jaket hujan.',
            'lotto' => 'Elastis, halus, cocok untuk jaket olahraga.',
            'windbraker' => 'Ringan, tahan angin, pas untuk aktivitas luar ruangan.',
        ];
        
        return $deskripsi[$jenisBahan] ?? 'Bahan berkualitas tinggi.';
    }

    public function getWarnaByBahan($jenisProduk, $jenisBahan)
    {
        Log::info('getWarnaByBahan called with: ' . $jenisProduk . ' - ' . $jenisBahan);
        
        // Coba ambil dari database dulu
        $produk = \App\Models\Produk::where('nama_produk', $jenisProduk)
                                    ->where('jenis_bahan', $jenisBahan)
                                    ->first();
        
        if ($produk && $produk->warna_bahan) {
            return response()->json([$produk->warna_bahan]);
        }
        
        // Fallback ke data hardcoded jika database kosong
        $fallbackWarna = $this->getFallbackWarna($jenisProduk, $jenisBahan);
        return response()->json($fallbackWarna);
    }

    private function getFallbackWarna($jenisProduk, $jenisBahan)
    {
        $warnaData = [
            'kaos' => [
                'cotton_combed' => ['burgundy', 'maroon', 'chili red', 'fuchsia', 'pink', 'dusty rose', 'terracotta', 'orange', 'bright orange', 'gold', 'kuning lemon', 'mustard', 'coklat kopi', 'beige', 'cream', 'army green', 'olive green', 'seafoam green', 'electric lime', 'mint green', 'denim blue', 'steel blue', 'pastel blue', 'sky blue', 'turkis', 'navy', 'ungu tua', 'royal purple', 'lavender', 'lilac', 'magenta', 'jet black', 'light grey', 'broken white', 'putih netral'],
                'polyester' => ['putih', 'hitam', 'navy'],
                'cotton_bamboo' => ['merah cabe', 'putih netral', 'hitam reaktif special', 'maroon', 'abu sedang', 'mustard', 'hijau botol special 2', 'beige', 'dusty pink', 'steel blue', 'kuning kenari', 'abu muda', 'tosca muda', 'mineral green', 'olive green', 'dark mustard', 'almond brown', 'coklat susu', 'deep blue', 'abu tua', 'dark navy'],
                'supima' => ['putih bersih', 'hitam pekat', 'abu muda', 'abu charcoal', 'navy', 'cream', 'beige', 'coklat susu', 'sage green', 'terracotta', 'dusty pink', 'biru steel', 'maroon', 'olive', 'mustard gold']
            ],
            'hoodie' => [
                'fleece' => ['hitam', 'putih', 'maroon', 'navy', 'merah cabe', 'mustard', 'beige', 'steel blue', 'army green', 'lilac', 'dusty rose', 'cream', 'maroon'],
                'babyterry' => ['hitam', 'navy', 'maroon', 'putih', 'mustard', 'steel blue', 'beige', 'army green', 'burgundy', 'merah cabe', 'olive green', 'dusty rose', 'seafoam', 'cinnamon', 'toffee', 'cream'],
                'wol' => ['hitam', 'abu-abu tua', 'abu muda', 'coklat kopi', 'maroon', 'navy', 'olive', 'beige', 'putih tulang', 'dusty pink', 'mustard', 'burgundy', 'charcoal grey']
            ],
            'almamater' => [
                'drill' => ['navy', 'abu-abu muda', 'maroon', 'hitam', 'coklat kopi', 'hijau botol'],
                'nagata_drill' => ['biru elektrik', 'merah maroon', 'hitam', 'abu-abu', 'coklat susu', 'hijau army']
            ],
            'kemeja' => [
                'katun' => ['putih', 'hitam', 'biru langit', 'abu muda', 'krem', 'merah bata'],
                'linen' => ['putih gading', 'coklat muda', 'abu-abu', 'olive', 'biru pastel'],
                'silk' => ['champagne', 'hitam pekat', 'navy deep', 'burgundy', 'emerald'],
                'oxford' => ['putih', 'abu silver', 'biru muda', 'cream', 'coklat susu'],
                'rayon' => ['hitam', 'mustard', 'hijau sage', 'lavender', 'dusty pink'],
                'drill' => ['biru dongker', 'coklat tanah', 'hitam', 'abu-abu tua', 'hijau lumut'],
                'polyester' => ['hitam', 'merah', 'biru', 'orange', 'kuning cerah']
            ],
            'jaket' => [
                'kanvas' => ['army', 'hitam', 'abu tua', 'coklat tanah', 'navy'],
                'nilon' => ['hitam', 'abu gelap', 'merah maroon', 'olive', 'kuning stabilo'],
                'fleece' => ['hitam', 'abu', 'merah bata', 'biru navy', 'coklat mocca'],
                'lotto' => ['hitam', 'merah tua', 'abu metalik', 'biru tua', 'hijau botol'],
                'windbraker' => ['hitam', 'tosca', 'silver', 'kuning cerah', 'merah cabai']
            ]
        ];
        
        return $warnaData[$jenisProduk][$jenisBahan] ?? [];
    }
} 