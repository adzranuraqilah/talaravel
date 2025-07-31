<?php
// File untuk memperbaiki gambar di halaman admin galeri
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Perbaiki Gambar Admin Galeri ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Pastikan file gambar ada
echo "\n2. Membuat file gambar...\n";
$sourceFile = 'public/img/kaos-default.png';
$imageFiles = [
    'kaos' => 'public/img/kaos-default.png',
    'hoodie' => 'public/img/hoodie-default.png',
    'kemeja' => 'public/img/kemeja-default.png',
    'jaket' => 'public/img/jaket-default.png'
];

foreach ($imageFiles as $jenis => $file) {
    if (!file_exists($file)) {
        if (file_exists($sourceFile)) {
            copy($sourceFile, $file);
            echo "✓ Created: {$file}\n";
        } else {
            echo "❌ Source file tidak ada: {$sourceFile}\n";
        }
    } else {
        echo "✓ Already exists: {$file}\n";
    }
}

// 3. Update database dengan path yang benar
echo "\n3. Update database...\n";
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

// 4. Cek hasil
echo "\n4. Data setelah update:\n";
$dataAfter = DB::table('galeri_pratinjau')->get();
foreach ($dataAfter as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

echo "\n✅ Selesai! Sekarang gambar seharusnya muncul di admin galeri.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n"; 