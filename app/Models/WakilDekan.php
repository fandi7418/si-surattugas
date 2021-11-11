<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class WakilDekan extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "wakildekan";
    protected $primarykey = "id";
    protected $fillable = [
        'email_wd',
        'password',
        'nama_wd',
        'NIP',
        'ttd_wd',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
