<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TambahanLain extends Model
{
    protected $table = 'tambahan_lains';
    
    protected $fillable = [
        'nama_tambahan',
        'harga',
        'deskripsi'
    ];
}
