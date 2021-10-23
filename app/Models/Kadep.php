<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kadep extends Authenticatable
{
    use HasFactory;

    protected $table = "ketua_departemen";
    protected $primarykey = "id";
    protected $fillable = [
        'email_kadep',
        'password',
        'nama_kadep',
        'NIP',
        'prodi_id',
        'ttd_kadep',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    public function prodi()
    {
        //Setiap kadep hanya memiliki satu prodi
        return $this->belongsTo(Prodi::class);
    }
}
