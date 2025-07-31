<?php
// File untuk mengupload gambar portfolio yang asli ke storage
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Upload Gambar Portfolio Asli ===\n\n";

// 1. Buat direktori storage
$storageDir = 'storage/app/public/galeri_pratinjau/';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "✓ Created directory: {$storageDir}\n";
}

// 2. Daftar gambar portfolio yang perlu dibuat
$portfolioImages = [
    'cimsa-portfolio.jpg',
    'cimsa-2-portfolio.jpg',
    'cimsa-3-portfolio.jpg',
    'himatra-portfolio.jpg',
    'himatra-1-portfolio.jpg',
    'himatra-2-portfolio.jpg',
    'himatra-3-portfolio.jpg',
    'kkn-155-portfolio.jpg',
    'kkn-155-1-portfolio.jpg',
    'kkn-155-2-portfolio.jpg',
    'kkn-155-3-portfolio.jpg',
    'kkn-pinisi-portfolio.jpg',
    'kkn-pinisi-1-portfolio.jpg',
    'kkn-pinisi-2-portfolio.jpg',
    'kkn-pinisi-3-portfolio.jpg',
    'lentera-portfolio.jpg',
    'lentera-1-portfolio.jpg',
    'lentera-2-portfolio.jpg',
    'lentera-3-portfolio.jpg',
    'militan-perum-portfolio.jpg',
    'militan-perum-1-portfolio.jpg',
    'militan-perum-2-portfolio.jpg',
    'militan-perum-3-portfolio.jpg'
];

// 3. Buat gambar placeholder untuk setiap portfolio
echo "2. Membuat gambar portfolio...\n";
$sourceFile = 'public/img/kaos-default.png';

foreach ($portfolioImages as $filename) {
    $targetFile = $storageDir . $filename;
    
    if (!file_exists($targetFile)) {
        if (file_exists($sourceFile)) {
            copy($sourceFile, $targetFile);
            echo "✓ Created: {$filename}\n";
        } else {
            echo "❌ Source file tidak ada: {$sourceFile}\n";
        }
    } else {
        echo "✓ Already exists: {$filename}\n";
    }
}

// 4. Update database dengan path yang benar
echo "\n3. Update database...\n";
$data = DB::table('galeri_pratinjau')->get();

foreach ($data as $item) {
    // Buat nama file berdasarkan nama produk
    $filename = strtolower(str_replace(' ', '-', $item->nama_produk)) . '-portfolio.jpg';
    $newPath = 'galeri_pratinjau/' . $filename;
    
    $affected = DB::table('galeri_pratinjau')
        ->where('id', $item->id)
        ->update(['foto_pratinjau' => $newPath]);
    
    echo "✓ Updated {$item->nama_produk}: {$newPath}\n";
}

// 5. Cek hasil
echo "\n4. Data setelah update:\n";
$dataAfter = DB::table('galeri_pratinjau')->get();
foreach ($dataAfter as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

echo "\n✅ Selesai! Gambar portfolio sudah diupload ke storage.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n";
echo "⚠️  Note: Untuk gambar portfolio yang asli, Anda perlu upload file gambar yang sebenarnya.\n"; 