<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengguna::truncate();
        Pengguna::create(
        [
            'email' => 'dosen1@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Dosen1',
            'NIP' => '123123',
            'jabatan_id' => '1',
            'golongan_id' => '1',
            'prodi_id' => '1',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Admin',
            'NIP' => '1231231111111',
            'jabatan_id' => '1',
            'golongan_id' => '1',
            'prodi_id' => null,
            'roles_id' => '8',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'kadep1@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'kadep1',
            'NIP' => '123123111111231',
            'jabatan_id' => '1',
            'golongan_id' => '1',
            'prodi_id' => '1',
            'roles_id' => '2',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'wd1@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'wd1',
            'NIP' => '12332131',
            'jabatan_id' => '1',
            'golongan_id' => '1',
            'prodi_id' => '1',
            'roles_id' => '3',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'staff1@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'staff ft',
            'NIP' => '123133311231',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'roles_id' => '4',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'staff2@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'staff arsi',
            'NIP' => '123123665231',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => '1',
            'roles_id' => '5',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'petugas penomoran',
            'NIP' => '1231237897231',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'roles_id' => '7',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'staff3@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'supervisor',
            'NIP' => '12312399889231',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'roles_id' => '6',
            'remember_token' => Str::random(60),
        ]);
    }
}
