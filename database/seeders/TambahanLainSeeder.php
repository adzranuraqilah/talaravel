<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TambahanLain;

class TambahanLainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tambahanLains = [
            [
                'nama_tambahan' => 'Hangtag',
                'harga' => 2000,
                'deskripsi' => 'Label gantung untuk produk'
            ],
            [
                'nama_tambahan' => 'Woven',
                'harga' => 5000,
                'deskripsi' => 'Label tenun berkualitas tinggi'
            ],
            [
                'nama_tambahan' => 'Label Brand Sablon',
                'harga' => 3000,
                'deskripsi' => 'Label brand dengan teknik sablon'
            ],
        ];

        foreach ($tambahanLains as $tambahanLain) {
            TambahanLain::create($tambahanLain);
        }
    }
} 