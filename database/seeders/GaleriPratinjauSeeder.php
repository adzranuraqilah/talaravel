<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\GaleriPratinjau;

class GaleriPratinjauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat tabel jika belum ada
        if (!Schema::hasTable('galeri_pratinjau')) {
            Schema::create('galeri_pratinjau', function (Blueprint $table) {
                $table->id();
                $table->string('nama_produk');
                $table->string('jenis_produk');
                $table->string('foto_pratinjau');
                $table->timestamps();
            });
        }

        // Tambah beberapa data sample jika tabel kosong
        if (GaleriPratinjau::count() === 0) {
            GaleriPratinjau::create([
                'nama_produk' => 'Kaos Polos',
                'jenis_produk' => 'kaos',
                'foto_pratinjau' => 'galeri_pratinjau/kaos-sample.jpg',
            ]);

            GaleriPratinjau::create([
                'nama_produk' => 'Hoodie Basic',
                'jenis_produk' => 'hoodie',
                'foto_pratinjau' => 'galeri_pratinjau/hoodie-sample.jpg',
            ]);

            GaleriPratinjau::create([
                'nama_produk' => 'Kemeja Formal',
                'jenis_produk' => 'kemeja',
                'foto_pratinjau' => 'galeri_pratinjau/kemeja-sample.jpg',
            ]);
        }
    }
} 