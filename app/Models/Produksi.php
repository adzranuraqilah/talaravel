<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksis';
    protected $fillable = [
        'nama_produksi',
        'order_id',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id');
    }
}
