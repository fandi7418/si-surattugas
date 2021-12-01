<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;


class DosenController extends Controller
{
    public function clearNotif()
    {
        $surat = Surat::with('status')
        ->where(['surat.id_dosen' => Auth::user()->id,])
        ->update([
            'notif' => '2',
        ]);
        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function notifDosen(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.id_dosen' => Auth::user()->id,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $kadep = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status_id' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $wd = Surat::with('status')
        ->where([
            'surat.status_id' => '2',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'kadep' => $kadep,
            'wd' => $wd,
        ]);
    }

    public function dashboarddosen(Request $request)
    {
        return view('dosen.dashboarddosen');
    }

    public function daftarsuratDosen(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.id_dosen' => Auth::user()->id,
        ])
        ->orderBy('updated_at', 'DESC')
        ->paginate(10);
        return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }

    public function profildosen()
    {
        $prodi = Prodi::all();
        $dosen = Dosen::with('prodi')
        ->where('dosen.id', '=', Auth::user()->id)
        ->get();
        $golongan = Golongan::all();
        $jabatan = Jabatan::where([
            'id' => '1',
            ])
        ->orWhere([
            'id' => '2',
            ])
        ->orWhere([
            'id' => '3',
            ])
        ->orWhere([
            'id' => '4',
            ])
        ->get();
        return view('dosen.profildosen', [
            'prodi' => $prodi, 
            'dosen' => $dosen,
            'golongan' => $golongan,
            'jabatan' => $jabatan
        ]);
    }

    public function updateprofildosen(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:dosen,NIP,$id|unique:ketua_departemen,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP|unique:admin,NIP",
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => "email|required|unique:dosen,email_dosen,$id|unique:ketua_departemen,email_kadep|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd|unique:admin,email_admin",
        ], 
            [
            'email_dosen.email' => 'E-mail tidak boleh kosong',
            'email_dosen.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',

        ]);
        
        Dosen::where('id', $request->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
            'email_dosen' => $request->email_dosen,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
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
