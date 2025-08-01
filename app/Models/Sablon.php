<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sablon extends Model
{
    protected $table = 'sablons';
    
    protected $fillable = [
        'nama_sablon'
    ];
}
