<?php

namespace Database\Seeders;

use App\Models\WakilDekan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WakilDekanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WakilDekan::truncate();
        WakilDekan::create([
            'email_wd' => 'wd1@gmail.com',
            'password' => bcrypt('123456'),
            'nama_wd' => 'Wakil Dekan1',
            'NIP' => '1231234',
            'remember_token' => Str::random(60),
        ]);
    }
}
