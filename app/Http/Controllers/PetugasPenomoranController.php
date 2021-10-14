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
    public function daftarsurat(Surat $surat)
    {
        $surat = DB::table('surat')
        ->whereNotNull(['surat.ttd_wd'])
        ->get();
        return view('petugas.daftarsuratpetugas', ['surat' => $surat]);
        // $surat = Surat::find([
        //     'status' => 'Belum diberi nomor',
        //     'status' => 'Sudah diberi nomor',
        //     ]);
        // return view('petugas.daftarsuratpetugas', ['surat' => $surat]);
    }

    public function editnomorsurat($id)
    {
        $surat = DB::table('surat')->where('id', $id)->get();
        return view('petugas.editnomor', ['surat' => $surat]);
    }

    public function updatenomorsurat(Request $request, $id)
    {
        // $request->validate([
        //     'no_surat' => 'unique:surat',
        // ],[
        //     'no_surat.unique' => 'Nomor tidak boleh sama'
        // ]);

        DB::table('surat')->where('id', $request->id)->update([
            'no_surat' => $request->no_surat,
            'status' => 'Sudah diberi nomor',
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        return redirect('/daftarsuratpetugas');
    }
}
