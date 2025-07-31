<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan')->nullable();
            $table->string('nama_admin')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alamat')->nullable();
            $table->boolean('notif_pesanan_baru')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}; 