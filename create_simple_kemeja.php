<?php
// File untuk membuat gambar kemeja sederhana
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Buat Gambar Kemeja Sederhana ===\n\n";

// 1. Buat gambar sederhana dengan GD
$width = 300;
$height = 400;

// Buat canvas
$image = imagecreate($width, $height);

// Warna
$white = imagecolorallocate($image, 255, 255, 255);
$blue = imagecolorallocate($image, 0, 100, 200);
$black = imagecolorallocate($image, 0, 0, 0);

// Fill background putih
imagefill($image, 0, 0, $white);

// Gambar kemeja sederhana
// Badan kemeja
imagefilledrectangle($image, 50, 100, 250, 350, $blue);

// Kerah
imagefilledrectangle($image, 100, 80, 200, 120, $white);
imagefilledrectangle($image, 110, 90, 190, 110, $blue);

// Lengan
imagefilledrectangle($image, 30, 120, 70, 200, $blue);
imagefilledrectangle($image, 230, 120, 270, 200, $blue);

// Kancing
for ($i = 0; $i < 5; $i++) {
    imagefilledellipse($image, 150, 150 + ($i * 30), 8, 8, $white);
}

// Simpan gambar
$targetFile = 'public/img/kemeja-default.png';
imagepng($image, $targetFile);
imagedestroy($image);

echo "✓ Gambar kemeja sederhana dibuat: {$targetFile}\n";

// 2. Update database
$affected = DB::table('galeri_pratinjau')
    ->where('jenis_produk', 'kemeja')
    ->update(['foto_pratinjau' => 'img/kemeja-default.png']);

echo "✓ Database diupdate: {$affected} record kemeja\n";

echo "\n✅ Selesai! Gambar kemeja sudah diperbaiki.\n"; 