<?php

namespace App\Http\Controllers;

// use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\Pengguna;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class SuratController extends Controller
{
    public function index()
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
        $surat = Surat::with('status')
        ->where([
            'surat.id_pengguna' => Auth::user()->id,
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.id_pengguna' => Auth::user()->id,
            ])
        ->count();
        return view('/dosen/buatsurat', [
            'surat' => $surat,
            'count' => $count,
            'kadep' => $kadep,
            'wd' => $wd,
        ]);
    }

    public function show(Request $request, $id)
    {
        $surat=Surat::where('id', $id)
        ->get();
        $kadep=Pengguna::where([
            'pengguna.id' => $surat->first()->nama_kadep
        ])->get();
        $wd=Pengguna::where([
            'pengguna.id' => $surat->first()->nama_wd
        ])->get();
        $supervisor=Pengguna::where([
            'pengguna.id' => $surat->first()->nama_supervisor
        ])->get();
        return view('suratpdf', [
            'surat' => $surat,
            'kadep' => $kadep,
            'wd' => $wd,
            'supervisor' => $supervisor,
        ]);
        // $pdf = PDF::loadView('suratpdf', compact('surat'));
        // return $pdf->stream();
    }

    // public function show(Surat $surat)
    // {
        
    //     return view('suratpdf', compact('surat'));
    //     // $pdf = PDF::loadView('suratpdf', compact('surat'));
    //     // return $pdf->stream();
    // }

    public function tambahsurat(Request $request)
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
            'golongan_id' => Auth::guard('pengguna')->user()->golongan->id,
            'jabatan_id' => Auth::guard('pengguna')->user()->jabatan->id,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
            'status_id' => '1',
            'nama_kadep' => $request->id_kadep,
            'NIP_kadep' => $request->id_kadep,
            'nama_wd' => $request->id_wd,
            'NIP_wd' => $request->id_wd,
            'notif' => '1',
            'approve' => '0',
            'id_pengguna' => Auth::user()->id,
            'roles_id' => Auth::guard('pengguna')->user()->roles_id,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('/daftarsuratdosen');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapussurat/'.$id.'/hapussurat" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/daftarsuratdosen');
    }

    public function confirmHapusDosen(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }
    
    public function hapussurat($id)
    {
        $surat = Surat::where('id', $id)->delete();
        toast('Berhasil dihapus', 'success')->autoClose(2000);
        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function editsurat($id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function updatesurat(Request $request, $id)
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
}