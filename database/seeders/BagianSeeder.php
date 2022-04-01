<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bagian;
use Illuminate\Support\Str;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bagian::truncate();
        Bagian::create([
            'bagian' => 'Akademik',
            'status' => '2',
        ]);
        Bagian::create([
            'bagian' => 'SDM',
            'status' => '2',
        ]);
        Bagian::create([
            'bagian' => 'WD 1',
            'status' => '2',
        ]);
        Bagian::create([
            'bagian' => 'WD 2',
            'status' => '2',
        ]);
    }
}
