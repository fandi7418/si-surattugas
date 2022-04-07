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
            'email' => 'agungbudi@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Agung Budi Prasetijo S.T., M.I.T., Ph.D.',
            'NIP' => '197106061995121003',
            'jabatan_id' => '3',
            'golongan_id' => '4',
            'prodi_id' => '12',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);

        Pengguna::create(
        [
            'email' => 'adnanfauzi@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Adnan Fauzi S.T., M.Kom.',
            'NIP' => 'H.7.198101272018071001',
            'jabatan_id' => '1',
            'golongan_id' => '2',
            'prodi_id' => '12',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'risma@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Risma Septiana S.T., M.Eng.',
            'NIP' => '198909122019032012',
            'jabatan_id' => '1',
            'golongan_id' => '2',
            'prodi_id' => '12',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'yudieko@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Yudi Eko Windarto, S.T., M.Kom.',
            'NIP' => 'H.7.198906042018071001',
            'jabatan_id' => '1',
            'golongan_id' => '2',
            'prodi_id' => '12',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'dania@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Dania Eridani S.T., M.Eng.',
            'NIP' => '198910132015042002',
            'jabatan_id' => '2',
            'golongan_id' => '3',
            'prodi_id' => '12',
            'roles_id' => '1',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'adian@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Dr. Adian Fatchur Rochim, S.T., M.T.',
            'NIP' => '197302261998021001',
            'jabatan_id' => '3',
            'golongan_id' => '5',
            'prodi_id' => '12',
            'roles_id' => '2',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'kasturi@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Kasturi',
            'NIP' => '197205062007011001',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => '12',
            'bagian_id' => '1',
            'roles_id' => '5',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'sidikeko@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Sidik Eko Permono',
            'NIP' => '198606160214011218',
            'jabatan_id' => '6',
            'golongan_id' => '1',
            'prodi_id' => '12',
            'bagian_id' => '1',
            'roles_id' => '5',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'erwan@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Erwan Yudi Indrasto, S.T.',
            'NIP' => 'H.7.199309052021041001',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => '12',
            'bagian_id' => '1',
            'roles_id' => '5',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'ratna@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Ratna Rissanti',
            'NIP' => '198510262014092004',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => '12',
            'bagian_id' => '2',
            'roles_id' => '5',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'siswo@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Dr. nat. tech. Siswo Sumardiono, ST, MT',
            'NIP' => '197509152000121001',
            'jabatan_id' => '2',
            'golongan_id' => '4',
            'prodi_id' => '3',
            'bagian_id' => '3',
            'roles_id' => '3',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'abdul@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Dr. Abdul Syakur, ST, MT',
            'NIP' => '197204221999031004',
            'jabatan_id' => '2',
            'golongan_id' => '4',
            'prodi_id' => '6',
            'bagian_id' => '4',
            'roles_id' => '3',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'wasto@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Wasto, S.E.',
            'NIP' => '197204221888032005',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'bagian_id' => '1',
            'roles_id' => '6',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'novita@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Novita Anugrah Listiyana, S.E., M.Ak.',
            'NIP' => '197204221777033006',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'bagian_id' => '2',
            'roles_id' => '6',
            'remember_token' => Str::random(60),
        ]);
        Pengguna::create(
        [
            'email' => 'ari@gmail.com',
            'password' => bcrypt('123456'),
            'nama' => 'Ari Eko Widyantoro, S.T., M.Si',
            'NIP' => '197204221666034007',
            'jabatan_id' => '5',
            'golongan_id' => '1',
            'prodi_id' => null,
            'bagian_id' => '2',
            'roles_id' => '7',
            'remember_token' => Str::random(60),
        ]);
    }
}
