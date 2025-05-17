<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSub extends Model
{
    use HasFactory;
    protected $table = 'user_subs';

    protected $fillable = [
        'id_cus', 'id_produk', 'start_sub', 'end_sub',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_cus');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
