<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'transaksi';
    protected $fillable = [
        'nama_kategori',
    ];
}
