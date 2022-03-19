<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = "jabatan";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'nama_jabatan',
    ];

    public function pengguna()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Pengguna::class);
    }
    public function surat()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Surat::class);
    }
}
