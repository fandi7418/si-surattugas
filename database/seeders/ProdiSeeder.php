<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::truncate();
        Prodi::create([
            'prodi' => 'Teknik Sipil',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Arsitektur',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Kimia',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Perencanaan Wilayah dan Kota',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Mesin',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Elektro',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Perkapalan',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Industri',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Lingkungan',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Geologi',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Geodesi',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Komputer',
        ]);
    }
}
