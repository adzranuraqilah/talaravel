<?php
// File untuk memperbaiki masalah tabel galeri_pratinjau
// Jalankan dengan: php fix_galeri_pratinjau.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "=== Memperbaiki Tabel galeri_pratinjau ===\n\n";
    
    // 1. Pastikan tabel galeri_pratinjau ada
    if (!Schema::hasTable('galeri_pratinjau')) {
        Schema::create('galeri_pratinjau', function ($table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->string('foto_pratinjau');
            $table->timestamps();
        });
        echo "✓ Tabel galeri_pratinjau berhasil dibuat!\n";
    } else {
        echo "✓ Tabel galeri_pratinjau sudah ada!\n";
    }
    
    // 2. Cek apakah tabel galeri_pratinjaus ada
    if (Schema::hasTable('galeri_pratinjaus')) {
        echo "✓ Tabel galeri_pratinjaus ditemukan!\n";
        
        // 3. Hapus data lama di galeri_pratinjau
        DB::table('galeri_pratinjau')->delete();
        echo "✓ Data lama di galeri_pratinjau dihapus!\n";
        
        // 4. Copy data dari galeri_pratinjaus ke galeri_pratinjau
        $dataFromPlural = DB::table('galeri_pratinjaus')->get();
        echo "✓ Ditemukan " . $dataFromPlural->count() . " data di galeri_pratinjaus\n";
        
        foreach ($dataFromPlural as $item) {
            // Tentukan jenis_produk berdasarkan nama_produk
            $jenis_produk = 'kaos'; // default
            $nama_lower = strtolower($item->nama_produk);
            
            if (strpos($nama_lower, 'hoodie') !== false) {
                $jenis_produk = 'hoodie';
            } elseif (strpos($nama_lower, 'kemeja') !== false) {
                $jenis_produk = 'kemeja';
            } elseif (strpos($nama_lower, 'jaket') !== false) {
                $jenis_produk = 'jaket';
            }
            
            DB::table('galeri_pratinjau')->insert([
                'nama_produk' => $item->nama_produk,
                'jenis_produk' => $jenis_produk,
                'foto_pratinjau' => $item->foto_pratinjau,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
        echo "✓ Data berhasil dipindahkan dari galeri_pratinjaus ke galeri_pratinjau!\n";
        
    } else {
        echo "⚠ Tabel galeri_pratinjaus tidak ditemukan!\n";
        
        // 5. Tambah data sample jika tidak ada data
        $count = DB::table('galeri_pratinjau')->count();
        if ($count == 0) {
            DB::table('galeri_pratinjau')->insert([
                [
                    'nama_produk' => 'Kaos Polos',
                    'jenis_produk' => 'kaos',
                    'foto_pratinjau' => 'galeri_pratinjau/kaos-sample.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_produk' => 'Hoodie Basic',
                    'jenis_produk' => 'hoodie',
                    'foto_pratinjau' => 'galeri_pratinjau/hoodie-sample.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_produk' => 'Kemeja Formal',
                    'jenis_produk' => 'kemeja',
                    'foto_pratinjau' => 'galeri_pratinjau/kemeja-sample.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_produk' => 'Jaket Denim',
                    'jenis_produk' => 'jaket',
                    'foto_pratinjau' => 'galeri_pratinjau/jaket-sample.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            echo "✓ Data sample berhasil ditambahkan!\n";
        }
    }
    
    // 6. Tampilkan hasil
    $finalData = DB::table('galeri_pratinjau')->get();
    echo "\n=== Data di galeri_pratinjau ===\n";
    echo "Total data: " . $finalData->count() . "\n\n";
    
    foreach ($finalData as $item) {
        echo "- ID: {$item->id}\n";
        echo "  Nama: {$item->nama_produk}\n";
        echo "  Jenis: {$item->jenis_produk}\n";
        echo "  Foto: {$item->foto_pratinjau}\n";
        echo "  Created: {$item->created_at}\n";
        echo "  ---\n";
    }
    
    echo "\n✅ Selesai! Sekarang riwayat pratinjau seharusnya muncul di halaman custom.\n";
    echo "💡 Tips: Buka halaman /custom dan pilih jenis produk untuk melihat riwayat pratinjau.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
} 