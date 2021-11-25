<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Kadep;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KadepController extends Controller
{

    public function notifKadep()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status_id' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $dosen = Surat::with('status')
        ->where([
            'surat.NIP' => Auth::user()->NIP,
            'surat.nama_dosen' => Auth::user()->nama_dosen,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'dosen' => $dosen,
        ]);
    }
    
    public function dashboardkadep(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '2')
        {
            return view('kadep.dashboardkadep');
        } else {
            return redirect()->back();
        }
        
    }

    public function profilKadep(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '2')
        {
            $prodi = Prodi::all();
            $kadep = Dosen::with('prodi')
            ->where([
                'dosen.id' => Auth::user()->id,
                ])
            ->get();
            return view('kadep.profilkadep', [
                'prodi' => $prodi,
                'kadep' => $kadep
            ]);
        } else {
            return redirect()->back();
        }
        
    }

    public function daftarsurat(Request $request)
    {
        if(Auth::guard('dosen')->user()->roles_id == '2')
        {
            $surat = Surat::with('status')
            ->where([
                'surat.prodi_id' => Auth::user()->prodi_id,
                'surat.status_id' => '1',
                ])
            ->orderBy('updated_at', 'DESC')
            ->get();
            return view('kadep.daftarsuratkadep', ['surat' => $surat]);
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
            'ttd_kadep' => 'required',
        ], [
            'ttd_kadep.required' => 'Anda tidak bisa menyetujui surat.
                                    Silahkan upload tanda tangan di halaman Edit Profil.',
        ]);
    }

    public function izinkan(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'ttd_kadep' => $request->ttd_kadep,
            $this->validasi($request),
            'status_id' => '2',
            'notif' => '1',
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }

    // public function validasi(Request $request)
    // {
    //     $validation = $request->validate([
    //         'ttd_kadep' => 'required',
    //     ], [
    //         'ttd_kadep.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan',
    //     ]);
    // }


    public function confirmTolak(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function tolak($id)
    {
        $surat = Surat::where('id', $id)->update([
            'status_id' => '5',
            'notif' => '1',
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }

    public function tandatangan(Request $request)
    {
        $request->validate([
            'ttd'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd->getClientOriginalName() . '-' . time() . '.' . $request->ttd->extension();
        $request->ttd->move(public_path('image'), $imgName);

        Dosen::where(['dosen.id' => Auth::user()->id])->update([
            'ttd_kadep' => $imgName,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilkadep');
    }

    public function updateprofilkadep(Request $request, $id)
    {
        $this->validate($request,[
            'nama_dosen' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:dosen,NIP,$id|unique:petugas_penomoran,NIPunique:admin,NIP",
            'email_dosen' => "email|required|unique:dosen,email_dosen,$id|unique:petugas_penomoran,email_petugas|unique:admin,email_admin",
        ], 
            [
            'email_dosen.email' => 'E-mail tidak boleh kosong',
            'email_dosen.unique' => 'E-mail sudah ada yang menggunakan',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',

        ]);
        
        Dosen::with('prodi')->where('id', $request->id)->update([
            'nama_dosen' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'email_dosen' => $request->email_dosen,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordkadep(Request $request)
    {
        Dosen::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }
}
