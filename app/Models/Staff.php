<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use HasFactory;
    use softDeletes;

    protected $table = "staff";
    protected $primarykey = "id";
    protected $fillable = [
        'email_staff',
        'password',
        'nama_staff',
        'NIP',
        'pangkat',
        'jabatan',
        'prodi_id',
        'roles_id',
        'ttd_spv',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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
}
