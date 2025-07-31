<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Database\Seeders\ProdukPriceSeeder;

$seeder = new ProdukPriceSeeder();
$seeder->run();

echo "Produk price data seeded successfully!\n"; 