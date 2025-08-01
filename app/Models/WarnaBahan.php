<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarnaBahan extends Model
{
    protected $table = 'warna_bahans';
    
    protected $fillable = [
        'nama_warna',
        'kode_warna',
        'deskripsi'
    ];

    // Relasi many-to-many dengan Bahan
    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'bahan_warna_bahan');
    }

    // Relasi many-to-many dengan Produk
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_warna_bahan');
    }
}
