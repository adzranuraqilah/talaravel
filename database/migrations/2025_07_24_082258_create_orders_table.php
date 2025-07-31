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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['personal', 'tender']);
            $table->string('nama_proyek');
            $table->text('deskripsi');
            $table->integer('kuantitas');
            $table->date('tenggat');
            $table->string('budget')->nullable(); // nullable untuk personal
            $table->string('desain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
