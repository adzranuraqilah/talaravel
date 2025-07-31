<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class PricingSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if settings exist, if not create default
        $settings = Setting::first();
        
        if (!$settings) {
            $settings = Setting::create([
                'nama_perusahaan' => 'Konveksi Jaya',
                'nama_admin' => 'Admin',
                'email' => 'admin@konveksijaya.com',
                'phone' => '08123456789',
                'alamat' => 'Jl. Contoh No. 123, Jakarta',
                'notif_pesanan_baru' => true,
            ]);
        }

        // Update with pricing settings
        $settings->update([
            'sablon_pricing' => json_encode([
                'plastisol' => 20000,
                'rubber' => 15000,
                'dtg' => 30000,
                'bordir' => 15000,
                'bordir_max_patch' => 3,
            ]),
            
            'additional_costs' => json_encode([
                'hangtag' => 500,
                'woven' => 500,
                'label_brand_sablon' => 1000,
            ]),
            
            'quantity_discounts' => json_encode([
                'min_quantity' => 24,
                'discount_per_100' => 5000,
                'discount_threshold' => 100,
            ]),
            
            'express_pricing' => json_encode([
                'express_cost_per_piece' => 10000,
                'express_time_reduction' => '1 minggu',
            ]),
            
            'working_time_settings' => json_encode([
                'kaos' => '2 minggu',
                'hoodie' => '2 minggu',
                'kemeja' => '3 minggu',
                'almamater' => '3 minggu',
                'jaket' => '2 minggu',
                'large_quantity_threshold' => 300,
                'large_quantity_multiplier' => 1.5, // 50% longer for large quantities
            ]),
        ]);

        $this->command->info('Pricing settings seeded successfully!');
    }
} 