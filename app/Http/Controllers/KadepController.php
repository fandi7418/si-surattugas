<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KadepController extends Controller
{

    public function notifKadep()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.status_id' => '1',
            'surat.prodi_id' => Auth::user()->prodi_id,
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $dosen = Surat::with('status')
        ->where([
            'surat.id_pengguna' => Auth::user()->id,
            'surat.notif' => '1',
        ])
        // ->where([
        //     'surat.notif' => '1',
        // ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'dosen' => $dosen,
        ]);
    }
    
    public function dashboardkadep(Request $request)
    {
        return view('kadep.dashboardkadep');
        
    }

    public function profilKadep(Request $request)
    {
        $prodi = Prodi::all();
        $golongan = Golongan::all();
        $kadep = Pengguna::with('prodi', 'jabatan', 'golongan')
        ->where([
            'pengguna.id' => Auth::user()->id,
            ])
        ->get();
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
        return view('kadep.profilkadep', [
            'prodi' => $prodi,
            'golongan' => $golongan,
            'kadep' => $kadep,
            'jabatan' => $jabatan
        ]);
        
    }

    public function daftarsurat(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            'surat.status_id' => '1',
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return view('kadep.daftarsuratkadep', ['surat' => $surat]);
        
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
            // 'ttd_kadep' => $request->ttd_kadep,
            // $this->validasi($request),
            'status_id' => '2',
            'notif' => '1',
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
        $cek=Surat::where(['id' => $id,])->get();
        $surat = Surat::where('id', $id)->update([
            'status_id' => '5',
            'notif' => '1',
            'approve' => '2',
            'nama_kadep' => Pengguna::where([
                'pengguna.id' => $cek->first()->nama_kadep,
            ])->first()->nama,
            'NIP_kadep' => Pengguna::where([
                'pengguna.id' => $cek->first()->nama_kadep,
            ])->first()->NIP,
            'nama_wd' => Pengguna::where([
                'pengguna.id' => $cek->first()->nama_wd,
            ])->first()->nama,
            'NIP_wd' => Pengguna::where([
                'pengguna.id' => $cek->first()->nama_wd,
            ])->first()->NIP,
            'prodi_id' => Prodi::where([
                'id' => $cek->first()->prodi_id,
            ])->first()->prodi,
            'golongan_id' => Golongan::where([
                'id' => $cek->first()->golongan_id,
            ])->first()->nama_golongan,
            'jabatan_id' => Jabatan::where([
                'id' => $cek->first()->jabatan_id,
            ])->first()->nama_jabatan,
        ]);
        return response()->json([
            'success' => 'Sukses ditolak',
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

        Pengguna::where(['pengguna.id' => Auth::user()->id])->update([
            'ttd' => $imgName,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilkadep');
    }

    public function updateprofilkadep(Request $request, $id)
    {
        $this->validate($request,[
            'nama_dosen' => 'required|max:255|string',
            'pangkat' => 'required',
            'jabatan' => 'required',
            'NIP' => "required|string|min:6|unique:pengguna,NIP,$id",
            'email_dosen' => "email|required|unique:pengguna,email,$id",
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
        
        Pengguna::with('prodi')->where('id', $request->id)->update([
            'nama' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'email' => $request->email_dosen,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
        ]);
        Surat::where([
            'id_pengguna' => Auth::user()->id,
            'approve' => '0',
            ])->update([
            'nama' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordkadep(Request $request)
    {
        Pengguna::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }
}
