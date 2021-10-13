<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where(['surat.NIP' => Auth::user()->NIP])
        ->get();
        return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }

    

}
