<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Surat;
use App\Models\Prodi;
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
        if(Auth::guard('staff')->user()->roles_id == '7')
        {
            return view('petugas.dashboardpetugas');
        } else {
            return redirect()->back();
        }
        
    }

    // public function dropdown($id)
    // {
    //     if($id==0)
    //     {
    //         $surat = Surat::with('status')
    //         ->whereNotNull('surat.ttd_wd')
    //         ->get();
    //     }else{
    //         $surat = Surat::with('status')
    //         ->where('prodi_id', '=', $id)
    //         ->get();
    //     }
    //     // return response()->json($surat);
    //     return view('petugas.daftarsuratpetugas', 
    //     [
    //         'surat' => $surat,
    //     ]);
    // }

    public function daftarsuratpetugas(Surat $surat)
    {
        if(Auth::guard('staff')->user()->roles_id == '7')
        {
            $prodi = Prodi::all();
            $surat = Surat::with('status')->whereNotNull('surat.ttd_wd')
            ->orderBy('updated_at', 'DESC')
            ->get(); 
            return view('petugas.daftarsuratpetugas', 
            [
                'surat' => $surat, 
                'prodi' => $prodi,
            ]);
        } else {
            return redirect()->back();
        }
        
    }
    public function profilpetugas(Surat $surat)
    {
        if(Auth::guard('staff')->user()->roles_id == '7')
        {
            $petugas = Staff::where([
                'staff.id' => Auth::user()->id,
            ])
            ->get();
            return view('petugas.profilpetugas', [
                'petugas' => $petugas
            ]);
        } else {
            return redirect()->back();
        }
        
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


        // $surat->no_surat = $request->nomor;
        // $data->save();

        // Surat::where('id', $request->id)->update([
        //     'no_surat' => $request->no_surat,
        //     'status' => 'Sudah diberi nomor',
        // ]);
        // toast('Data Berhasil Diubah', 'success')->autoClose(2000);
        // return redirect('/daftarsuratpetugas');
    }

    public function updateprofilpetugas(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:petugas_penomoran,NIP,$id|unique:dosen,NIP|unique:ketua_departemen,NIP|unique:wakildekan,NIP|unique:admin,NIP",
            'email_petugas' => "email|required|unique:petugas_penomoran,email_petugas,$id|unique:dosen,email_dosen|unique:ketua_departemen,email_kadep|unique:wakildekan,email_wd|unique:admin,email_admin",
        ], 
            [
            'email_petugas.email' => 'E-mail tidak boleh kosong',
            'email_petugas.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',

        ]);

        Staff::where('id', $request->id)->update([
            'nama_staff' => $request->nama,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email_petugas,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordpetugas(Request $request)
    {
        Petugas::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),

        ]);
        toast('Password Berhasil Diubah', 'success')->autoClose(2000);
        return redirect('/profilpetugas');
    }
}
