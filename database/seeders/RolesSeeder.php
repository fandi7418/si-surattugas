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
        Roles::create([
            'peran' => 'Staff Dekanat FT',
        ]);
        Roles::create([
            'peran' => 'Staff Departemen',
        ]);
        Roles::create([
            'peran' => 'Supervisor',
        ]);
        Roles::create([
            'peran' => 'Petugas Penomoran',
        ]);
    }
}
