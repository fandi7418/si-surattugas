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
    public function notifWD()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.status_id' => '2',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function dashboardwd(Request $request)
    {
        return view('wd.dashboardwd');
    }

    public function daftarsurat(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.status_id' => '2',
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return view('wd.daftarsuratwd', ['surat' => $surat]);
    }

    public function profilwd(Request $request)
    {
        $wd = WakilDekan::where([
            'wakildekan.id' => Auth::user()->id,
            ])
        ->get();
        return view('wd.profilwd', [
            'wd' => $wd
        ]);
    }

    public function confirmIzin(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }
    
    public function validasi(Request $request)
    {
        $validation = $request->validate([
            'ttd_wd' => 'required',
        ], [
            'ttd_wd.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan',
        ]);
    }

    public function izinkan(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'ttd_wd' => $request->ttd_wd,
            $this->validasi($request),
            'status_id' => '3',
            'notif' => '1',
            // 'surat.ttd_wd' => Auth::user()->ttd_wd,
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }

    public function confirmTolak(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function tolak($id)
    {
        Surat::where('id', $id)->update([
            'status_id' => '6',
            'notif' => '1',
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
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilwd');
    }

    public function updateprofilwd(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:wakildekan,NIP,$id|unique:dosen,NIP|unique:petugas_penomoran,NIP|unique:ketua_departemen,NIP|unique:admin,NIP",
            'email_wd' => "email|required|unique:wakildekan,email_wd,$id|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas|unique:ketua_departemen,email_kadep|unique:admin,email_admin",
        ], 
            [
            'email_wd.email' => 'E-mail tidak boleh kosong',
            'email_wd.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',

        ]);
        
        // $request->validate([
        //     'ttd'=>'mimes:jpg,png,jpeg,svg',
        // ]);

        WakilDekan::where('id', $request->id)->update([
            'nama_wd' => $request->nama,
            'NIP' => $request->NIP,
            'email_wd' => $request->email_wd,
        ]);
        toast('Berhasil','success')->autoClose(2000);
        return redirect()->back();
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