<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Surat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasPenomoranController extends Controller
{
    public function daftarsuratpetugas(Surat $surat)
    {
        $surat = DB::table('surat')
            ->whereNotNull(['surat.ttd_wd'])
            ->get();
        return view('petugas.daftarsuratpetugas', ['surat' => $surat]);

    }

    public function editnomorsurat($id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function updatenomorsurat(Request $request, $id)
    {
        $surat = Surat::findOrFail($id)->update([
            'no_surat' => $request->no_surat,

        ]);
        return response()->json([ 'success' => true, "request" => $request, "id" => $id ]);


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
