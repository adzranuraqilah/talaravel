<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderSampleSeeder extends Seeder
{
    public function run()
    {
        // Get or create a user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create sample orders with different statuses
        $orders = [
            [
                'user_id' => $user->id,
                'nama_proyek' => 'Kaos Polos',
                'budget' => 500000,
                'kuantitas' => 50,
                'deskripsi' => 'Kaos polos untuk event',
                'status' => 'menunggu',
                'tenggat' => now()->addDays(7),
                'desain' => null,
            ],
            [
                'user_id' => $user->id,
                'nama_proyek' => 'Hoodie Custom',
                'budget' => 1500000,
                'kuantitas' => 30,
                'deskripsi' => 'Hoodie dengan desain custom',
                'status' => 'menunggu pembayaran',
                'tenggat' => now()->addDays(14),
                'desain' => null,
            ],
            [
                'user_id' => $user->id,
                'nama_proyek' => 'Kemeja Seragam',
                'budget' => 2000000,
                'kuantitas' => 100,
                'deskripsi' => 'Kemeja seragam kantor',
                'status' => 'diproses',
                'tenggat' => now()->addDays(21),
                'desain' => null,
            ],
            [
                'user_id' => $user->id,
                'nama_proyek' => 'Jaket Bomber',
                'budget' => 3000000,
                'kuantitas' => 25,
                'deskripsi' => 'Jaket bomber dengan logo',
                'status' => 'selesai',
                'tenggat' => now()->addDays(30),
                'desain' => null,
            ],
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }

        $this->command->info('Sample orders created successfully!');
    }
} 