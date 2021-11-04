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
    public function dashboardpetugas(Surat $surat)
    {
        return view('petugas.dashboardpetugas');
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
        $prodi = Prodi::all();
        // if($id==0)
        // {
        //     $surat = Surat::with('status')
        //     ->whereNotNull('surat.ttd_wd')
        //     ->get();
        // }else{
        //     $surat = Surat::with('status')
        //     ->where('prodi_id', '=', $id)
        //     ->get();
        // }
        // return response()->json($surat);
        $surat = Surat::with('status')->whereNotNull('surat.ttd_wd')
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
        return view('petugas.profilpetugas');

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

    public function updateprofilpetugas(Request $request)
    {
        Petugas::where('id', '=', Auth::user()->id)->update([
            'nama_petugas' => $request->nama,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email,
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(2000);
        return redirect('/profilpetugas');
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
