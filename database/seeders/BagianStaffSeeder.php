<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BagianStaff;
use Illuminate\Support\Str;

class BagianStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BagianStaff::truncate();
        BagianStaff::create([
            'bagian' => 'Akademik',
            'status' => '1',
        ]);
        BagianStaff::create([
            'bagian' => 'SDM',
            'status' => '1',
        ]);
    }
}
