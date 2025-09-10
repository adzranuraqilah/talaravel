<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $t) {
            if (!Schema::hasColumn('orders', 'midtrans_order_id')) {
                $t->string('midtrans_order_id')->nullable()->index();
            }
            $t->json('payment_info')->nullable();
            $t->string('midtrans_tx_status')->nullable();
        });
    }
    public function down(): void {
        Schema::table('orders', function (Blueprint $t) {
            if (Schema::hasColumn('orders', 'payment_info')) $t->dropColumn('payment_info');
            if (Schema::hasColumn('orders', 'midtrans_tx_status')) $t->dropColumn('midtrans_tx_status');
        });
    }
};
