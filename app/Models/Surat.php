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
        'approve',
        'nama',
        'NIP',
        'prodi_id',
        'bagian_id',
        'golongan_id',
        'jabatan_id',
        'judul',
        'jenis',
        'tempat',
        'kota',
        'tanggalawal',
        'tanggalakhir',
        'status_id',
        // 'ttd_spv',
        // 'ttd_kadep',
        'ttd_wd',
        // 'nama_supervisor',
        // 'NIP_supervisor',
        // 'nama_kadep',
        // 'NIP_kadep',
        'nama_wd',
        'NIP_wd',
        'notif',
        'id_pengguna',
        'roles_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pengguna()
    {
     //Setiap data hanya dimiliki oleh satu user
    //return $this->belongsTo('App\Models\Pengguna', 'NIP');
    return $this->belongsTo(Pengguna::class);
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

