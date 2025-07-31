<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'phone' => '08123456789',
                'alamat' => 'Jl. Admin No. 1',
            ]
        );

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@admin.com');
        $this->command->info('Password: admin123');
    }
}
