<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function notifDosen()
    {
        $surat = Surat::where(['surat.NIP' => Auth::user()->NIP])->get();
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function dashboarddosen(Request $request)
    {
        return view('dosen.dashboarddosen');
    }

    public function daftarsuratDosen(Request $request)
    {
        $surat = Surat::with('status')
        ->where(['surat.NIP' => Auth::user()->NIP])
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);
        return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }

    public function profildosen()
    {
        return view('dosen.profildosen');
    }

    public function updateprofildosen(Request $request)
    {
        Dosen::where('id', '=', Auth::user()->id)->update([
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
        Dosen::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profildosen');
    }

}
