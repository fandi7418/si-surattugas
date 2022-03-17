<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Pengguna;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class StaffController extends Controller
{
    public function clearNotifStaff()
    {
        $surat = Surat::with('status')
        ->where(['surat.id_staff' => Auth::user()->id,])
        ->update([
            'notif' => '2',
        ]);
        return response()->json([
            'surat' => $surat,
        ]);
    }
    
    public function notifStaff(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.id_staff' => Auth::user()->id,
            'surat.notif' => '1',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $petugas = Surat::with('status')
        ->where([
            'surat.status_id' => '3',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $supervisor = Surat::with('status')
        ->where([
            'surat.status_id' => '7',
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        return response()->json([
            'surat' => $surat,
            'petugas' => $petugas,
            'supervisor' => $supervisor,
        ]);
    }
    
    public function dashboardStaff(Request $request)
    {
        return view('staff.dashboardStaff');
    }

    public function daftarsuratStaff(Request $request)
    {
        $surat = Surat::with('status')
        ->where([
            'surat.id_staff' => Auth::user()->id,
        ])->orderBy('updated_at', 'DESC')->get();
        return view('staff.daftarsuratStaff', ['surat' => $surat]);
    }

    public function profilStaff()
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
        return view('staff.profilStaff', [
            'staff' => $staff,
            'golongan' => $golongan,
            'jabatan' => $jabatan
        ]);
    }

    public function buatsuratStaff()
    {
    $kadep = Pengguna::where([
        'prodi_id' => Auth::user()->prodi_id,
        'roles_id' => '2',
        ])
    ->get();
    $wd = Pengguna::where([
        'roles_id' => '3',
        ])
    ->get();
    $supervisor = Pengguna::where([
        'roles_id' => '6',
        ])
    ->get();
    return view('staff.buatsuratStaff', [
        'kadep' => $kadep,
        'wd' => $wd,
        'supervisor' => $supervisor,
    ]);
    }

    public function tambahsuratStaff(Request $request)
    {
        $request->validate([
            'tanggalawal' => 'date_format:Y-m-d|after_or_equal:today',
            'tanggalakhir' => 'date_format:Y-m-d|after_or_equal:tanggalawal',
            'nama_wd' => 'required',
            'nama_kadep' => 'required',
        ], [
            'tanggalawal.after_or_equal' => 'Input tidak valid',
            'tanggalakhir.after_or_equal' => 'Input tidak valid',
            'nama_wd.required' => 'Wakil Dekan tidak ditemukan, silahkan hubungi Admin',
            'nama_kadep.required' => 'Kadep tidak ditemukan, silahkan hubungi Admin'
        ]);
        Surat::create([
            'nama' => $request->nama,
            'NIP' => $request->nip,
            'prodi_id' => Auth::guard('pengguna')->user()->prodi->id,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
            'status_id' => '1',
            'nama_kadep' => $request->nama_kadep,
            'NIP_kadep' => $request->NIP_kadep,
            'nama_wd' => $request->nama_wd,
            'NIP_wd' => $request->NIP_wd,
            'notif' => '1',
            'id_staff' => Auth::guard('pengguna')->user()->id,
            'roles_id' => Auth::guard('pengguna')->user()->roles_id,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('/daftarsuratStaff');
    }

    public function tambahsuratStaffFT(Request $request)
    {
        $request->validate([
            'tanggalawal' => 'date_format:Y-m-d|after_or_equal:today',
            'tanggalakhir' => 'date_format:Y-m-d|after_or_equal:tanggalawal',
            'nama_wd' => 'required',
            'nama_spv' => 'required',
        ], [
            'tanggalawal.after_or_equal' => 'Input tidak valid',
            'tanggalakhir.after_or_equal' => 'Input tidak valid',
            'nama_wd.required' => 'Wakil Dekan tidak ditemukan, silahkan hubungi Admin',
            'nama_spv.required' => 'Supervisor tidak ditemukan, silahkan hubungi Admin'
        ]);
        Surat::create([
            'nama' => $request->nama,
            'NIP' => $request->nip,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
            'status_id' => '7',
            'nama_supervisor' => $request->nama_spv,
            'NIP_supervisor' => $request->NIP_spv,
            'nama_wd' => $request->nama_wd,
            'NIP_wd' => $request->NIP_wd,
            'notif' => '1',
            'id_staff' => Auth::guard('pengguna')->user()->id,
            'roles_id' => Auth::guard('pengguna')->user()->roles_id,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('/daftarsuratStaff');
    }

    public function editsuratStaff($id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function updatesuratStaff(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
        ]);
        return response()->json([ 
            'success' => true,
            'surat' => $surat
        ]);
    }

    public function confirmHapusStaff(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }
    
    public function hapussuratStaff($id)
    {
        $surat = Surat::where('id', $id)->delete();
        toast('Berhasil dihapus', 'success')->autoClose(2000);
        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function updateprofilStaff(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:staff,NIP,$id|unique:dosen,NIP",
            'pangkat' => 'required',
            'jabatan' => 'required',
            'email_staff' => "email|required|unique:staff,email_staff,$id|unique:ketua_departemen,email_kadep|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd|unique:admin,email_admin",
        ], 
            [
            'email_staff.email' => 'E-mail tidak boleh kosong',
            'email_staff.unique' => 'E-mail sudah ada yang menggunakan',
            'pangkat.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',

        ]);
        
        Pengguna::where('id', $request->id)->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'golongan_id' => $request->pangkat,
            'jabatan_id' => $request->jabatan,
            'email' => $request->email_staff,
        ]);
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect()->back();
    }

    public function editpasswordStaff(Request $request)
    {
        Pengguna::where('id', '=', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(2000);
        return redirect('/profilStaff');
    }
}
