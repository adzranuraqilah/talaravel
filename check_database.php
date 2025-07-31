<?php
// File untuk cek dan update database
// Jalankan dengan: php check_database.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "=== Cek dan Update Database ===\n\n";
    
    // 1. Cek data saat ini
    echo "1. Data saat ini di database:\n";
    $data = DB::table('galeri_pratinjau')->get();
    foreach ($data as $item) {
        echo "   - {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
    }
    
    // 2. Update path gambar
    echo "\n2. Update path gambar...\n";
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
    
    // 3. Cek data setelah update
    echo "\n3. Data setelah update:\n";
    $dataAfter = DB::table('galeri_pratinjau')->get();
    foreach ($dataAfter as $item) {
        echo "   - {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
    }
    
    // 4. Test URL gambar
    echo "\n4. Test URL gambar:\n";
    foreach ($dataAfter as $item) {
        $url = asset($item->foto_pratinjau);
        echo "   - {$item->nama_produk}: {$url}\n";
    }
    
    echo "\n✅ Selesai! Database berhasil diupdate.\n";
    echo "💡 Tips: Refresh halaman custom untuk melihat perubahan.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 