<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "petugas_penomoran";
    protected $primarykey = "id";
    protected $fillable = [
        'email_petugas',
        'password',
        'nama_petugas',
        'NIP',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
