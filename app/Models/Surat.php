<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

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
        'jabatan',
        'judul',
        'jenis',
        'tempat',
        'kota',
        'tanggalawal',
        'tanggalakhir',
        'tanggalsurat',
        'status',
        'ttd_kadep',
        'ttd_wd',
        'nama_kadep',
        'NIP_kadep',
        'nama_wd',
        'NIP_wd',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $dates = ['tanggalawal', 'tanggalakhir'];

    // public function getCreatedAtAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggalawal'])
    //     ->translatedFormat('1, d F Y');
    // }


    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function dosen()
    {
     //Setiap data hanya dimiliki oleh satu user
     return $this->belongsTo('App\Models\Dosen', 'NIP');
    }
}

