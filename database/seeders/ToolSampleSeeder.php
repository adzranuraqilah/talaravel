<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tool;

class ToolSampleSeeder extends Seeder
{
    public function run()
    {
        // Create sample tools
        $tools = [
            [
                'nama' => 'Screen',
                'gambar' => null,
            ],
            [
                'nama' => 'Rakaf',
                'gambar' => null,
            ],
            [
                'nama' => 'Tinta Sablon',
                'gambar' => null,
            ],
            [
                'nama' => 'Sablon',
                'gambar' => null,
            ],
            [
                'nama' => 'Setrika Uap',
                'gambar' => null,
            ],
            [
                'nama' => 'Benang Jahit',
                'gambar' => null,
            ],
            [
                'nama' => 'Mesin Jahit',
                'gambar' => null,
            ],
            [
                'nama' => 'Gunting',
                'gambar' => null,
            ],
            [
                'nama' => 'Pita Ukur',
                'gambar' => null,
            ],
            [
                'nama' => 'Jarum',
                'gambar' => null,
            ],
        ];

        foreach ($tools as $toolData) {
            Tool::create($toolData);
        }

        $this->command->info('Sample tools created successfully!');
    }
} 