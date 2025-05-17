<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;
    protected $table = 'data_produk';

    protected $fillable = [
        'id_produk', 'suhu', 'humid', 'gas', 'lampu', 'fan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
