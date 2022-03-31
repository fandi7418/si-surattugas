<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Golongan;
use App\Models\Jabatan;
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
            'surat.id_pengguna' => Auth::user()->id,
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
        $cek=Surat::where(['id' => $id,])->get();
        if($cek->first()->approve == 0){
            if($cek->first()->roles_id == '1' || $cek->first()->roles_id == '2' || $cek->first()->roles_id == '3' || $cek->first()->roles_id == '5')
            {
                $surat = Surat::find($id)->update([
                    'nama_wd' => Pengguna::where([
                        'pengguna.id' => $cek->first()->nama_wd,
                    ])->first()->nama,
                    'NIP_wd' => Pengguna::where([
                        'pengguna.id' => $cek->first()->nama_wd,
                    ])->first()->NIP,
                    'prodi_id' => Prodi::where([
                        'id' => $cek->first()->prodi_id,
                    ])->first()->prodi,
                    'golongan_id' => Golongan::where([
                        'id' => $cek->first()->golongan_id,
                    ])->first()->nama_golongan,
                    'jabatan_id' => Jabatan::where([
                        'id' => $cek->first()->jabatan_id,
                    ])->first()->nama_jabatan,
                ]);
            } 
            elseif($cek->first()->roles_id == '4' || $cek->first()->roles_id == '6' || $cek->first()->roles_id == '7')
            {
                $surat = Surat::find($id)->update([
                    'nama_wd' => Pengguna::where([
                        'id' => $cek->first()->NIP_wd,
                    ])->first()->nama,
                    'NIP_wd' => Pengguna::where([
                        'id' => $cek->first()->NIP_wd,
                    ])->first()->NIP,
                    'golongan_id' => Golongan::where([
                        'id' => $cek->first()->golongan_id,
                    ])->first()->nama_golongan,
                    'jabatan_id' => Jabatan::where([
                        'id' => $cek->first()->jabatan_id,
                    ])->first()->nama_jabatan,
                ]);
            }
        }

        $surat = Surat::find($id)->update([
            'no_surat' => $request->no_surat,
            'status_id' => '4',
            'notif' => '1',
            'approve' => '1',
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
            'NIP' => "required|string|min:6|unique:pengguna,NIP,$id",
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
        Surat::where([
            'id_pengguna' => Auth::user()->id,
            'approve' => '0',
            ])->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
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
