<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi'
    ];

    // Relasi many-to-many dengan Bahan
    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'produk_bahan');
    }

    // Relasi many-to-many dengan WarnaBahan
    public function warnaBahans()
    {
        return $this->belongsToMany(WarnaBahan::class, 'produk_warna_bahan');
    }

    // Relasi one-to-many dengan WaktuPengerjaan
    public function waktuPengerjaans()
    {
        return $this->hasMany(WaktuPengerjaan::class);
    }
}
