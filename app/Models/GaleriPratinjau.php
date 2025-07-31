<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriPratinjau extends Model
{
    use HasFactory;
    protected $table = 'galeri_pratinjau';
    protected $fillable = ['nama_produk', 'jenis_produk', 'foto_pratinjau'];
} 