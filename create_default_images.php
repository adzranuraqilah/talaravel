<?php
// File untuk membuat gambar default
// Jalankan dengan: php create_default_images.php

try {
    echo "=== Membuat Gambar Default ===\n\n";
    
    $sourceFile = 'public/img/kaos-default.png';
    $targetFiles = [
        'public/img/hoodie-default.png',
        'public/img/kemeja-default.png', 
        'public/img/jaket-default.png'
    ];
    
    if (file_exists($sourceFile)) {
        foreach ($targetFiles as $targetFile) {
            if (!file_exists($targetFile)) {
                copy($sourceFile, $targetFile);
                echo "✓ Created: {$targetFile}\n";
            } else {
                echo "✓ Already exists: {$targetFile}\n";
            }
        }
        
        echo "\n✅ Selesai! Gambar default berhasil dibuat.\n";
        echo "💡 Tips: Sekarang jalankan php update_image_paths.php untuk update database.\n";
        
    } else {
        echo "❌ Error: File source {$sourceFile} tidak ditemukan!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 