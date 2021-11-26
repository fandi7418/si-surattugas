<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table = "prodi";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'prodi',
        'status',
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
    public function kadep()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hasMany(Kadep::class);
    }
    public function surat()
    {
    //Setiap Prodi memiliki banyak id surat
    return $this->hasMany(Surat::class);
    }
}
