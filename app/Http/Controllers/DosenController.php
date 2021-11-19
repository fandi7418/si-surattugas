<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use App\Models\Prodi;
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
        ->where(['surat.NIP' => Auth::user()->NIP])
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
            'surat.NIP' => Auth::user()->NIP,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        // $surat = createFromFormat('Y-m-d H:i:s', 'updated_at')->isoFormat('D MMMM Y');
        // if ($request->ajax()){
        //     return ($surat)
        //     ->editColumn('created_at', function ($data) {
        //         return $data->created_at ? with(new Carbon($data->created_at))->isoFormat('D MMMM Y') : '';
        //     });
        // }
        // $surat = Surat::where('surat.update_at' ? with(new Carbon('surat.update_at'))->isoFormat('D MMMM Y') : '');
        return response()->json([
            'surat' => $surat,
            // 'surat' => $surat->updated_at ? with(new Carbon($surat->updated_at))->isoFormat('D MMMM Y') : ''
        ]);
    }

    public function dashboarddosen(Request $request)
    {
        return view('dosen.dashboarddosen');
    }

    public function daftarsuratDosen(Request $request)
    {
        $surat = Surat::with('status')
        ->where(['surat.prodi_id' => Auth::user()->prodi_id])
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
        return view('dosen.profildosen', ['prodi' => $prodi, 'dosen' => $dosen]);
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
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
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
