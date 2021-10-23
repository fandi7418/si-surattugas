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
    ];

    public function dosen()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hashMany(Dosen::class);
    }
    public function kadep()
    {
    //Setiap Prodi memiliki banyak id dosen
    return $this->hashMany(Kadep::class);
    }
    public function surat()
    {
    //Setiap Prodi memiliki banyak id surat
    return $this->hashMany(Surat::class);
    }
}
