<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'detail_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'nama_produk',
        'qty',
        'subtotal',
    ];
}
