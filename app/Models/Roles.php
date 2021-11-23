<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'peran',
    ];

    public function dosen()
    {
    //Setiap Roles memiliki banyak id dosen
    return $this->hasMany(Dosen::class);
    }
//     public function kadep()
//     {
//     //Setiap Roles memiliki banyak id dosen
//     return $this->hasMany(Kadep::class);
//     }
//     public function surat()
//     {
//     //Setiap Roles memiliki banyak id surat
//     return $this->hasMany(Surat::class);
//     }
}
