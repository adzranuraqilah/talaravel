<?php
// File untuk menjalankan SQL secara manual
// Jalankan dengan: php run_sql_manual.php

require_once 'vendor/autoload.php';

// Load Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    // Buat tabel jika belum ada
    if (!Schema::hasTable('galeri_pratinjau')) {
        Schema::create('galeri_pratinjau', function ($table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->string('foto_pratinjau');
            $table->timestamps();
        });
        echo "Tabel galeri_pratinjau berhasil dibuat!\n";
    } else {
        echo "Tabel galeri_pratinjau sudah ada!\n";
    }

    // Cek apakah ada data
    $count = DB::table('galeri_pratinjau')->count();
    echo "Jumlah data di tabel: $count\n";

    // Jika tidak ada data, tambah data sample
    if ($count == 0) {
        DB::table('galeri_pratinjau')->insert([
            [
                'nama_produk' => 'Kaos Polos',
                'jenis_produk' => 'kaos',
                'foto_pratinjau' => 'galeri_pratinjau/kaos-sample.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Hoodie Basic',
                'jenis_produk' => 'hoodie',
                'foto_pratinjau' => 'galeri_pratinjau/hoodie-sample.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Kemeja Formal',
                'jenis_produk' => 'kemeja',
                'foto_pratinjau' => 'galeri_pratinjau/kemeja-sample.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Jaket Denim',
                'jenis_produk' => 'jaket',
                'foto_pratinjau' => 'galeri_pratinjau/jaket-sample.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        echo "Data sample berhasil ditambahkan!\n";
    } else {
        echo "Data sudah ada!\n";
    }

    // Tampilkan data
    $data = DB::table('galeri_pratinjau')->get();
    echo "Data di tabel:\n";
    foreach ($data as $item) {
        echo "- {$item->nama_produk} ({$item->jenis_produk})\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 