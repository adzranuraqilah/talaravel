<?php
// File untuk mengupdate database dengan gambar portfolio yang asli
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Update ke Gambar Portfolio Asli ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Update database dengan gambar portfolio yang asli
echo "\n2. Update database dengan gambar portfolio asli...\n";

// Mapping nama produk ke file gambar yang sesuai
$portfolioMapping = [
    'Cimsa' => 'cimsa-portfolio.jpg',
    'Cimsa 2' => 'cimsa-2-portfolio.jpg', 
    'Cimsa 3' => 'cimsa-3-portfolio.jpg',
    'Himatra' => 'himatra-portfolio.jpg',
    'Himatra 1' => 'himatra-1-portfolio.jpg',
    'Himatra 2' => 'himatra-2-portfolio.jpg',
    'Himatra 3' => 'himatra-3-portfolio.jpg',
    'KKN 155' => 'kkn-155-portfolio.jpg',
    'KKN 155 1' => 'kkn-155-1-portfolio.jpg',
    'KKN 155 2' => 'kkn-155-2-portfolio.jpg',
    'KKN 155 3' => 'kkn-155-3-portfolio.jpg',
    'kkn pinisi' => 'kkn-pinisi-portfolio.jpg',
    'kkn pinisi 1' => 'kkn-pinisi-1-portfolio.jpg',
    'kkn pinisi 2' => 'kkn-pinisi-2-portfolio.jpg',
    'kkn pinisi 3' => 'kkn-pinisi-3-portfolio.jpg',
    'Lentera' => 'lentera-portfolio.jpg',
    'Lentera 1' => 'lentera-1-portfolio.jpg',
    'Lentera 2' => 'lentera-2-portfolio.jpg',
    'Lentera 3' => 'lentera-3-portfolio.jpg',
    'Militan Perum' => 'militan-perum-portfolio.jpg',
    'Militan Perum 1' => 'militan-perum-1-portfolio.jpg',
    'Militan Perum 2' => 'militan-perum-2-portfolio.jpg',
    'Militan Perum 3' => 'militan-perum-3-portfolio.jpg'
];

// Update setiap record berdasarkan nama produk
foreach ($data as $item) {
    if (isset($portfolioMapping[$item->nama_produk])) {
        $newPath = 'galeri_pratinjau/' . $portfolioMapping[$item->nama_produk];
        
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

echo "\n✅ Selesai! Database sudah diupdate dengan gambar portfolio asli.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n";
echo "⚠️  Note: Pastikan file gambar portfolio sudah ada di storage/app/public/galeri_pratinjau/\n"; 