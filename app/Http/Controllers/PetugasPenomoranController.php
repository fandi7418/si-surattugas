<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasPenomoranController extends Controller
{
    public function notifPetugas()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $staff = Surat::with('status')
        ->where([
            'surat.id_staff' => Auth::user()->id,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'staff' => $staff,
        ]);
    }
    
    public function dashboardpetugas(Surat $surat)
    {
        return view('petugas.dashboardpetugas');
    }

    public function daftarsuratpetugas(Surat $surat)
    {
        $prodi = Prodi::all();
        $surat = Surat::with('status', 'prodi')
        ->whereNotNull('surat.ttd_wd')
        ->orderBy('updated_at', 'DESC')
        ->get(); 
        return view('petugas.daftarsuratpetugas', 
        [
            'surat' => $surat, 
            'prodi' => $prodi,
        ]);
    }

    public function profilpetugas(Surat $surat)
    {
        $petugas = Pengguna::where([
            'pengguna.id' => Auth::user()->id,
        ])
        ->get();
        return view('petugas.profilpetugas', [
            'petugas' => $petugas
        ]);
        
    }

    public function editnomorsurat(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function validasi(Request $request)
    {
        $validation = $request->validate([
            'no_surat' => 'required|unique:surat',
        ], 
        [
            'no_surat.unique' => 'Nomor sudah digunakan',
            'no_surat.required' => 'Nomor harus diisi',
        ]
        );
    }
    
    public function updatenomorsurat(Request $request, $id)
    {
        $this->validasi($request);
        $surat = Surat::find($id)->update([
            'no_surat' => $request->no_surat,
            'status_id' => '4',
            'notif' => '1',
        ]);
        return response()->json([
            'success' => 'sukses',
            'surat' => $surat,
        ]);
    }

    public function updateprofilpetugas(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:pengguna,NIP,$id",
            'email_petugas' => "email|required|unique:pengguna,email,$id",
        ], 
            [
            'email_petugas.email' => 'E-mail tidak boleh kosong',
            'email_petugas.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',

        ]);

        Pengguna::where('id', $request->id)->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'email' => $request->email_petugas,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordpetugas(Request $request)
    {
        Pengguna::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),

        ]);
        toast('Password Berhasil Diubah', 'success')->autoClose(2000);
        return redirect('/profilpetugas');
    }
}
