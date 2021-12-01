<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\WakilDekan;
use App\Models\Surat;
use App\Models\Dosen;
use App\Models\Golongan;
use App\Models\Jabatan;
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
        $dosen = Surat::with('status')
        ->where([
            'surat.status_id' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'dosen' => $dosen,
        ]);
    }

    public function dashboardwd(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '3')
        {
            return view('wd.dashboardwd');
        } else {
            return redirect()->back();
        }
        
    }

    public function daftarsurat(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '3')
        {
            $surat = Surat::with('status')
            ->where([
                'surat.status_id' => '2',
                ])
            ->orderBy('updated_at', 'DESC')
            ->get();
            return view('wd.daftarsuratwd', ['surat' => $surat]);
        } else {
            return redirect()->back();
        }
        
    }

    public function profilwd(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '3')
        {
            $wd = Dosen::with('prodi', 'jabatan', 'golongan')
            ->where([
                'dosen.id' => Auth::user()->id,
                ])
            ->get();
            $golongan = Golongan::all();
            $jabatan = Jabatan::where([
                'id' => '1',
                ])
            ->orWhere([
                'id' => '2',
                ])
            ->orWhere([
                'id' => '3',
                ])
            ->orWhere([
                'id' => '4',
                ])
            ->get();
            return view('wd.profilwd', [
                'wd' => $wd,
                'golongan' => $golongan,
                'jabatan' => $jabatan
            ]);
        } else {
            return redirect()->back();
        }
        
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
            'ttd_wd.required' => 'Anda tidak bisa menyetujui surat.
                                Silahkan upload tanda tangan di halaman Edit Profil.',
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

        Dosen::where(['dosen.id' => Auth::user()->id])->update([
            'ttd_wd' => $imgName,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilwd');
    }

    public function updateprofilwd(Request $request, $id)
    {
        $this->validate($request,[
            'nama_dosen' => 'required|max:255|string',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'NIP' => "required|numeric|min:6|unique:dosen,NIP,$id|unique:petugas_penomoran,NIP|unique:admin,NIP",
            'email_dosen' => "email|required|unique:dosen,email_dosen,$id|unique:petugas_penomoran,email_petugas|unique:admin,email_admin",
        ], 
            [
            'email_dosen.email' => 'E-mail tidak boleh kosong',
            'email_dosen.unique' => 'E-mail sudah ada yang menggunakan',
            'pangkat.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',

        ]);

        Dosen::where('id', $request->id)->update([
            'nama_dosen' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'email_dosen' => $request->email_dosen,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
        ]);
        toast('Berhasil','success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordwd(Request $request)
    {
        Dosen::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilwd');
    }
}