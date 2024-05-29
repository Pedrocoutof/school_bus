<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'neighborhood',
        'city',
        'number',
        'phone',
        'public_place',
        'state',
        'zip_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
