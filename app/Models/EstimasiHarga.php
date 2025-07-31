<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstimasiHarga extends Model
{
    protected $table = 'estimasi_hargas';
    protected $fillable = [
        'jenis_produk',
        'jenis_bahan',
        'teknik_produksi',
        'kuantitas',
        'total_estimasi',
        'warna_bahan',
        'ukuran',
        'model_jahitan',
        'sablon',
        'jumlah_warna_sablon',
        'tambahan_lain',
        'waktu_pengerjaan',
    ];
} 