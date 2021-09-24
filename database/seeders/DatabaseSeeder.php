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
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(KadepSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(WakilDekanSeeder::class);
    }
}
