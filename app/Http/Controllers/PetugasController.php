<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Petugas;
use App\Models\Surat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasController extends Controller
{
    public function index()
    {
        return view('admin.tambahpetugas', [
            "title" => "Tambah Petugas Penomoran"
        ]); 
    } 

    public function datapetugas()
    {
        $petugas = DB::table('petugas_penomoran') -> get();
        return view('admin.datapetugas', ['petugas' => $petugas, "title" => "Data Petugas Penomoran"]);
    }

    public function tambahpetugas(Request $request)
    {
        DB::table('petugas_penomoran')->insert([
            'nama_petugas' => $request->nama,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email,
            'password' => Hash::make($request->password),

            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_petugas');
    }

    public function editpetugas($id)
    {
        $petugas = DB::table('petugas_penomoran')->where('id', $id)->get();
        return view('admin.editpetugas', ['petugas' => $petugas, "title" => "Edit Profil Petugas Penomoran"]);
    }

    public function updatepetugas(Request $request)
    {
        DB::table('petugas_penomoran')->where('id', $request->id)->update([
            'nama_petugas' => $request->nama,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('data_petugas');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_petugas/'.$id.'/hapuspetugas" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_petugas');
    }

    public function hapuspetugas($id)
    {
        DB::table('petugas_penomoran')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_petugas');
    }

    public function daftarsurat(Surat $surat)
    {
        $surat = DB::table('surat')
        ->whereNotNull(['surat.ttd_wd'])
        ->get();
        return view('petugas.daftarsuratpetugas', ['surat' => $surat]);
        // $surat = Surat::find([
        //     'status' => 'Belum diberi nomor',
        //     'status' => 'Sudah diberi nomor',
        //     ]);
        // return view('petugas.daftarsuratpetugas', ['surat' => $surat]);
    }

    public function editnomorsurat($id)
    {
        $surat = DB::table('surat')->where('id', $id)->get();
        return view('petugas.editnomor', ['surat' => $surat]);
    }

    public function updatenomorsurat(Request $request, $id)
    {
        // $request->validate([
        //     'no_surat' => 'unique:surat',
        // ],[
        //     'no_surat.unique' => 'Nomor tidak boleh sama'
        // ]);

        DB::table('surat')->where('id', $request->id)->update([
            'no_surat' => $request->no_surat,
            'status' => 'Sudah diberi nomor',
        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        return redirect('/daftarsuratpetugas');
    }
}
