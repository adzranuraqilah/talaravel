<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeri_pratinjau', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('jenis_produk');
            $table->string('foto_pratinjau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_pratinjau');
    }
}; 