<?php

namespace Database\Seeders;

use App\Models\Kadep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KadepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kadep::truncate();
        Kadep::create([
            'email_kadep' => 'kadep1@gmail.com',
            'password' => bcrypt('123456'),
            'nama_kadep' => 'Kadep1',
            'NIP' => '123123',
            'prodi_kadep' => 'Teknik Komputer',
            'remember_token' => Str::random(60),
        ]);
    }
}
