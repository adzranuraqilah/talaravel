<?php
// File untuk membuat gambar sample
// Jalankan dengan: php create_sample_images.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Storage;

try {
    echo "=== Membuat Gambar Sample ===\n\n";
    
    // 1. Buat folder jika belum ada
    $storagePath = storage_path('app/public/galeri_pratinjau');
    if (!file_exists($storagePath)) {
        mkdir($storagePath, 0755, true);
        echo "✓ Folder storage/app/public/galeri_pratinjau dibuat!\n";
    } else {
        echo "✓ Folder storage/app/public/galeri_pratinjau sudah ada!\n";
    }
    
    // 2. Buat gambar sample dengan GD
    $sampleImages = [
        'kaos-sample.jpg' => '#FF6B6B',    // Merah
        'hoodie-sample.jpg' => '#4ECDC4',  // Cyan
        'kemeja-sample.jpg' => '#45B7D1',  // Biru
        'jaket-sample.jpg' => '#96CEB4',   // Hijau
    ];
    
    foreach ($sampleImages as $filename => $color) {
        $filepath = $storagePath . '/' . $filename;
        
        if (!file_exists($filepath)) {
            // Buat gambar 200x200 pixel
            $image = imagecreate(200, 200);
            
            // Set warna background
            $bgColor = imagecolorallocate($image, 
                hexdec(substr($color, 1, 2)), 
                hexdec(substr($color, 3, 2)), 
                hexdec(substr($color, 5, 2))
            );
            
            // Set warna text
            $textColor = imagecolorallocate($image, 255, 255, 255);
            
            // Tambah text
            $text = str_replace('-sample.jpg', '', $filename);
            $text = str_replace('-', ' ', $text);
            $text = ucwords($text);
            
            // Center text
            $fontSize = 5;
            $textWidth = imagefontwidth($fontSize) * strlen($text);
            $textHeight = imagefontheight($fontSize);
            $x = (200 - $textWidth) / 2;
            $y = (200 - $textHeight) / 2;
            
            imagestring($image, $fontSize, $x, $y, $text, $textColor);
            
            // Simpan gambar
            imagejpeg($image, $filepath, 90);
            imagedestroy($image);
            
            echo "✓ Gambar {$filename} berhasil dibuat!\n";
        } else {
            echo "✓ Gambar {$filename} sudah ada!\n";
        }
    }
    
    // 3. Buat symlink jika belum ada
    $publicPath = public_path('storage');
    if (!file_exists($publicPath)) {
        symlink(storage_path('app/public'), $publicPath);
        echo "✓ Symlink storage berhasil dibuat!\n";
    } else {
        echo "✓ Symlink storage sudah ada!\n";
    }
    
    echo "\n✅ Selesai! Gambar sample berhasil dibuat.\n";
    echo "💡 Tips: Sekarang gambar seharusnya muncul di halaman admin galeri.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
} 