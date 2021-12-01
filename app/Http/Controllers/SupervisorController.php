<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Staff;
use App\Models\StatusSurat;
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
            'surat.status_id' => '7',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $staff = Surat::with('status')
        ->where([
            'surat.id_staff' => Auth::user()->id,
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
        if(Auth::guard('staff')->user()->roles_id == '6')
        {
            return view('supervisor.dashboardSpv');
        } else {
            return redirect()->back();
        }
    }

    public function daftarsuratSpv(Request $request)
    {
        if(Auth::guard('staff')->user()->roles_id == '6')
        {
            $surat = Surat::with('status')
            ->where([
                'surat.status_id' => '7',
            ])->orderBy('updated_at', 'DESC')->get();
            return view('supervisor.daftarsuratSpv', ['surat' => $surat]);
        } else {
            return redirect()->back();
        }
    }

    public function profilSpv()
    {
        if(Auth::guard('staff')->user()->roles_id == '6')
        {
            $staff = Staff::with('prodi')
            ->where('staff.id', '=', Auth::user()->id)
            ->get();
            return view('supervisor.profilSpv', [/*'prodi' => $prodi,*/ 'staff' => $staff]);
        } else {
            return redirect()->back();
        }
    }

    public function updateprofilSpv(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:staff,NIP,$id|unique:dosen,NIP|unique:ketua_departemen,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP|unique:admin,NIP",
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_staff' => "email|required|unique:staff,email_staff,$id|unique:ketua_departemen,email_kadep|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd|unique:admin,email_admin",
        ], 
            [
            'email_staff.email' => 'E-mail tidak boleh kosong',
            'email_staff.unique' => 'E-mail sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',

        ]);
        
        Staff::where('id', $request->id)->update([
            'nama_staff' => $request->nama,
            'NIP' => $request->NIP,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'email_staff' => $request->email_staff,
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

        Staff::where(['staff.id' => Auth::user()->id])->update([
            'ttd_spv' => $imgName,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilSpv');
    }

    public function editpasswordSpv(Request $request)
    {
        Staff::where('id', '=', Auth::user()->id)->update([
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
            'ttd_spv' => $request->ttd_spv,
            $this->validasi($request),
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

    public function tolakSpv($id)
    {
        $surat = Surat::where('id', $id)->update([
            'status_id' => '8',
            'notif' => '1',
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }
}