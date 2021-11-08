<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Kadep;
use App\Models\Surat;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class KadepController extends Controller
{

    public function dashboardkadep(Request $request)
    {
        return view('kadep.dashboardkadep');
    }
    public function profilKadep(Request $request)
    {
        $prodi = Prodi::all();
        $kadep = Kadep::where([
            'ketua_departemen.id' => Auth::user()->id,
            ])
        ->get();
        return view('kadep.profilkadep', [
            'prodi' => $prodi,
            'kadep' => $kadep
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
            'ttd_kadep.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan',
        ]);
    }

    public function izinkan(Request $request, $id)
    {
        

        $surat = Surat::find($id)->update([
            'ttd_kadep' => $request->ttd_kadep,
            $this->validasi($request),
            'status_id' => '2',
        ]);
        return response()->json([
            'success' => 'Sukses diizinkan',
            'surat' => $surat,
        ]);
        
    }
    public function tolak($id)
    {
        Surat::where('id', $id)->update([
            'status_id' => '5',
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
        toast('Berhasil', 'success')->autoClose(2000);
        return redirect('/profilkadep');
    }

    public function updateprofilkadep(Request $request)
    {
        Kadep::with('prodi')->where('id', '=', Auth::user()->id)->update([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_id' => $request->prodi,
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
