<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::create([
            'email_admin' => 'admin1@admin.com',
            'password' => bcrypt('123456'),
            'nama_admin' => 'admin 1',
            'NIP' => '21120111989',
            'remember_token' => Str::random(60),
        ]);
        Admin::create([
            'email_admin' => 'admin2@admin.com',
            'password' => bcrypt('123456'),
            'nama_admin' => 'admin 2',
            'NIP' => '21120111999',
            'remember_token' => Str::random(60),
        ]);
    }
}