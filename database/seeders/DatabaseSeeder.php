<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PenggunaSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(SuratSeeder::class);
        $this->call(StatusSuratSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(GolonganSeeder::class);
        $this->call(BagianStaffSeeder::class);
    }
}
