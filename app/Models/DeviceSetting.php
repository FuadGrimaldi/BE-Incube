<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSetting extends Model
{
    use HasFactory;
    protected $table = 'device_settings';

    protected $fillable = [
        'id_produk', 'min_suhu', 'max_suhu', 'lampu', 'fan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
