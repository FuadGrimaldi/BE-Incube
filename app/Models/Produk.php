<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id', 'nama', 'tinggi', 'lebar', 'kapasitas', 'telur', 'pass_access', 'price', 'active', 'image'
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_product', 'id');
    }

    public function userSubs()
    {
        return $this->hasMany(UserSub::class, 'id_produk', 'id');
    }
}
