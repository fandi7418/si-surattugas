<?php

namespace Database\Seeders;
use App\Models\Golongan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Golongan::truncate();
        Golongan::create([
            'nama_golongan' => 'III/a',
            'jabatan_id' => '1',
        ]);
        Golongan::create([
            'nama_golongan' => 'III/b',
            'jabatan_id' => '1',
        ]);
        Golongan::create([
            'nama_golongan' => 'III/c',
            'jabatan_id' => '2',
        ]);
        Golongan::create([
            'nama_golongan' => 'III/d',
            'jabatan_id' => '2',
        ]);
        Golongan::create([
            'nama_golongan' => 'IV/a',
            'jabatan_id' => '3',
        ]);
        Golongan::create([
            'nama_golongan' => 'IV/b',
            'jabatan_id' => '3',
        ]);
        Golongan::create([
            'nama_golongan' => 'IV/c',
            'jabatan_id' => '3',
        ]);
        Golongan::create([
            'nama_golongan' => 'IV/d',
            'jabatan_id' => '4',
        ]);
        Golongan::create([
            'nama_golongan' => 'IV/e',
            'jabatan_id' => '4',
        ]);
    }
}
