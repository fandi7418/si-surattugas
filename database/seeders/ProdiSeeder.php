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
            'status' => '2',
        ]);
        Prodi::create([
            'prodi' => 'Teknik Arsitektur',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Kimia',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Perencanaan Wilayah dan Kota',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Mesin',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Elektro',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Perkapalan',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Industri',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Lingkungan',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Geologi',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Geodesi',
            'status' => '1'
        ]);
        Prodi::create([
            'prodi' => 'Teknik Komputer',
            'status' => '1'
        ]);
    }
}
