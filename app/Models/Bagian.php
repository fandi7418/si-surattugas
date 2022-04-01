<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $table = "bagian";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'bagian',
        'status',
    ];

    public function pengguna()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Pengguna::class);
    }
    public function surat()
    {
    //Setiap Prodi memiliki banyak id surat
    return $this->hasMany(Surat::class);
    }
}
