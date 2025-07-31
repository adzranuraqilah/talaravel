<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'nama_perusahaan',
        'nama_admin',
        'email',
        'phone',
        'alamat',
        'notif_pesanan_baru',
    ];
} 