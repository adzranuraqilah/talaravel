<?php
// File untuk mengembalikan path gambar ke storage yang benar
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Kembalikan Path Gambar ke Storage ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Buat file gambar di storage
echo "\n2. Membuat file gambar di storage...\n";
$sourceFile = 'public/img/kaos-default.png';
$storageDir = 'storage/app/public/galeri_pratinjau/';

// Buat direktori jika belum ada
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "✓ Created directory: {$storageDir}\n";
}

// Copy file gambar ke storage
$imageFiles = [
    'kaos' => 'kaos-default.png',
    'hoodie' => 'hoodie-default.png',
    'kemeja' => 'kemeja-default.png',
    'jaket' => 'jaket-default.png'
];

foreach ($imageFiles as $jenis => $filename) {
    $targetFile = $storageDir . $filename;
    if (file_exists($sourceFile)) {
        copy($sourceFile, $targetFile);
        echo "✓ Created: {$targetFile}\n";
    } else {
        echo "❌ Source file tidak ada: {$sourceFile}\n";
    }
}

// 3. Update database dengan path storage yang benar
echo "\n3. Update database ke path storage...\n";
$updates = [
    'kaos' => 'galeri_pratinjau/kaos-default.png',
    'hoodie' => 'galeri_pratinjau/hoodie-default.png',
    'kemeja' => 'galeri_pratinjau/kemeja-default.png',
    'jaket' => 'galeri_pratinjau/jaket-default.png'
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

// 5. Test URL
echo "\n5. Test URL gambar:\n";
foreach ($dataAfter as $item) {
    $url = asset('storage/' . $item->foto_pratinjau);
    echo "- {$item->nama_produk}: {$url}\n";
}

echo "\n✅ Selesai! Path gambar sudah dikembalikan ke storage.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n"; 