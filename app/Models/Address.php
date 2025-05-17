<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = [
        'id_user', 'Kecamatan', 'provinsi', 'Kabupaten', 'Kelurahan', 'Kode_pos', 'alamat_lengkap'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
