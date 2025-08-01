<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaktuPengerjaan extends Model
{
    protected $table = 'waktu_pengerjaans';
    
    protected $fillable = [
        'produk_id',
        'nama_waktu',
        'durasi_hari',
        'deskripsi'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
