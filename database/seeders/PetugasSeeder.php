<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Petugas::truncate();
        Petugas::create([
            'email_petugas' => 'petugas1@gmail.com',
            'password' => bcrypt('123456'),
            'nama_petugas' => 'Petugas1',
            'NIP' => '1231233',
            'remember_token' => Str::random(60),
        ]);
    }
}
