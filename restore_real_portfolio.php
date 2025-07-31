<?php
// File untuk mengembalikan database ke gambar portfolio yang asli
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Kembalikan ke Gambar Portfolio Asli ===\n\n";

// 1. Cek data saat ini
echo "1. Data saat ini:\n";
$data = DB::table('galeri_pratinjau')->get();
foreach ($data as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

// 2. Update database dengan gambar portfolio yang asli
echo "\n2. Update database dengan gambar portfolio asli...\n";

// Mapping nama produk ke file gambar yang sesuai dengan portfolio asli
$portfolioMapping = [
    'Cimsa' => 'cimsa-real.jpg',
    'Cimsa 2' => 'cimsa-2-real.jpg', 
    'Cimsa 3' => 'cimsa-3-real.jpg',
    'Himatra' => 'himatra-real.jpg',
    'Himatra 1' => 'himatra-1-real.jpg',
    'Himatra 2' => 'himatra-2-real.jpg',
    'Himatra 3' => 'himatra-3-real.jpg',
    'KKN 155' => 'kkn-155-real.jpg',
    'KKN 155 1' => 'kkn-155-1-real.jpg',
    'KKN 155 2' => 'kkn-155-2-real.jpg',
    'KKN 155 3' => 'kkn-155-3-real.jpg',
    'kkn pinisi' => 'kkn-pinisi-real.jpg',
    'kkn pinisi 1' => 'kkn-pinisi-1-real.jpg',
    'kkn pinisi 2' => 'kkn-pinisi-2-real.jpg',
    'kkn pinisi 3' => 'kkn-pinisi-3-real.jpg',
    'Lentera' => 'lentera-real.jpg',
    'Lentera 1' => 'lentera-1-real.jpg',
    'Lentera 2' => 'lentera-2-real.jpg',
    'Lentera 3' => 'lentera-3-real.jpg',
    'Militan Perum' => 'militan-perum-real.jpg',
    'Militan Perum 1' => 'militan-perum-1-real.jpg',
    'Militan Perum 2' => 'militan-perum-2-real.jpg',
    'Militan Perum 3' => 'militan-perum-3-real.jpg'
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

// 3. Buat file gambar portfolio di storage
echo "\n3. Membuat file gambar portfolio di storage...\n";
$storageDir = 'storage/app/public/galeri_pratinjau/';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0755, true);
    echo "✓ Created directory: {$storageDir}\n";
}

// Buat gambar placeholder untuk setiap portfolio
$sourceFile = 'public/img/kaos-default.png';
foreach ($portfolioMapping as $nama => $filename) {
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

// 4. Cek hasil
echo "\n4. Data setelah update:\n";
$dataAfter = DB::table('galeri_pratinjau')->get();
foreach ($dataAfter as $item) {
    echo "- {$item->nama_produk} ({$item->jenis_produk}): {$item->foto_pratinjau}\n";
}

echo "\n✅ Selesai! Database sudah dikembalikan ke gambar portfolio asli.\n";
echo "💡 Tips: Refresh halaman admin galeri untuk melihat perubahan.\n";
echo "⚠️  Note: Untuk gambar portfolio yang asli, Anda perlu upload file gambar yang sebenarnya.\n"; 