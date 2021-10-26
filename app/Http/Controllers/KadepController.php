<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Kadep;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KadepController extends Controller
{

    public function dashboardkadep(Request $request)
    {
        $surat = Surat::where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->get();
        $count = DB::table('surat')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->count();
        return view('kadep.dashboardkadep', ['count' => $count], ['surat' => $surat]);
    }
    public function profilKadep(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.prodi' => Auth::user()->prodi_kadep,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->get();
        $count = DB::table('surat')
        ->where([
            'surat.prodi' => Auth::user()->prodi_kadep,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->count();
        return view('kadep.profilkadep', ['surat' => $surat], ['count' => $count]);
    }
    public function daftarsurat(Request $request)
    {
        $surat = Surat::where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->get();
        $count = Surat::where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status' => 'Menunggu persetujuan Kadep',
            ])
        ->count();
        return view('kadep.daftarsuratkadep', ['surat' => $surat], ['count' => $count]);
    }

    public function izinkan($id)
    {
        Surat::where('id', $id)->update([
            'status' => 'Menunggu persetujuan Wakil Dekan',
            'surat.ttd_kadep' => Auth::user()->ttd_kadep,
            // 'surat.nama_kadep' => Auth::user()->nama_kadep,
            // 'surat.NIP_kadep' => Auth::user()->NIP_kadep,
        ]);
        return redirect('/daftarsuratkadep');
        
    }
    public function tolak($id)
    {
        Surat::where('id', $id)->update([
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

        Kadep::where(['ketua_departemen.id' => Auth::user()->id])->update([
            'ttd_kadep' => $imgName,
        ]);
        return redirect('/daftarsuratkadep');
    }

    public function updateprofilkadep(Request $request)
    {
        Kadep::where('id', '=', Auth::user()->id)->update([
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
        Kadep::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilkadep');
    }
}
