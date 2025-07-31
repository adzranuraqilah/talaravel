<?php
// File untuk memperbaiki gambar kemeja
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Perbaiki Gambar Kemeja ===\n\n";

// 1. Buat gambar kemeja baru dari kaos
$sourceFile = 'public/img/kaos-default.png';
$targetFile = 'public/img/kemeja-default.png';

if (file_exists($sourceFile)) {
    copy($sourceFile, $targetFile);
    echo "✓ Gambar kemeja dibuat dari kaos\n";
} else {
    echo "❌ File kaos tidak ditemukan\n";
}

// 2. Update database untuk kemeja
$affected = DB::table('galeri_pratinjau')
    ->where('jenis_produk', 'kemeja')
    ->update(['foto_pratinjau' => 'img/kemeja-default.png']);

echo "✓ Database diupdate: {$affected} record kemeja\n";

// 3. Cek hasil
$kemejaData = DB::table('galeri_pratinjau')->where('jenis_produk', 'kemeja')->get();
echo "\nData kemeja setelah update:\n";
foreach ($kemejaData as $item) {
    echo "- {$item->nama_produk}: {$item->foto_pratinjau}\n";
}

echo "\n✅ Selesai! Coba refresh halaman custom.\n"; 