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
        Schema::table('settings', function (Blueprint $table) {
            // Sablon pricing
            $table->json('sablon_pricing')->nullable()->after('notif_pesanan_baru');
            
            // Additional costs
            $table->json('additional_costs')->nullable()->after('sablon_pricing');
            
            // Quantity discounts
            $table->json('quantity_discounts')->nullable()->after('additional_costs');
            
            // Express service pricing
            $table->json('express_pricing')->nullable()->after('quantity_discounts');
            
            // Working time settings
            $table->json('working_time_settings')->nullable()->after('express_pricing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'sablon_pricing',
                'additional_costs', 
                'quantity_discounts',
                'express_pricing',
                'working_time_settings'
            ]);
        });
    }
}; 