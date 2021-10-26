<?php

namespace Database\Seeders;

use App\Models\StatusSurat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusSurat::truncate();
        StatusSurat::create([
            'status' => 'Menunggu persetujuan Kadep',
        ]);
        StatusSurat::create([
            'status' => 'Menunggu persetujuan Wakil Dekan',
        ]);
        StatusSurat::create([
            'status' => 'Belum diberi nomor',
        ]);
        StatusSurat::create([
            'status' => 'Telah Disetujui',
        ]);
        StatusSurat::create([
            'status' => 'Ditolak Kadep',
        ]);
        StatusSurat::create([
            'status' => 'Ditolak Wakil Dekan',
        ]);
    }
}

