<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::truncate();
        Jabatan::create([
            'nama_jabatan' => 'Asisten Ahli',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Lektor',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Lektor Kepala',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Profesor',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'ASN',
        ]);
        Jabatan::create([
            'nama_jabatan' => 'Non ASN',
        ]);
    }
}
