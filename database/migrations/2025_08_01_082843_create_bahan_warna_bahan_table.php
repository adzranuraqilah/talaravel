<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bahan_warna_bahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bahan_id')->constrained('bahans')->onDelete('cascade');
            $table->foreignId('warna_bahan_id')->constrained('warna_bahans')->onDelete('cascade');
            $table->timestamps();
            
            // Mencegah duplikasi
            $table->unique(['bahan_id', 'warna_bahan_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bahan_warna_bahan');
    }
};
