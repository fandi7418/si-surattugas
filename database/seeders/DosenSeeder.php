<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::truncate();
        Dosen::create([
            'email_dosen' => 'dosen1@gmail.com',
            'password' => bcrypt('123456'),
            'nama_dosen' => 'Dosen1',
            'NIP' => '1223123',
            'prodi_dosen' => 'Teknik Komputer',
            'remember_token' => Str::random(60),
        ]);
    }
}
