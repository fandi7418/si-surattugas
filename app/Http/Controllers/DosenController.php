<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Dosen;
use App\Models\Admin;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function index()
    {
        return view('admin.tambahdosen', [
            "title" => "Tambah Dosen"
        ]); 
    }   
    public function datadosen()
    {
        
        $dosen = DB::table('dosen')-> get();
        return view('admin.datadosen', ['dosen' => $dosen, "title" => "Data Dosen"]);
    }
    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where(['surat.NIP' => Auth::user()->NIP])
        ->get();
        return view('dosen.daftarsuratdosen', ['surat' => $surat]);
    }

    public function tambahdosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_dosen' => 'required|string',
            'email_dosen' => 'email|required|unique:dosen',
            'password' => 'required|min:6',
        ], [
            'email_dosen.unique' => 'Email sudah ada yang menggunakan',
            'email_dosen.email' => 'Email tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password tidak boleh kosong'
        ]);
        DB::table('dosen')->insert([
            'nama_dosen' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'prodi_dosen' => $request->prodi_dosen,
            'email_dosen' => $request->email_dosen,
            'password' => Hash::make($request->password),
            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('data_dosen');
    }

    public function editdosen($id)
    {
        $dosen = DB::table('dosen')->where('id', $id)->get();
        return view('admin.editdosen', ['dosen' => $dosen, "title" => "Edit Profil"]);
    }

    public function updatedosen(Request $request)
    {
        DB::table('dosen')->where('id', $request->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'email_dosen' => $request->email,
            'prodi_dosen' => $request->prodi,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('data_dosen');
    }

    public function updatepassword(Request $request)
    {
        DB::table('dosen')->where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_dosen');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_dosen/'.$id.'/hapusdosen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_dosen');
    }

    public function hapusdosen($id)
    {
        Dosen::where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_dosen');

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }

}
