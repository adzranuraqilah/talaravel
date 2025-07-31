<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Jalankan seeder admin
        $this->call(AdminUserSeeder::class);
        
        // Jalankan seeder galeri pratinjau
        $this->call(GaleriPratinjauSeeder::class);
        
        // Jalankan seeder produk harga
        $this->call(ProdukPriceSeeder::class);
        
        // Jalankan seeder pengaturan harga
        $this->call(PricingSettingsSeeder::class);
    }
}
