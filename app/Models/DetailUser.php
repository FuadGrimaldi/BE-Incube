<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;
    protected $table = 'detail_user';
    protected $fillable = [
        'id_user',
        'name',
        'age',
        'geneder',
        'contact',
        'jon',
        'profile_picture',
    ];
}
