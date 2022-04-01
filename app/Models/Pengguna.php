<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "pengguna";
    protected $primarykey = "id";
    protected $fillable = [
        'email',
        'password',
        'nama',
        'NIP',
        'jabatan_id',
        'golongan_id',
        'prodi_id',
        'bagian_id',
        'roles_id',
        'ttd',
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
    //return $this->hasMany('App\Models\Surat', 'NIP');
    return $this->hasMany(Surat::class);
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
    return $this->belongsTo(Golongan::class);
    }
    public function bagian()
    {
    //Setiap dosen hanya memiliki satu prodi
    return $this->belongsTo(Bagian::class);
    }
}
