<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();
        Roles::create([
            'peran' => 'Dosen',
        ]);
        Roles::create([
            'peran' => 'Kadep',
        ]);
        Roles::create([
            'peran' => 'Wakil Dekan',
        ]);
    }
}
