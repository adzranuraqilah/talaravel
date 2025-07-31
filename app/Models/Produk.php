<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'nama_produk', 'jenis_bahan', 'ukuran', 'sablon', 'jumlah_warna_sablon', 'warna_bahan',
        'model_jahitan', 'waktu_pengerjaan', 'tambahan_lain', 'harga',
    ];
}
