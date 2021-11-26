<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Surat extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "surat";
    protected $primarykey = "id";
    protected $fillable = [
        'no_surat',
        'nama_dosen',
        'NIP',
        'prodi_id',
        'pangkat',
        'jabatan',
        'judul',
        'jenis',
        'tempat',
        'kota',
        'tanggalawal',
        'tanggalakhir',
        'tanggalsurat',
        'status_id',
        'ttd_kadep',
        'ttd_wd',
        'nama_kadep',
        'NIP_kadep',
        'nama_wd',
        'NIP_wd',
        'notif',
        'id_dosen',
        'roles_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function dosen()
    {
     //Setiap data hanya dimiliki oleh satu user
    return $this->belongsTo('App\Models\Dosen', 'NIP');
    }
    // public function kadep()
    // {
    //  //Setiap data hanya dimiliki oleh satu user
    // return $this->belongsTo(Kadep::class);
    // }
    public function prodi()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(Prodi::class);
    }
    public function status()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(StatusSurat::class);
    }
}

