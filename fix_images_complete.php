<?php
// File lengkap untuk memperbaiki masalah gambar
// Jalankan dengan: php fix_images_complete.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "=== Memperbaiki Masalah Gambar ===\n\n";
    
    // 1. Buat gambar default
    echo "1. Membuat gambar default...\n";
    $sourceFile = 'public/img/kaos-default.png';
    $targetFiles = [
        'public/img/hoodie-default.png',
        'public/img/kemeja-default.png', 
        'public/img/jaket-default.png'
    ];
    
    if (file_exists($sourceFile)) {
        foreach ($targetFiles as $targetFile) {
            if (!file_exists($targetFile)) {
                copy($sourceFile, $targetFile);
                echo "   ✓ Created: {$targetFile}\n";
            } else {
                echo "   ✓ Already exists: {$targetFile}\n";
            }
        }
    } else {
        echo "   ❌ Error: File source tidak ditemukan!\n";
    }
    
    // 2. Update database
    echo "\n2. Update database...\n";
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
        
        echo "   ✓ Updated {$jenis}: {$affected} records -> {$path}\n";
    }
    
    // 3. Tampilkan hasil
    echo "\n3. Data di database:\n";
    $data = DB::table('galeri_pratinjau')->get();
    foreach ($data as $item) {
        echo "   - {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
    }
    
    echo "\n✅ Selesai! Sekarang gambar seharusnya muncul.\n";
    echo "💡 Tips: Refresh halaman custom untuk melihat perubahan.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 