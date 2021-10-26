<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSurat extends Model
{
    use HasFactory;
    protected $table = "status";
    protected $primarykey = "id";
    protected $fillable = [
        'id',
        'status',
    ];

    public function surat()
    {
    //Setiap Prodi memiliki banyak id surat
    return $this->hasMany(Surat::class);
    }
}