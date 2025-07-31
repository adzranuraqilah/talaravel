<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;

echo "Setting up pricing database...\n";

// Run migrations
echo "Running migrations...\n";
Artisan::call('migrate');

// Run seeders
echo "Running seeders...\n";
Artisan::call('db:seed', ['--class' => 'ProdukPriceSeeder']);
Artisan::call('db:seed', ['--class' => 'PricingSettingsSeeder']);

echo "Database setup completed successfully!\n";
echo "You can now access the admin panel to manage products and pricing.\n"; 