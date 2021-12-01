<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "dosen";
    protected $primarykey = "id";
    protected $fillable = [
        'email_dosen',
        'password',
        'nama_dosen',
        'NIP',
        'jabatan_id',
        'golongan_id',
        'prodi_id',
        'roles_id',
        'ttd_kadep',
        'ttd_wd',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function surat()
    {
    //Setiap user akan memiliki banyak data
    return $this->hasMany('App\Models\Surat', 'NIP');
    }
    public function prodi()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(Prodi::class);
    }
    public function roles()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(Roles::class);
    }
    public function jabatan()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(Jabatan::class);
    }
    public function golongan()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(golongan::class);
    }
}
