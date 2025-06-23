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
            $table->string('teknik_produksi');
            $table->integer('kuantitas');
            $table->decimal('total_estimasi', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimasi_harga');
    }
};