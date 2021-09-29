<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function daftarsurat()
    {

    $surat = DB::table('surat') -> get();
    return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }
}
