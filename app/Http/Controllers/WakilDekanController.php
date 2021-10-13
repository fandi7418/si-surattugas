<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Models\WakilDekan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class WakilDekanController extends Controller
{
    public function datawd1()
    {
        $wakildekan = DB::table('wakildekan') -> get();
        return view('admin.datawd1', ['wakildekan' => $wakildekan, "title" => "Data Wakil Dekan"]);
    }

    public function tambahwd1(Request $request)
    {
        $request->validate([
            'nama_wd' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'email_wd' => 'email|required|unique:wakildekan',
            'password' => 'required|min:6',
        ], [
            'email_wd.unique' => 'Email sudah ada yang menggunakan',
            'email_wd.email' => 'Email tidak boleh kosong',
            'nama_wd.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password tidak boleh kosong'
        ]);
        DB::table('wakildekan')->insert([
            'nama_wd' => $request->nama_wd,
            'NIP' => $request->NIP,
            'email_wd' => $request->email_wd,
            'password' => Hash::make($request->password),

            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_wakildekan');
    }

    public function index()
    {
        return view('admin.tambahwd1', [
            "title" => "Tambah Wakil Dekan"
        ]); 
    }

    public function editwd1($id)
    {
        $wakildekan = DB::table('wakildekan')->where('id', $id)->get();
        return view('admin.editwd1', ['wakildekan' => $wakildekan, "title" => "Edit Profil Wakil Dekan"]);
    }

    public function updatewd1(Request $request)
    {
        DB::table('wakildekan')->where('id', $request->id)->update([
            'nama_wd' => $request->nama,
            'NIP' => $request->NIP,
            'email_wd' => $request->email,

        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        return redirect('/data_wakildekan');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_wakildekan/'.$id.'/hapuswd1" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_wakildekan');
    }

    public function hapuswd1($id)
    {
        DB::table('wakildekan')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_wakildekan');
    }

    public function updatepassword(Request $request)
    {
        DB::table('wakildekan')->where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_wakildekan');
    }

    public function daftarsurat(Request $request)
    {
        $surat = DB::table('surat')
        ->where([
            'surat.status' => 'Menunggu persetujuan Wakil Dekan',
            ])
        ->get();
        return view('wd.daftarsuratwd', ['surat' => $surat]);
    }

    public function izinkan($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
            'status' => 'Belum diberi nomor',
            'surat.ttd_wd' => Auth::user()->ttd_wd,
        ]);
        return redirect('/daftarsuratwd');
        
    }

    public function tolak($id)
    {
        $surat = DB::table('surat')->where('id', $id)->update([
            'status' => 'Surat ditolak Wakil Dekan',
        ]);
        return redirect('/daftarsuratwd');
        
    }

    public function tandatangan(Request $request)
    {
        $request->validate([
            'ttd'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd->getClientOriginalName() . '-' . time() . '.' . $request->ttd->extension();
        $request->ttd->move(public_path('image'), $imgName);

        DB::table('wakildekan')->where(['wakildekan.id' => Auth::user()->id])->update([
            'ttd_wd' => $imgName,
        ]);
        return redirect('/daftarsuratwd');
    }
}