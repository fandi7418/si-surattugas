<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory;

    protected $table = "dosen";
    protected $primarykey = "id";
    protected $fillable = [
        'email_dosen',
        'password',
        'nama_dosen',
        'NIP',
        'prodi_dosen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
