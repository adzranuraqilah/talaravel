<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            // Kaos
            [
                'nama_produk' => 'kaos',
                'jenis_bahan' => 'cotton_combed',
                'warna_bahan' => 'putih netral',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode(['hangtag']),
                'harga' => 37000,
            ],
            [
                'nama_produk' => 'kaos',
                'jenis_bahan' => 'polyester',
                'warna_bahan' => 'hitam',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'rubber',
                'jumlah_warna_sablon' => 1,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode([]),
                'harga' => 27000,
            ],
            [
                'nama_produk' => 'kaos',
                'jenis_bahan' => 'cotton_bamboo',
                'warna_bahan' => 'merah cabe',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'dtg',
                'jumlah_warna_sablon' => 3,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode(['woven']),
                'harga' => 42000,
            ],
            
            // Hoodie
            [
                'nama_produk' => 'hoodie',
                'jenis_bahan' => 'fleece',
                'warna_bahan' => 'hitam',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode(['hangtag']),
                'harga' => 122000,
            ],
            [
                'nama_produk' => 'hoodie',
                'jenis_bahan' => 'babyterry',
                'warna_bahan' => 'navy',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'rubber',
                'jumlah_warna_sablon' => 1,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode([]),
                'harga' => 97000,
            ],
            
            // Almamater
            [
                'nama_produk' => 'almamater',
                'jenis_bahan' => 'drill',
                'warna_bahan' => 'navy',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'waktu_pengerjaan' => '21 hari',
                'tambahan_lain' => json_encode(['label_brand_sablon']),
                'harga' => 102000,
            ],
            [
                'nama_produk' => 'almamater',
                'jenis_bahan' => 'nagata_drill',
                'warna_bahan' => 'biru elektrik',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'bordir',
                'jumlah_warna_sablon' => 1,
                'waktu_pengerjaan' => '21 hari',
                'tambahan_lain' => json_encode(['woven']),
                'harga' => 122000,
            ],
            
            // Kemeja
            [
                'nama_produk' => 'kemeja',
                'jenis_bahan' => 'katun',
                'warna_bahan' => 'putih',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'waktu_pengerjaan' => '21 hari',
                'tambahan_lain' => json_encode(['hangtag']),
                'harga' => 57000,
            ],
            [
                'nama_produk' => 'kemeja',
                'jenis_bahan' => 'linen',
                'warna_bahan' => 'putih gading',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'rubber',
                'jumlah_warna_sablon' => 1,
                'waktu_pengerjaan' => '21 hari',
                'tambahan_lain' => json_encode([]),
                'harga' => 62000,
            ],
            
            // Jaket
            [
                'nama_produk' => 'jaket',
                'jenis_bahan' => 'kanvas',
                'warna_bahan' => 'army',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL', 'XXL']),
                'model_jahitan' => 'standar',
                'sablon' => 'plastisol',
                'jumlah_warna_sablon' => 2,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode(['hangtag']),
                'harga' => 157000,
            ],
            [
                'nama_produk' => 'jaket',
                'jenis_bahan' => 'nilon',
                'warna_bahan' => 'hitam',
                'ukuran' => json_encode(['S', 'M', 'L', 'XL']),
                'model_jahitan' => 'standar',
                'sablon' => 'rubber',
                'jumlah_warna_sablon' => 1,
                'waktu_pengerjaan' => '14 hari',
                'tambahan_lain' => json_encode([]),
                'harga' => 82000,
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
