<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;


class SuratController extends Controller
{
    public function index()
    {
        return view('/dosen/buatsurat');
    }

    public function show(Surat $surat)
    {
        return view('suratpdf', compact('surat'));
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
        ]);
        return redirect('buatsurat');
    }

    public function hapussurat($id)
    {
        DB::table('surat')->where('id', $id)->delete();
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
        return redirect('/daftarsuratdosen');
    }
}