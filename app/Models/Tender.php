<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    protected $table = 'tender';
    protected $fillable = [
        'jenis_produk',
        'jenis_bahan',
        'teknik_produksi',
        'notes',
        'budget',
        'pcs',
        'upload_gambar'
    ];
}
