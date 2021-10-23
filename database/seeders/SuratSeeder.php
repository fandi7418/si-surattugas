<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surat::truncate();
        Surat::create([
            'no_surat' => '0001',
            'nama_dosen' => 'Dosen1',
            'NIP' => '123123',
            'prodi_id' => '12',
            'pangkat' => 'III',
            'judul' => 'pelatihan',
            'jenis' => 'seminar',
            'tempat' => 'ITB',
            'kota' => 'Bandung',
            // 'tanggalawal' => '',
            // 'tanggalakhir' => '',
            // 'status' => '',
            'remember_token' => Str::random(60),
        ]);
        Surat::create([
            'no_surat' => '0002',
            'nama_dosen' => 'Dosen1',
            'NIP' => '123123',
            'prodi_id' => '12',
            'pangkat' => 'III',
            'judul' => 'pelatihan2',
            'jenis' => 'seminar',
            'tempat' => 'ITB',
            'kota' => 'Bandung',
            // 'tanggalawal' => '',
            // 'tanggalakhir' => '',
            // 'status' => '',
            'remember_token' => Str::random(60),
        ]);
    }
}
