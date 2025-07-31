<?php
// File untuk memperbaiki path database agar gambar portfolio asli muncul
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Perbaiki Path Database ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Update database dengan path yang benar untuk gambar portfolio asli
echo "\n2. Update database dengan path yang benar...\n";

// Mapping nama produk ke path yang sudah ada di database
$portfolioMapping = [
    'Cimsa' => 'galeri_pratinjau/cimsa-real.jpg',
    'Cimsa 2' => 'galeri_pratinjau/cimsa-2-real.jpg', 
    'Cimsa 3' => 'galeri_pratinjau/cimsa-3-real.jpg',
    'Himatra' => 'galeri_pratinjau/himatra-real.jpg',
    'Himatra 1' => 'galeri_pratinjau/himatra-1-real.jpg',
    'Himatra 2' => 'galeri_pratinjau/himatra-2-real.jpg',
    'Himatra 3' => 'galeri_pratinjau/himatra-3-real.jpg',
    'KKN 155' => 'galeri_pratinjau/kkn-155-real.jpg',
    'KKN 155 1' => 'galeri_pratinjau/kkn-155-1-real.jpg',
    'KKN 155 2' => 'galeri_pratinjau/kkn-155-2-real.jpg',
    'KKN 155 3' => 'galeri_pratinjau/kkn-155-3-real.jpg',
    'kkn pinisi' => 'galeri_pratinjau/kkn-pinisi-real.jpg',
    'kkn pinisi 1' => 'galeri_pratinjau/kkn-pinisi-1-real.jpg',
    'kkn pinisi 2' => 'galeri_pratinjau/kkn-pinisi-2-real.jpg',
    'kkn pinisi 3' => 'galeri_pratinjau/kkn-pinisi-3-real.jpg',
    'Lentera' => 'galeri_pratinjau/lentera-real.jpg',
    'Lentera 1' => 'galeri_pratinjau/lentera-1-real.jpg',
    'Lentera 2' => 'galeri_pratinjau/lentera-2-real.jpg',
    'Lentera 3' => 'galeri_pratinjau/lentera-3-real.jpg',
    'Militan Perum' => 'galeri_pratinjau/militan-perum-real.jpg',
    'Militan Perum 1' => 'galeri_pratinjau/militan-perum-1-real.jpg',
    'Militan Perum 2' => 'galeri_pratinjau/militan-perum-2-real.jpg',
    'Militan Perum 3' => 'galeri_pratinjau/militan-perum-3-real.jpg'
];

// Update setiap record berdasarkan nama produk
foreach ($data as $item) {
    if (isset($portfolioMapping[$item->nama_produk])) {
        $newPath = $portfolioMapping[$item->nama_produk];
        
        $affected = DB::table('galeri_pratinjau')
            ->where('id', $item->id)
            ->update(['foto_pratinjau' => $newPath]);
        
        echo "✓ Updated {$item->nama_produk}: {$newPath}\n";
    } else {
        echo "⚠️  No mapping found for: {$item->nama_produk}\n";
    }
}

// 3. Cek hasil
echo "\n3. Data setelah update:\n";
$dataAfter = DB::table('galeri_pratinjau')->get();
foreach ($dataAfter as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

echo "\n✅ Selesai! Database sudah diupdate dengan path yang benar.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n"; 