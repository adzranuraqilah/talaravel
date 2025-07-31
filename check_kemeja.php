<?php
// File khusus untuk cek data kemeja
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Cek Data Kemeja ===\n\n";

// Cek data kemeja
$kemejaData = DB::table('galeri_pratinjau')->where('jenis_produk', 'kemeja')->get();

echo "Data kemeja di database:\n";
foreach ($kemejaData as $item) {
    echo "- {$item->nama_produk}: {$item->foto_pratinjau}\n";
}

// Cek file gambar
echo "\nCek file gambar:\n";
$imagePath = 'public/img/kemeja-default.png';
if (file_exists($imagePath)) {
    echo "✓ File ada: {$imagePath}\n";
    echo "  Ukuran: " . filesize($imagePath) . " bytes\n";
} else {
    echo "❌ File tidak ada: {$imagePath}\n";
}

// Test URL
echo "\nTest URL:\n";
foreach ($kemejaData as $item) {
    $url = asset($item->foto_pratinjau);
    echo "- {$item->nama_produk}: {$url}\n";
} 