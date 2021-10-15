<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Kadep;
use App\Models\Petugas;
use App\Models\WakilDekan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexadmin()
    {
        return view('admin.dashboardadmin', [
            "title" => "Dashboard Admin"
        ]); 
    }

    public function indexeditadmin()
    {
        return view('admin.editadmin', [
            "title" => "Edit Profil"
        ]); 
    }

    public function dataadmin()
    {
        
        $admin = DB::table('admin') -> get();
        return view('admin.dataadmin', ['admin' => $admin, "title" => "Data Admin"]);
    }

    public function editadmin($id)
    {
        $admin = DB::table('admin')->where('id', $id)->get();
        
        return view('admin.editadmin', ['admin' => $admin, "title" => "Edit Profil Admin"]);
    }
    
    public function updateadmin(Request $request)
    {
        DB::table('admin')->where('id', $request->id)->update([
            'nama_admin' => $request->nama,
            'NIP' => $request->NIP,
            'email_admin' => $request->email,
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_admin');
    }

    public function updatepasswordadmin(Request $request)
    {
        DB::table('admin')->where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_admin');
    }

    // controller Dosen di Admin //

    public function indexdosen()
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

    public function tambahdosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_dosen' => 'required|string',
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => 'email|required|unique:dosen',
            'password' => 'required|min:6',
        ], [
            'email_dosen.unique' => 'Email sudah ada yang menggunakan',
            'email_dosen.email' => 'Email tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password tidak boleh kosong'
        ]);
        Dosen::create([
            'nama_dosen' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
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
        Dosen::where('id', $request->id)->update([
            'nama_dosen' => $request->nama,
            'NIP' => $request->NIP,
            'jabatan' => $request->jabatan,
            'prodi_dosen' => $request->prodi_dosen,
            'email_dosen' => $request->email,
            'prodi_dosen' => $request->prodi,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('data_dosen');
    }

    public function updatepassworddosen(Request $request)
    {
        Dosen::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Password Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_dosen');
    }

    public function konfirmasidosen($id)
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

    // controller Kadep di Admin //

    public function datakadep()
    {
        $kadep = DB::table('ketua_departemen') -> get();
        return view('admin.datakadep', ['kadep' => $kadep, "title" => "Data Ketua Departemen"]);
    }
    public function indexkadep()
    {
        return view('admin.tambahkadep', [
            "title" => "Tambah Ketua Departemen"
        ]); 
    }

    public function tambahkadep(Request $request)
    {
        $request->validate([
            'nama_kadep' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_kadep' => 'required|string',
            'email_kadep' => 'email|required|unique:ketua_departemen',
            'password' => 'required|min:6',
        ], [
            'email_kadep.unique' => 'Email sudah ada yang menggunakan',
            'email_kadep.email' => 'Email tidak boleh kosong',
            'nama_kadep.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'password.min' => 'Password harus lebih dari 6 karakter',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        Kadep::create([
            'nama_kadep' => $request->nama_kadep,
            'NIP' => $request->NIP,
            'prodi_kadep' => $request->prodi_kadep,
            'email_kadep' => $request->email_kadep,
            'password' => Hash::make($request->password),

            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_kadep');
    }

    public function editkadep($id)
    {
        $kadep = DB::table('ketua_departemen')->where('id', $id)->get();
        return view('admin.editkadep', ['kadep' => $kadep, "title" => "Edit Profil Ketua Departemen"]);
    }

    public function updatekadep(Request $request)
    {
        Kadep::where('id', $request->id)->update([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'email_kadep' => $request->email,
            'prodi_kadep' => $request->prodi,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('data_kadep');
    }

    public function konfirmasikadep($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_kadep/'.$id.'/hapuskadep" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_kadep');
    }

    public function hapuskadep($id)
    {
        DB::table('ketua_departemen')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_kadep');
    }

    public function updatepasswordkadep(Request $request)
    {
        Kadep::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_kadep');
    }

        // controller WakilDekan di Admin //

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
        WakilDekan::create([
            'nama_wd' => $request->nama_wd,
            'NIP' => $request->NIP,
            'email_wd' => $request->email_wd,
            'password' => Hash::make($request->password),

            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_wakildekan');
    }

    public function indexwd1()
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
        WakilDekan::where('id', $request->id)->update([
            'nama_wd' => $request->nama,
            'NIP' => $request->NIP,
            'email_wd' => $request->email,

        ]);
        toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        return redirect('/data_wakildekan');
    }

    public function konfirmasiwd1($id)
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

    public function updatepasswordwd1(Request $request)
    {
        WakilDekan::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_wakildekan');
    }


        // controller Petugas di Admin //

    public function indexpetugas()
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
        Petugas::create([
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
        Petugas::where('id', $request->id)->update([
            'nama_petugas' => $request->nama,
            'NIP' => $request->NIP,
            'email_petugas' => $request->email,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('data_petugas');
    }

    public function konfirmasipetugas($id)
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

    public function updatepasswordpetugas(Request $request)
    {
        Petugas::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_petugas');
    }

}
