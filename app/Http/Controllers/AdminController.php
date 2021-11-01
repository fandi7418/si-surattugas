<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Kadep;
use App\Models\Petugas;
use App\Models\Prodi;
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

    public function dataadmin(Request $request)
    {
        
        $admin = DB::table('admin') -> get();
        if ($request->ajax()){
            return datatables()->of($admin)->addColumn('action', function($data){
                $url_edit = url('edit_dosen/'.$data->id);
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';  
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
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
        // return view('admin.tambahdosen', [
        //     "title" => "Tambah Dosen"
        // ]); 
        $prd = Prodi::all();
        return view('admin.tambahdosen', ['prd' => $prd, "title" => "Tambah Dosen"]);
    }   
    public function datadosen(Request $request)
    {
        // $prodi = Prodi::all();
        // $dosen = Dosen::with('prodi')->orderBy('created_at', 'DESC')
        // ->paginate(10);
        // return view('admin.datadosen', ['dosen' => $dosen, 'prodi' => $prodi, "title" => "Data Dosen"]);
        $prodi = Prodi::all();
        $dosen = Dosen::with('prodi')
        ->get(); 
        if ($request->ajax()){
            return datatables()->of($dosen)->addColumn('action', function($data){
                $url_edit = url('edit_dosen/'.$data->id);
                $url_hapus = url('hapus_dosen/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datadosen', ['prodi' => $prodi, "title" => "Data Dosen"]);
    }

    public function tambahdosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_id' => 'required',
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => 'email|required|unique:dosen',
            'password' => 'required|min:6',
        ], [
            'email_dosen.unique' => 'Email sudah ada yang menggunakan',
            'email_dosen.email' => 'Email tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'prodi_id.required' => 'Program Studi tidak boleh kosong',
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
            'prodi_id' => $request->prodi_id,
            'email_dosen' => $request->email_dosen,
            'password' => Hash::make($request->password),
            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('data_dosen');
    }

    public function editdosen($id)
    {
        $prd = Prodi::all();
        $dosen = Dosen::with('Prodi')->where('id', $id)->get();
        return view('admin.editdosen', ['dosen' => $dosen, 'prd' => $prd, "title" => "Edit Profil Dosen"]);
    }

    public function updatedosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_id' => 'required',
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => 'email|required',
        ], 
            [
            'email_dosen.email' => 'Email tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'prodi_id.required' => 'Program Studi tidak boleh kosong',
            'pangkat.required' => 'Pangkat tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',

        ]);
        Dosen::where('id', $request->id)->update([
            'nama_dosen' => $request->nama_dosen,
            'NIP' => $request->NIP,
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'prodi_id' => $request->prodi_id,
            'email_dosen' => $request->email_dosen,
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

    public function datakadep(Request $request)
    {
        $kadep = Kadep::with('Prodi') -> get();
        if ($request->ajax()){
            return datatables()->of($kadep)->addColumn('action', function($data){
                $url_edit = url('edit_kadep/'.$data->id);
                $url_hapus = url('hapus_kadep/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datakadep', [ "title" => "Data Ketua Departemen"]);
    }
    public function indexkadep()
    {
        // return view('admin.tambahkadep', [
        //     "title" => "Tambah Ketua Departemen"
        // ]);
        $prd = Prodi::all();
        return view('admin.tambahkadep', ['prd' => $prd, "title" => "Tambah Ketua Departemen"]);
    }

    public function tambahkadep(Request $request)
    {
        $request->validate([
            'nama_kadep' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_id' => 'required',
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
            'prodi_id' => $request->prodi_id,
            'email_kadep' => $request->email_kadep,
            'password' => Hash::make($request->password),

            
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_kadep');
    }

    public function editkadep($id)
    {
        $prd = Prodi::all();
        $kadep = Kadep::with('Prodi')->where('id', $id)->get();
        return view('admin.editkadep', ['kadep' => $kadep, 'prd' => $prd, "title" => "Edit Profil Ketua Departemen"]);
    }

    public function updatekadep(Request $request)
    {
        $request->validate([
            'nama_kadep' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6',
            'prodi_id' => 'required',
            'email_kadep' => 'email|required',
        ], [
            'email_kadep.email' => 'Email tidak boleh kosong',
            'nama_kadep.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
        ]);
        Kadep::where('id', $request->id)->update([
            'nama_kadep' => $request->nama_kadep,
            'NIP' => $request->NIP,
            'email_kadep' => $request->email_kadep,
            'prodi_id' => $request->prodi_id,
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

        public function datawd1(Request $request)
    {
        $wakildekan = DB::table('wakildekan') -> get();
        if ($request->ajax()){
            return datatables()->of($wakildekan)->addColumn('action', function($data){
                $url_edit = url('edit_wakildekan/'.$data->id);
                $url_hapus = url('hapus_wakildekan/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datawd1', ["title" => "Data Wakil Dekan"]);
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

    public function datapetugas(Request $request)
    {
        $petugas = Petugas::get();
        if ($request->ajax()){
            return datatables()->of($petugas)->addColumn('action', function($data){
                $url_edit = url('edit_petugas/'.$data->id);
                $url_hapus = url('hapus_petugas/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datapetugas', ["title" => "Data Petugas Penomoran"]);
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
