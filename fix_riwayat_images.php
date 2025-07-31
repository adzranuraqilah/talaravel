<?php
// File untuk memperbaiki gambar di riwayat foto pratinjau
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Perbaiki Gambar di Riwayat ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Pastikan semua file gambar ada
echo "\n2. Membuat file gambar yang hilang...\n";
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

// 5. Test URL
echo "\n5. Test URL gambar:\n";
foreach ($dataAfter as $item) {
    $url = asset($item->foto_pratinjau);
    echo "- {$item->nama_produk}: {$url}\n";
}

echo "\n✅ Selesai! Sekarang gambar seharusnya muncul di riwayat.\n";
echo "💡 Tips: Refresh halaman custom untuk melihat perubahan.\n"; 