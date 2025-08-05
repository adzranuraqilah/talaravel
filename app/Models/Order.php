<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tambahkan ini:
    protected $fillable = [
        'instansi',
        'tipe',
        'nama_proyek',
        'deskripsi',
        'kuantitas',
        'tenggat',
        'budget',
        'desain',
        'status',
        'catatan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
