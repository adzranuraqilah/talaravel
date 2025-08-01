<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahans';
    
    protected $fillable = [
        'nama_bahan',
        'harga',
        'deskripsi'
    ];

    protected $casts = [
        'harga' => 'decimal:2'
    ];

    // Relasi many-to-many dengan WarnaBahan
    public function warnaBahans()
    {
        return $this->belongsToMany(WarnaBahan::class, 'bahan_warna_bahan');
    }

    // Relasi many-to-many dengan Produk
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_bahan');
    }
}
