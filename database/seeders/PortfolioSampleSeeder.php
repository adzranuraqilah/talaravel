<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GaleriPratinjau;

class PortfolioSampleSeeder extends Seeder
{
    public function run()
    {
        // Create sample portfolios
        $portfolios = [
            [
                'nama_produk' => 'Pinisi',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'Lentera',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'XXVI Pinisi',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'KKN 155',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'Militan Perun',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'Our Tribal Rules',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'OPTIG',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
            [
                'nama_produk' => 'CIMSA FK UIN SH',
                'foto_pratinjau' => 'galeri_pratinjau/default-portfolio.jpg',
            ],
        ];

        foreach ($portfolios as $portfolioData) {
            GaleriPratinjau::create($portfolioData);
        }

        $this->command->info('Sample portfolios created successfully!');
    }
} 