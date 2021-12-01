<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = "golongan";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'nama_golongan',
        'jabatan_id',
    ];

    public function dosen()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Dosen::class);
    }
    public function staff()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Staff::class);
    }
}
