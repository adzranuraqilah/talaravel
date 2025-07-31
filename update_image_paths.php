<?php
// File untuk update path gambar di database
// Jalankan dengan: php update_image_paths.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "=== Update Path Gambar di Database ===\n\n";
    
    // Update path gambar berdasarkan jenis_produk
    $updates = [
        'kaos' => 'img/kaos-default.png',
        'hoodie' => 'img/hoodie-default.png', 
        'kemeja' => 'img/kemeja-default.png',
        'jaket' => 'img/jaket-default.png'
    ];
    
    foreach ($updates as $jenis => $path) {
        $affected = DB::table('galeri_pratinjau')
            ->where('jenis_produk', $jenis)
            ->update(['foto_pratinjau' => $path]);
        
        echo "✓ Updated {$jenis}: {$affected} records -> {$path}\n";
    }
    
    // Tampilkan hasil
    $data = DB::table('galeri_pratinjau')->get();
    echo "\n=== Data Setelah Update ===\n";
    foreach ($data as $item) {
        echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
    }
    
    echo "\n✅ Selesai! Path gambar berhasil diupdate.\n";
    echo "💡 Tips: Sekarang gambar seharusnya muncul menggunakan file yang sudah ada di public/img/\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 