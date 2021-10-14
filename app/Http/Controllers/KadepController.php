<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Auth;
use App\Models\Kadep;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KadepController extends Controller
{

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
            'status' => 'Menunggu persetujuan Wakil Dekan',
            'surat.ttd_kadep' => Auth::user()->ttd_kadep,
            // 'surat.nama_kadep' => Auth::user()->nama_kadep,
            // 'surat.NIP_kadep' => Auth::user()->NIP_kadep,
        ]);
        return redirect('/daftarsuratkadep');
        
    }
    public function tolak($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
            'status' => 'Surat ditolak Kadep',
        ]);
        return redirect('/daftarsuratkadep');
        
    }

    public function tandatangan(Request $request)
    {
        $request->validate([
            'ttd'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd->getClientOriginalName() . '-' . time() . '.' . $request->ttd->extension();
        $request->ttd->move(public_path('image'), $imgName);

        DB::table('ketua_departemen')->where(['ketua_departemen.id' => Auth::user()->id])->update([
            'ttd_kadep' => $imgName,
        ]);
        return redirect('/daftarsuratkadep');
    }

    public function updateprofilkadep(Request $request)
    {
        DB::table('ketua_departemen')->where('id', '=', Auth::user()->id)->update([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_kadep' => $request->prodi,
            'email_kadep' => $request->email,
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(3000);
        return redirect('/profilkadep');
    }

    public function editpasswordkadep(Request $request)
    {
        DB::table('ketua_departemen')->where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilkadep');
    }
}
