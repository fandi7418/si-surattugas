<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
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

    public function updateprofildosen(Request $request)
    {
        DB::table('dosen')->where('id', '=', Auth::user()->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_dosen' => $request->prodi,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'email_dosen' => $request->email,
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(2000);
        return redirect('/profildosen');
    }

    public function editpassworddosen(Request $request)
    {
        DB::table('dosen')->where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profildosen');
    }

}
