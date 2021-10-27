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
        $notif = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $surat = Surat::with('status')
        ->whereNotNull('surat.ttd_wd')
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->count();
        return view('petugas.dashboardpetugas', [
            'surat' => $surat, 
            'count' => $count, 
            'notif' => $notif]
        );
    }
    public function daftarsuratpetugas(Surat $surat)
    {
        $notif = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $surat = Surat::with('status')
        ->whereNotNull('surat.ttd_wd')
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->count();
        return view('petugas.daftarsuratpetugas', [
            'surat' => $surat, 
            'count' => $count, 
            'notif' => $notif]
        );

    }
    public function profilpetugas(Surat $surat)
    {
        $notif = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
            ])
        ->count();
        return view('petugas.profilpetugas', ['count' => $count, 'notif' => $notif]);

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
            // 'success' => true,
            'success' => 'Nomor submitted successfully',
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
