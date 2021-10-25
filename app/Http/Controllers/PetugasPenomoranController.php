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
    $notif = DB::table('surat')
    ->where(['surat.status' => 'Belum diberi nomor',])
    ->get();
    $count = DB::table('surat')
    ->where(['surat.status' => 'Belum diberi nomor',])
    ->count();
        return view('petugas.dashboardpetugas', ['notif' => $notif, 'count' => $count]);
    }
    public function daftarsuratpetugas(Surat $surat)
    {
        $surat = Surat::whereNotNull(['surat.ttd_wd'])->orderBy('created_at', 'DESC')
        ->get();
        $notif = Surat::where(['surat.status' => 'Belum diberi nomor',])
        ->get();
        $count = Surat::where(['surat.status' => 'Belum diberi nomor',])
        ->count();
        return view('petugas.daftarsuratpetugas', ['surat' => $surat, 'count' => $count, 'notif' => $notif]);

    }
    public function profilpetugas(Surat $surat)
    {
        $notif = DB::table('surat')
        ->where(['surat.status' => 'Belum diberi nomor',])
        ->get();
        $count = DB::table('surat')
        ->where(['surat.status' => 'Belum diberi nomor',])
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

    public function updatenomorsurat(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'no_surat' => $request->no_surat,
            'status' => 'Sudah diberi nomor',
        ]);
        return response()->json([ 
            'success' => true,
            'surat' => $surat
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
