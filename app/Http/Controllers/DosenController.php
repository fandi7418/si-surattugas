<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Dosen;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.tambahdosen', [
            "title" => "Tambah Dosen"
        ]); 
    }   
    public function datadosen()
    {
        
        $dosen = DB::table('dosen')-> get();
        return view('admin.datadosen', ['dosen' => $dosen, "title" => "Data Dosen"]);
    }
    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where(['surat.NIP' => Auth::user()->NIP])
        ->get();
        return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }

    public function tambahdosen(Request $request)
    {
        DB::table('dosen')->insert([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_dosen' => $request->prodi,
            'email_dosen' => $request->email,
            'password' => Hash::make($request->password),

            
        ]);
        return redirect('data_dosen');
    }

    public function editdosen($id)
    {
        $dosen = DB::table('dosen')->where('id', $id)->get();
        return view('admin.editdosen', ['dosen' => $dosen, "title" => "Edit Profil"]);
    }

    public function updatedosen(Request $request)
    {
        DB::table('dosen')->where('id', $request->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'email_dosen' => $request->email,
            'prodi_dosen' => $request->prodi,
        ]);
        return redirect('data_dosen');
    }
    public function hapusdosen($id)
    {
        Dosen::where('id', $id)->delete();
        return redirect('/data_dosen');
    }
}
