<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Admin Surat Tugas',
            'level' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(60),
        ]);
    }
}
