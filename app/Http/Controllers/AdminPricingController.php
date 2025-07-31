<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class AdminPricingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        
        $sablonPricing = $settings && $settings->sablon_pricing ? json_decode($settings->sablon_pricing, true) : [];
        $additionalCosts = $settings && $settings->additional_costs ? json_decode($settings->additional_costs, true) : [];
        $quantityDiscounts = $settings && $settings->quantity_discounts ? json_decode($settings->quantity_discounts, true) : [];
        $expressPricing = $settings && $settings->express_pricing ? json_decode($settings->express_pricing, true) : [];
        $workingTimeSettings = $settings && $settings->working_time_settings ? json_decode($settings->working_time_settings, true) : [];
        
        return view('admin.pricing-settings', compact(
            'settings',
            'sablonPricing',
            'additionalCosts', 
            'quantityDiscounts',
            'expressPricing',
            'workingTimeSettings'
        ));
    }

    public function update(Request $request)
    {
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

        // Update sablon pricing
        $sablonPricing = [
            'plastisol' => (int)$request->input('sablon_plastisol', 20000),
            'rubber' => (int)$request->input('sablon_rubber', 15000),
            'dtg' => (int)$request->input('sablon_dtg', 30000),
            'bordir' => (int)$request->input('sablon_bordir', 15000),
            'bordir_max_patch' => (int)$request->input('sablon_bordir_max_patch', 3),
        ];

        // Update additional costs
        $additionalCosts = [
            'hangtag' => (int)$request->input('additional_hangtag', 500),
            'woven' => (int)$request->input('additional_woven', 500),
            'label_brand_sablon' => (int)$request->input('additional_label_brand_sablon', 1000),
        ];

        // Update quantity discounts
        $quantityDiscounts = [
            'min_quantity' => (int)$request->input('quantity_min', 24),
            'discount_per_100' => (int)$request->input('quantity_discount_per_100', 5000),
            'discount_threshold' => (int)$request->input('quantity_threshold', 100),
        ];

        // Update express pricing
        $expressPricing = [
            'express_cost_per_piece' => (int)$request->input('express_cost_per_piece', 10000),
            'express_time_reduction' => $request->input('express_time_reduction', '1 minggu'),
        ];

        // Update working time settings
        $workingTimeSettings = [
            'kaos' => $request->input('working_time_kaos', '2 minggu'),
            'hoodie' => $request->input('working_time_hoodie', '2 minggu'),
            'kemeja' => $request->input('working_time_kemeja', '3 minggu'),
            'almamater' => $request->input('working_time_almamater', '3 minggu'),
            'jaket' => $request->input('working_time_jaket', '2 minggu'),
            'large_quantity_threshold' => (int)$request->input('working_time_large_threshold', 300),
            'large_quantity_multiplier' => (float)$request->input('working_time_large_multiplier', 1.5),
        ];

        $settings->update([
            'sablon_pricing' => json_encode($sablonPricing),
            'additional_costs' => json_encode($additionalCosts),
            'quantity_discounts' => json_encode($quantityDiscounts),
            'express_pricing' => json_encode($expressPricing),
            'working_time_settings' => json_encode($workingTimeSettings),
        ]);

        return redirect('/admin/pricing-settings')->with('success', 'Pengaturan harga berhasil diupdate!');
    }
} 