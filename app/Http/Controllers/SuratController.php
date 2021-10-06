<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class SuratController extends Controller
{
    public function index()
    {
        return view('/dosen/buatsurat');
    }

    public function show(Surat $surat)
    {
        // return view('suratpdf', compact('surat'));
        $pdf = PDF::loadView('suratpdf', compact('surat'));
        return $pdf->stream();
    }

    public function tambahsurat(Request $request)
    {
        DB::table('surat')->insert([
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
            'status' => 'Menunggu persetujuan Kadep',
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('buatsurat');
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
        DB::table('surat')->where('id', $request->id)->update([
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
        $surat = DB::table('surat') -> get();
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