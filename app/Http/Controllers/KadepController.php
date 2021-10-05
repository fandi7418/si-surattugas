<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Kadep;
use Illuminate\Http\Request;

class KadepController extends Controller
{
    public function datakadep()
    {
        $kadep = DB::table('ketua_departemen') -> get();
        return view('admin.datakadep', ['kadep' => $kadep, "title" => "Data Ketua Departemen"]);
    }
    public function index()
    {
        return view('admin.tambahkadep', [
            "title" => "Tambah Ketua Departemen"
        ]); 
    }

    public function tambahkadep(Request $request)
    {
        DB::table('ketua_departemen')->insert([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_kadep' => $request->prodi,
            'email_kadep' => $request->email,
            'password' => Hash::make($request->password),

            
        ]);
        return redirect('data_kadep');
    }

    public function editkadep($id)
    {
        $kadep = DB::table('ketua_departemen')->where('id', $id)->get();
        return view('admin.editkadep', ['kadep' => $kadep, "title" => "Edit Profil Ketua Departemen"]);
    }

    public function updatekadep(Request $request)
    {
        DB::table('ketua_departemen')->where('id', $request->id)->update([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'email_kadep' => $request->email,
            'prodi_kadep' => $request->prodi,
        ]);
        return redirect('data_kadep');
    }

    public function hapuskadep($id)
    {
        DB::table('ketua_departemen')->where('id', $id)->delete();
        return redirect('/data_kadep');
    }

    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.prodi' => Auth::user()->prodi_kadep,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->get();
        return view('kadep.daftarsuratkadep', ['surat' => $surat]);
    }

    public function izinkan($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
            'status' => 'Menunggu persetujuan Wakil Dekan'
        ]);
        return redirect('/daftarsuratkadep');
        
    }
}
