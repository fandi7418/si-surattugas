<?php

namespace App\Http\Controllers;

// use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class SuratController extends Controller
{
    public function index()
    {
        return view('/dosen/buatsurat');
    }

    public function show(Surat $surat)
    {
        return view('suratpdf', compact('surat'));
        // $pdf = PDF::loadView('suratpdf', compact('surat'));
        // return $pdf->stream();
    }

    public function tambahsurat(Request $request)
    {
        Surat::create([
            'nama_dosen' => $request->nama,
            'NIP' => $request->nip,
            'prodi_id' => Auth::guard('dosen')->user()->prodi->id,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
            'status' => 'Menunggu persetujuan Kadep',
            'nama_kadep' => DB::table('ketua_departemen')
            ->where('ketua_departemen.prodi_id', '=', Auth::user()->prodi_id)
            ->first()->nama_kadep,
            'NIP_kadep' => DB::table('ketua_departemen')
            ->where('ketua_departemen.prodi_id', '=', Auth::user()->prodi_id)
            ->first()->NIP,
            'nama_wd' => DB::table('wakildekan')
            ->first()->nama_wd,
            'NIP_wd' => DB::table('wakildekan')
            ->first()->NIP,
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

    public function hapussurat($id)
    {
        DB::table('surat')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/daftarsuratdosen');
    }

    public function editsurat($id)
    {
        $surat = DB::table('surat')->where('id', $id)->get();
        return view('dosen.editsurat', ['surat' => $surat]);
    }

    public function updatesurat(Request $request)
    {
        Surat::where('id', $request->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->nip,
            'prodi' => $request->prodi,
            'pangkat' => $request->pangkat,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        return redirect('/daftarsuratdosen');
    }

    public function datasurat()
    {
        $surat = DB::table('surat')->orderBy('created_at', 'DESC')
        ->paginate(10);
        return view('admin.datasurat', ['surat' => $surat, "title" => "Data Surat Tugas"]);
    }

    public function konfirmasiadmin($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_surat/'.$id.'/hapussuratadmin" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_wakildekan');
    }

    public function hapussuratadmin($id)
    {
        DB::table('surat')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_surat');
    }

}