<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->after('id');
            $table->string('status')->default('terjadwal')->after('nama_produksi');
            $table->date('tanggal_mulai')->nullable()->after('status');
            $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::table('produksis', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn(['order_id', 'status', 'tanggal_mulai', 'tanggal_selesai']);
        });
    }
}; 