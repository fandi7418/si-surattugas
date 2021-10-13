<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Models\WakilDekan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class WakilDekanController extends Controller
{
    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->get();
        return view('wd.daftarsuratwd', ['surat' => $surat]);
    }

    public function izinkan($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
            'status' => 'Belum diberi nomor',
            'surat.ttd_wd' => Auth::user()->ttd_wd,
        ]);
        return redirect('/daftarsuratwd');
        
    }

    public function tolak($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
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

        DB::table('wakildekan')->where(['wakildekan.id' => Auth::user()->id])->update([
            'ttd_wd' => $imgName,
        ]);
        return redirect('/daftarsuratwd');
    }
}