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
    public function dashboarddosen(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->count();
        return view('dosen.dashboarddosen', [
            'count' => $count, 
            'surat' => $surat,
        ]);
    }

    public function daftarsuratDosen(Request $request)
    {
        $count = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->count();
        $surat = Surat::with('status')
        ->where(['surat.NIP' => Auth::user()->NIP])
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);
        return view('dosen.daftarsuratdosen', ['surat' => $surat, 'count' => $count]);
    }

    public function profildosen()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->count();
        return view('/dosen/buatsurat', ['surat' => $surat, 'count' => $count]);
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
