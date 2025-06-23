<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstimasiHarga extends Model
{
    protected $table = 'estimasi_harga';
    protected $fillable = [
        'jenis_produk',
        'jenis_bahan',
        'teknik_produksi',
        'kuantitas',
        'total_estimasi'
    ];
} 