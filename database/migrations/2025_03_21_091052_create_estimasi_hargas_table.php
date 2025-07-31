<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estimasi_harga', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_produk');
            $table->string('jenis_bahan');
            $table->string('teknik_produksi')->nullable();
            $table->integer('kuantitas');
            $table->decimal('total_estimasi', 12, 2)->nullable();
            $table->string('warna_bahan')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('model_jahitan')->nullable();
            $table->string('sablon')->nullable();
            $table->integer('jumlah_warna_sablon')->nullable();
            $table->string('tambahan_lain')->nullable();
            $table->string('waktu_pengerjaan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimasi_harga');
    }
};
