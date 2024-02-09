<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaksi_detail_list()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
