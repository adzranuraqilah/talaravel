<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sablon;

class SablonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sablons = [
            [
                'nama_sablon' => 'Plastisol',
                'deskripsi' => 'Teknik sablon yang menggunakan tinta plastisol. Hasil cetak tebal, tahan lama, dan tidak mudah luntur. Cocok untuk kaos polos dengan hasil yang berkualitas tinggi.'
            ],
            [
                'nama_sablon' => 'Rubber',
                'deskripsi' => 'Tinta rubber memberikan hasil cetak yang elastis dan nyaman dipakai. Tidak mudah retak dan tahan terhadap peregangan. Ideal untuk kaos dengan desain yang membutuhkan fleksibilitas.'
            ],
            [
                'nama_sablon' => 'DTG (Direct to Garment)',
                'deskripsi' => 'Teknologi printing langsung ke kain menggunakan printer khusus. Hasil cetak detail dan halus seperti foto. Cocok untuk desain kompleks dengan banyak warna dan gradasi.'
            ],
            [
                'nama_sablon' => 'Bordir',
                'deskripsi' => 'Teknik menjahit benang membentuk desain pada kain. Hasil akhir mewah dan tahan lama. Cocok untuk logo perusahaan atau desain yang membutuhkan kesan formal dan elegan.'
            ],
            [
                'nama_sablon' => 'Flock',
                'deskripsi' => 'Sablon dengan efek beludru yang lembut dan mewah. Memberikan tekstur unik pada desain. Cocok untuk memberikan kesan premium pada kaos.'
            ],
            [
                'nama_sablon' => 'Glow in the Dark',
                'deskripsi' => 'Tinta khusus yang menyala dalam gelap. Menambahkan efek unik dan menarik pada desain. Cocok untuk kaos dengan tema malam atau party.'
            ],
            [
                'nama_sablon' => 'Reflective',
                'deskripsi' => 'Tinta yang memantulkan cahaya saat terkena sorotan. Ideal untuk kaos safety atau yang membutuhkan visibilitas tinggi di malam hari.'
            ],
            [
                'nama_sablon' => 'Discharge',
                'deskripsi' => 'Teknik sablon yang menghilangkan warna asli kain dan menggantinya dengan warna baru. Hasil cetak terasa seperti bagian dari kain, tidak menambah ketebalan.'
            ]
        ];

        foreach ($sablons as $sablon) {
            Sablon::create($sablon);
        }
    }
} 