<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Pengguna;
use App\Models\StatusSurat;
use App\Models\Bagian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SupervisorController extends Controller
{
    public function notifSpv(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.bagian_id' => Auth::user()->bagian_id,
            'surat.status_id' => '7',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $staff = Surat::with('status')
        ->where([
            'surat.id_pengguna' => Auth::user()->id,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'staff' => $staff,
        ]);
    }
    
    public function dashboardSpv(Request $request)
    {
        return view('supervisor.dashboardSpv');
    }

    public function daftarsuratSpv(Request $request)
    {
        $surat = Surat::with('status', 'bagian')
        ->where([
            'surat.bagian_id' => Auth::user()->bagian_id,
            'surat.status_id' => '7',
        ])->orderBy('updated_at', 'DESC')->get();
        return view('supervisor.daftarsuratSpv', ['surat' => $surat]);
    }

    public function profilSpv()
    {
        $staff = Pengguna::with('prodi', 'jabatan', 'golongan')
        ->where('pengguna.id', '=', Auth::user()->id)
        ->get();
        $golongan = Golongan::all();
        $jabatan = Jabatan::where([
            'id' => '5',
            ])
        ->orWhere([
            'id' => '6',
            ])
        ->get();
        return view('supervisor.profilSpv', [
            'staff' => $staff,
            'golongan' => $golongan,
            'jabatan' => $jabatan
        ]);
    }

    public function updateprofilSpv(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|string|min:6|unique:pengguna,NIP,$id",
            'pangkat' => 'required',
            'jabatan' => 'required',
            'email_staff' => "email|required|unique:pengguna,email,$id",
        ], 
            [
            'email_staff.email' => 'E-mail tidak boleh kosong',
            'email_staff.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'pangkat.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',

        ]);
        
        Pengguna::where('id', $request->id)->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
            'email' => $request->email_staff,
        ]);
        Surat::where([
            'id_pengguna' => Auth::user()->id,
            'approve' => '0',
            ])->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function tandatanganSpv(Request $request)
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
        return redirect('/profilSpv');
    }

    public function editpasswordSpv(Request $request)
    {
        Pengguna::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilSpv');
    }

    public function confirmIzinSpv(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }
    
    public function validasi(Request $request)
    {
        $validation = $request->validate([
            'ttd_spv' => 'required',
        ], [
            'ttd_spv.required' => 'Anda tidak bisa menyetujui surat.
                                    Silahkan upload tanda tangan di halaman Edit Profil.',
        ]);
    }

    public function izinkanSpv(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'status_id' => '2',
            'notif' => '1',
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }

    public function confirmTolakSpv(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function tolakSpv(Request $request, $id)
    {
        $cek=Surat::where(['id' => $id,])->get();
        if($cek->first()->prodi_id == null)
        {
            $surat = Surat::where('id', $id)->update([
                'status_id' => '8',
                'notif' => '1',
                'approve' => '2',
                'bagian_id' => Bagian::where([
                    'id' => $cek->first()->bagian_id,
                ])->first()->bagian,
                'nama_wd' => Pengguna::where([
                    'id' => $cek->first()->NIP_wd,
                ])->first()->nama,
                'NIP_wd' => Pengguna::where([
                    'id' => $cek->first()->NIP_wd,
                ])->first()->NIP,
                'golongan_id' => Golongan::where([
                    'id' => $cek->first()->golongan_id,
                ])->first()->nama_golongan,
                'jabatan_id' => Jabatan::where([
                    'id' => $cek->first()->jabatan_id,
                ])->first()->nama_jabatan,
            ]);
        }else{
            $surat = Surat::where('id', $id)->update([
                'prodi_id' => Prodi::where([
                    'id' => $cek->first()->prodi_id,
                ])->first()->prodi,
                'status_id' => '8',
                'notif' => '1',
                'approve' => '2',
                'bagian_id' => Bagian::where([
                    'id' => $cek->first()->bagian_id,
                ])->first()->bagian,
                'nama_wd' => Pengguna::where([
                    'id' => $cek->first()->NIP_wd,
                ])->first()->nama,
                'NIP_wd' => Pengguna::where([
                    'id' => $cek->first()->NIP_wd,
                ])->first()->NIP,
                'golongan_id' => Golongan::where([
                    'id' => $cek->first()->golongan_id,
                ])->first()->nama_golongan,
                'jabatan_id' => Jabatan::where([
                    'id' => $cek->first()->jabatan_id,
                ])->first()->nama_jabatan,
            ]);
        }
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }
}
