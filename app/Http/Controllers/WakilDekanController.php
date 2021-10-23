<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\WakilDekan;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class WakilDekanController extends Controller
{
    public function dashboardwd(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->get();
        $count = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->count();
        return view('wd.dashboardwd', ['surat' => $surat], ['count' => $count]);
    }

    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->get();
        $count = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->count();
        return view('wd.daftarsuratwd', ['surat' => $surat], ['count' => $count]);
    }

    public function profilwd(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->get();
        $count = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->count();
        return view('wd.profilwd', ['surat' => $surat], ['count' => $count]);
    }

    public function izinkan($id)
    {
        Surat::where('id', $id)->update([
            'status' => 'Belum diberi nomor',
            'surat.ttd_wd' => Auth::user()->ttd_wd,
        ]);
        return redirect('/daftarsuratwd');
        
    }

    public function tolak($id)
    {
        Surat::where('id', $id)->update([
            'status' => 'Surat ditolak Wakil Dekan',
        ]);
        return redirect('/daftarsuratwd');
        
    }

    public function tandatangan(Request $request)
    {
        $request->validate([
            'ttd'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd->getClientOriginalName() . '-' . time() . '.' . $request->ttd->extension();
        $request->ttd->move(public_path('image'), $imgName);

        WakilDekan::where(['wakildekan.id' => Auth::user()->id])->update([
            'ttd_wd' => $imgName,
        ]);
        return redirect('/daftarsuratwd');
    }

    public function updateprofilwd(Request $request)
    {
        WakilDekan::where('id', '=', Auth::user()->id)->update([
            'nama_wd' => $request->nama,
            'NIP' => $request->NIP,
            'email_wd' => $request->email,
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(2000);
        return redirect('/profilwd');
    }

    public function editpasswordwd(Request $request)
    {
        WakilDekan::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilwd');
    }
}