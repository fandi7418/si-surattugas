<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Surat extends Authenticatable
{
    use HasFactory;

    protected $table = "surat";
    protected $primarykey = "id";
    protected $fillable = [
        'no_surat',
        'nama_dosen',
        'NIP',
        'prodi',
        'pangkat',
        'judul',
        'jenis',
        'tempat',
        'kota',
        'tanggalawal',
        'tanggalakhir',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function dosen()
    {
     //Setiap data hanya dimiliki oleh satu user
     return $this->belongsTo('App\Models\Dosen', 'NIP');
    }
}

