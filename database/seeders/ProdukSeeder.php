<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            [
                'nama_produk' => 'kaos',
                'jenis_bahan' => 'cotton_combed',
                'warna_bahan' => 'putih',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'tambahan_lain' => json_encode(['hangtag']),
                'waktu_pengerjaan' => 'Standard',
                'harga' => 37000,
            ],
            [
                'nama_produk' => 'kaos',
                'jenis_bahan' => 'polyester',
                'warna_bahan' => 'hitam',
                'ukuran' => json_encode(['M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'rubber',
                'jumlah_warna_sablon' => 3,
                'tambahan_lain' => json_encode(['woven']),
                'waktu_pengerjaan' => 'Express',
                'harga' => 27000,
            ],
            [
                'nama_produk' => 'hoodie',
                'jenis_bahan' => 'fleece',
                'warna_bahan' => 'abu',
                'ukuran' => json_encode(['L', 'XL', 'XXL']),
                'model_jahitan' => 'overdeck',
                'sablon' => 'dtg',
                'jumlah_warna_sablon' => 5,
                'tambahan_lain' => json_encode(['label_brand_sablon']),
                'waktu_pengerjaan' => 'Standard',
                'harga' => 122000,
            ],
            [
                'nama_produk' => 'kemeja',
                'jenis_bahan' => 'katun',
                'warna_bahan' => 'putih',
                'ukuran' => json_encode(['S', 'M', 'L']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 1,
                'tambahan_lain' => json_encode([]),
                'waktu_pengerjaan' => 'Standard',
                'harga' => 57000,
            ],
            [
                'nama_produk' => 'jaket',
                'jenis_bahan' => 'kanvas',
                'warna_bahan' => 'hitam',
                'ukuran' => json_encode(['M', 'L', 'XL']),
                'model_jahitan' => 'rantai',
                'sablon' => 'bordir',
                'jumlah_warna_sablon' => 4,
                'tambahan_lain' => json_encode(['hangtag', 'label_brand_sablon']),
                'waktu_pengerjaan' => 'Express',
                'harga' => 157000,
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
