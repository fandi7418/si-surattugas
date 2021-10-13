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
        $request->validate([
            'nama_petugas' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'email_petugas' => 'email|required|unique:petugas_penomoran',
            'password' => 'required|min:6',
        ], [
            'email_petugas.unique' => 'Email sudah ada yang menggunakan',
            'email_petugas.email' => 'Email tidak boleh kosong',
            'nama_petugas.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password tidak boleh kosong'
        ]);
        DB::table('petugas_penomoran')->insert([
            'nama_petugas' => $request->nama_petugas,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email_petugas,
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

<<<<<<< HEAD
    public function updatepassword(Request $request)
    {
        DB::table('petugas_penomoran')->where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_petugas');
=======
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
>>>>>>> 86a3f2f368ed11ed20db0e7ffac27d8a9598bf71
    }
}
