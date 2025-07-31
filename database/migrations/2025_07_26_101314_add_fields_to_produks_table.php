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
        Schema::table('produks', function (Blueprint $table) {
            $table->string('jenis_bahan')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('sablon')->nullable();
            $table->string('warna_bahan')->nullable();
            $table->string('model_jahitan')->nullable();
            $table->string('waktu_pengerjaan')->nullable();
            $table->string('tambahan_lain')->nullable();
            $table->integer('harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_bahan',
                'ukuran',
                'sablon',
                'warna_bahan',
                'model_jahitan',
                'waktu_pengerjaan',
                'tambahan_lain',
                'harga',
            ]);
        });
    }
};
