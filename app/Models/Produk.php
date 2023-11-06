<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'produk';
    protected $fillable = [
        'nama',
        'id_kategori',
        'harga',
        'stok',
        'gambar',
    ];
}
