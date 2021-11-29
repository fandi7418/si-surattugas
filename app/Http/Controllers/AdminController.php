<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Staff;
use App\Models\Kadep;
use App\Models\Petugas;
use App\Models\Prodi;
use App\Models\Surat;
use App\Models\StatusSurat;
use App\Models\WakilDekan;
use App\Models\Roles;
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
        
        $admin = Admin::get();
        if ($request->ajax()){
            return datatables()->of($admin)->addColumn('action', function($data){
                $url_edit = url('edit_admin/'.$data->id);
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
        $admin = Admin::where('id', $id)->get();
        
        return view('admin.editadmin', ['admin' => $admin, "title" => "Edit Profil Admin"]);
    }
    
    public function updateadmin(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:admin,NIP,$id|unique:wakildekan,NIP|unique:ketua_departemen,NIP|unique:dosen,NIP|unique:petugas_penomoran,NIP",
            'email' => "email|required|unique:admin,email_admin,$id|unique:wakildekan,email_wd,$id|unique:ketua_departemen,email_kadep|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas"
        ], [
            'email.email' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan'
        ]);
        Admin::where('id', $request->id)->update([
            'nama_admin' => $request->nama,
            'NIP' => $request->NIP,
            'email_admin' => $request->email,
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_admin');
    }

    public function updatepasswordadmin(Request $request)
    {
        Admin::where('id', $request->id)->update([
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
        // // ]); 
        // $prd = Prodi::all();
        // $prd = Prodi::with('prodi')->get();
        $prd = Prodi::all();
        return view('admin.tambahdosen', ['prd' => $prd, "title" => "Tambah Dosen"]);
    }   
    public function datadosen(Request $request)
    {
        // $prodi = Prodi::all();
        // $dosen = Dosen::with('prodi')->orderBy('created_at', 'DESC')
        // ->paginate(10);
        // return view('admin.datadosen', ['dosen' => $dosen, 'prodi' => $prodi, "title" => "Data Dosen"]); 
        if ($request->ajax()){
            $dosen = Dosen::with('prodi','roles')
            ->get();
            return datatables()->of($dosen)->addColumn('action', function($data){
                $url_edit = url('edit_dosen/'.$data->id);
                $url_hapus = url('hapus_dosen/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Nonaktif</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
    }
    return view('admin.datadosen', ["title" => "Data Dosen"]);
}
    public function datadosensementara (Request $request)
    {
        $dosen = Dosen::onlyTrashed()->with('prodi');
        if ($request->ajax()){
            $dosen = Dosen::onlyTrashed()->with('prodi')
            ->get();
            return datatables()->of($dosen)->addColumn('action', function($data){
                $url_restore = url('data_dosen/restore/'.$data->id);
                $url_hapus = url('hapus_dosenpermanen/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_restore.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i> Restore</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus Permanen</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
    }
    return view('admin.datadosen_trash', ['dosen' => $dosen, "title" => "Data Dosen Sementara"]);
}
    // if(request()->ajax())
    // {
    //     if($request->prodi)
    //     {
    //         $data = DB::table('dosen')
    //                 ->join('prodi', 'prodi.prodi.id', '=', 'dosen.prodi')
    //                 ->select('dosen.id', 'dosen.nama_dosen', 'dosen.NIP', 'prodi.prodi')
    //                 -where('dosen.prodi', $request->prodi);
    //     }
    //     else
    //     {
    //         $data = DB::table('dosen')
    //                 ->join('prodi', 'prodi.id', '=', 'dosen.prodi')
    //                 ->select('dosen.id', 'dosen.nama_dosen', 'dosen.NIP', 'prodi.prodi');
    //     }
    //     return datatables()->of($data)->make(true);
    // }    
    //     $prodi = DB::table('prodi')
    //                 ->select("*")
    //                 ->get();
    public function tambahdosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|max:255|string',
            'NIP' => 'required|numeric|min:6|unique:dosen,NIP|unique:ketua_departemen,NIP|unique:admin,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP',
            'prodi_id' => 'required',
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => 'email|required|unique:dosen,email_dosen|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd',
            'password' => 'required|min:6',
        ], [
            'email_dosen.unique' => 'Email sudah ada yang menggunakan',
            'email_dosen.email' => 'Email tidak boleh kosong',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
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
            'roles_id' => '1',
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

    public function updatedosen(Request $request, $id)
    {
        $this->validate($request,[
            'nama_dosen' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:dosen,NIP,$id|unique:ketua_departemen,NIP|unique:admin,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP",
            'prodi_id' => 'required',
            'pangkat' => 'required|string',
            'jabatan' => 'required|string',
            'email_dosen' => "email|required|unique:dosen,email_dosen,$id|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd"
        ], 
            [
            'email_dosen.email' => 'Email tidak boleh kosong',
            'email_dosen.unique' => 'Email sudah ada yang menggunakan',
            'nama_dosen.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
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
        return redirect()->back();
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
        alert()->question('Peringatan','Anda yakin akan Menonaktifkan Akun? ')
        ->showConfirmButton('<a href="/hapus_dosen/'.$id.'/hapusdosen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_dosen');
    }
    public function konfirmasidosenpermanen($id)
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
        ->showConfirmButton('<a href="/hapus_dosen/'.$id.'/hapusdosenpermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }
    public function konfirmasidosenpermanensemua()
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Semua Akun? ')
        ->showConfirmButton('<a href="/hapusdosenpermanensemua" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_dosen');
    }

    public function hapusdosen($id)
    {
        Dosen::where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dinonaktifkan');
        return redirect('/data_dosen');

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }
    public function hapusdosenpermanen($id)
    {
        $dosen = Dosen::onlyTrashed()->where('id',$id);
        $dosen->forceDelete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_dosen/trash');

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }

    public function hapusdosenpermanensemua()
    {
        $dosen = Dosen::onlyTrashed();
        $dosen->forceDelete();
        Alert::success('Sukses', 'Data Berhasil Dihapus Permanen');
        return redirect()->back();

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }

    public function restoredosen($id)
    {
        // Dosen::where('id', $id)->delete();
        // Alert::success('Sukses', 'Data Berhasil Dihapus');
        // return redirect('/data_dosen');

        $dosen = Dosen::onlyTrashed()->where('id',$id);
        $dosen->restore();
        
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
        
        return redirect('/data_dosen/trash');

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }
    public function restoredosensemua()
    {
        // Dosen::where('id', $id)->delete();
        // Alert::success('Sukses', 'Data Berhasil Dihapus');
        // return redirect('/data_dosen');

        $dosen = Dosen::onlyTrashed();
        $dosen->restore();
        
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan semua');
        
        return redirect()->back();

        // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
        // file::delete()
    }

    // controller Kadep di Admin //

    public function datakadep(Request $request)
    {
        $kadep = Dosen::with('prodi') -> where('roles_id', '=', '2')->get();
        if ($request->ajax()){
            return datatables()->of($kadep)->addColumn('action', function($data){
                $url_hapus = url('hapus_kadep/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_hapus.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-danger btn-sm edit-post"><i class="far fa-danger"></i>Hapus</a>';  
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datakadep', [ 'kadep' => $kadep, "title" => "Data Ketua Departemen"]);
    }

    public function datakadepsementara (Request $request)
    {
        if ($request->ajax()){
            $kadep = Kadep::onlyTrashed()->with('prodi')
            ->get();
            return datatables()->of($kadep)->addColumn('action', function($data){
                $url_restore = url('data_kadep/restore/'.$data->id);
                $url_hapus = url('hapus_kadeppermanen/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_restore.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i> Restore</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus Permanen</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
    }
    return view('admin.datakadep_trash', ["title" => "Data Dosen Sementara"]);
}
    public function indexkadep()
    {
        // return view('admin.tambahkadep', [
        //     "title" => "Tambah Ketua Departemen"
        // // ]);
        $prd = Prodi::where([
            'prodi.status' => '1',
        ])->get();
        return view('admin.tambahkadep', ['prd' => $prd, "title" => "Tambah Ketua Departemen"]);
    }
    public function listNamaDosen($prodi_id)
    {
        $dosen = Dosen::where([
            'prodi_id' => $prodi_id,
            'roles_id' => '1',
            ])
            ->get();
        return response()->json([
            'dosen' => $dosen,
        ]);
    }

    public function tambahkadep(Request $request)
    {
        $request->validate([
            'nama_kadep' => 'required',
            // 'NIP' => 'required|numeric|min:6|unique:ketua_departemen,NIP|unique:dosen,NIP|unique:admin,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP',
            'prodi' => 'required',
            // 'email_kadep' => 'email|required|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd',
            // 'password' => 'required|min:6',
        ], [
            // 'email_kadep.unique' => 'Email sudah ada yang menggunakan',
            // 'email_kadep.email' => 'Email tidak boleh kosong',
            'nama_kadep.required' => 'Nama tidak boleh kosong',
            // 'NIP.required' => 'NIP tidak boleh kosong',
            // 'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'prodi.required' => 'Pilih salah satu program studi',
            // 'prodi_id.unique' => 'Ketua departemen untuk Program Studi ini sudah ada',
            // 'password.min' => 'Password harus lebih dari 6 karakter',
            // 'password.required' => 'Password tidak boleh kosong'
        ]);

        Dosen::with('prodi')->where('id', '=', $request->nama_kadep)->update([
            'roles_id' => '2',
            // 'NIP' => $request->NIP,
            // 'prodi_id' => $request->prodi_id,
            // 'email_kadep' => $request->email_kadep,
            // 'password' => Hash::make($request->password),
            
        ]);
        Prodi::where('id', '=', $request->prodi)->update([
            'status' => '2',
        ]);
        // Dosen::where('prodi_id', '=', $request->prodi)->update([
        //     'statusKadep' => ''
        // ])
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('data_kadep');
    }

    public function editkadep($id)
    {
        $prd = Prodi::all();
        $kadep = Kadep::with('prodi')->where('id', $id)->get();
        return view('admin.editkadep', ['kadep' => $kadep, 'prd' => $prd, "title" => "Edit Profil Ketua Departemen"]);
    }

    public function updatekadep(Request $request, $id)
    {
        $request->validate([
            'nama_kadep' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:ketua_departemen,NIP,$id|unique:admin,NIP|unique:dosen,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP",
            'prodi_id' => 'required',
            'email_kadep' => "email|required|unique:ketua_departemen,email_kadep,$id|unique:admin,email_admin|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd"
        ], [
            'email_kadep.email' => 'Email tidak boleh kosong',
            'email_kadep.unique' => 'Email sudah ada yang menggunakan',
            'nama_kadep.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan',
            'prodi_id.required' => 'Pilih salah satu program studi',
        ]);
        Kadep::where('id', $request->id)->update([
            'nama_kadep' => $request->nama_kadep,
            'NIP' => $request->NIP,
            'email_kadep' => $request->email_kadep,
            'prodi_id' => $request->prodi_id,
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect()->back();
    }

    public function konfirmasiKadep($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_kadep/'.$id.'/hapuskadep" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();
        return redirect('/data_kadep');
    }

    public function konfirmasikadeppermanen($id)
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
        ->showConfirmButton('<a href="/hapus_kadep/'.$id.'/hapuskadeppermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function konfirmasikadeppermanensemua($id)
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
        ->showConfirmButton('<a href="/hapus_kadep/'.$id.'/hapuskadeppermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function hapuskadeppermanen($id)
    {
        $kadep = Kadep::onlyTrashed()->where('id',$id);
        $kadep->forceDelete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_kadep/trash');
    }

    public function hapuskadeppermanensemua()
    {
        $kadep = Kadep::onlyTrashed();
        $kadep->forceDelete();
        Alert::success('Sukses', 'Data Berhasil Dihapus Permanen');
        return redirect()->back();
    }

    public function restorekadep($id)
    {
        $kadep = Kadep::onlyTrashed()->where('id',$id);
        $kadep->restore();
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
        return redirect('/data_kadep/trash');
    }
    public function restorekadepsemua()
    {
        $kadep = Kadep::onlyTrashed();
        $kadep->restore();
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan semua');
        return redirect()->back();
    }

    public function hapusKadep($id)
    {
        Dosen::where('id', $id)->update([
            'roles_id' => '1',
        ]);
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_kadep');
    }

    public function updatepasswordkadep(Request $request)
    {
        Kadep::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect()->back();
    }

    public function updatettdkadep(Request $request)
    {
        $request->validate([
            'ttd_kadep'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd_kadep->getClientOriginalName() . '-' . time() . '.' . $request->ttd_kadep->extension();
        $request->ttd_kadep->move(public_path('image'), $imgName);

        Kadep::where('id', $request->id)->update([
            'ttd_kadep' => $imgName,
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect()->back();
    }

        // controller WakilDekan di Admin //

        public function datawd1(Request $request)
    {
        $wd = Dosen::where('roles_id', '=', '3')->get();
        return view('admin.datawd1', ['wd' => $wd, "title" => "Data Wakil Dekan"]);
    }
        public function datawd1sementara(Request $request)
    {
        $wd = WakilDekan::onlyTrashed()->get();
        return view('admin.datawd1_trash', ['wd' => $wd, "title" => "Data Wakil Dekan Sementara"]);
    }

    public function tambahwd1(Request $request)
    {
        // $request->validate([
        //     'nama_wd' => 'required|max:255|string',
        //     'NIP' => 'required|numeric|min:6|unique:wakildekan,NIP|unique:ketua_departemen,NIP|unique:dosen,NIP|unique:admin,NIP|unique:petugas_penomoran,NIP',
        //     'email_wd' => 'email|required|unique:wakildekan,email_wd|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas',
        //     'password' => 'required|min:6',
        // ], [
        //     'email_wd.unique' => 'Email sudah ada yang menggunakan',
        //     'email_wd.email' => 'Email tidak boleh kosong',
        //     'nama_wd.required' => 'Nama tidak boleh kosong',
        //     'NIP.required' => 'NIP tidak boleh kosong',
        //     'NIP.unique' => 'NIP sudah ada yang menggunakan',
        //     'password.min' => 'Password harus lebih dari 6 karakter',
        //     'password.required' => 'Password tidak boleh kosong'
        // ]);
        // WakilDekan::create([
        //     'nama_wd' => $request->nama_wd,
        //     'NIP' => $request->NIP,
        //     'email_wd' => $request->email_wd,
        //     'password' => Hash::make($request->password),
        // ]);

        // Alert::success('Sukses', 'Data Berhasil Ditambah');
        // return redirect('data_wakildekan');
        $wd = Dosen::with('prodi') -> where('roles_id', '=', '1')->get();
        if ($request->ajax()){
            return datatables()->of($wd)->addColumn('action', function($data){
                $url_edit = url('pilihWD/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Pilih</a>';  
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.tambahwd1', [ 'wd' => $wd, "title" => "Tambah Wakil Dekan"]);
    }

    public function indexwd1()
    {
        return view('admin.tambahwd1', [
            "title" => "Tambah Wakil Dekan"
        ]); 
    }

    public function editwd1($id)
    {
        $wakildekan = WakilDekan::where('id', $id)->get();
        return view('admin.editwd1', ['wakildekan' => $wakildekan, "title" => "Edit Profil Wakil Dekan"]);
    }

    public function updatewd1(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:wakildekan,NIP,$id|unique:ketua_departemen,NIP|unique:admin,NIP|unique:dosen,NIP|unique:petugas_penomoran,NIP",
            'email' => "email|required|unique:wakildekan,email_wd,$id|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:dosen,email_dosen|unique:petugas_penomoran,email_petugas"
        ], [
            'email.email' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan'
        ]);
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
        alert()->question('Peringatan','Pilih menjadi Wakil Dekan? ')
        ->showConfirmButton('<a href="pilih_wakildekan/'.$id.'/pilihWD" class="text-white" style="text-decoration: none">Pilih</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function pilihWD($id)
    {
        Dosen::where('id', $id)->update([
            'roles_id' => '3'
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
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

    public function updatettdwd1(Request $request)
    {
        $request->validate([
            'ttd_wd'=>'mimes:jpg,png,jpeg,svg',
        ]);

        $imgName = $request->ttd_wd->getClientOriginalName() . '-' . time() . '.' . $request->ttd_wd->extension();
        $request->ttd_wd->move(public_path('image'), $imgName);

        WakilDekan::where('id', $request->id)->update([
            'ttd_wd' => $imgName,
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect()->back();
    }

    public function restorewd1($id)
    {
        $wakildekan = WakilDekan::onlyTrashed()->where('id',$id);
        $wakildekan->restore();
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
        return redirect()->back();
    }

    public function konfirmasiWD($id)
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
        ->showConfirmButton('<a href="/hapus_wakildekan/'.$id.'/hapuswakildekan" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function hapusWD($id)
    {
        $wakildekan = Dosen::where('id',$id)->update([
            'roles_id' => '1'
        ]);
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->back();
    }


        // controller Petugas di Admin //

    // public function indexpetugas()
    // {
    //     return view('admin.tambahpetugas', [
    //         "title" => "Tambah Petugas Penomoran"
    //     ]); 
    // } 

    public function datapetugas(Request $request)
    {
        $petugas = Staff::where('roles_id', '=', '7')->get();
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
        return view('admin.datapetugas', ['petugas' => $petugas, "title" => "Data Petugas Penomoran"]);
    }
    public function datapetugassementara(Request $request)
    {
        if ($request->ajax()){
            $petugas = Petugas::onlyTrashed()->get();
            return datatables()->of($petugas)->addColumn('action', function($data){
                $url_restore = url('data_petugas/restore/'.$data->id);
                $url_hapuspermanen = url('hapus_petugaspermanen/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_restore.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i>Restore</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapuspermanen.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i>Hapus Permanen</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datapetugas_trash', ["title" => "Data Petugas Penomoran"]);
    }

    public function tambahpetugas(Request $request)
    {
        // $request->validate([
        //     'nama_petugas' => 'required|max:255|string',
        //     'NIP' => 'required|numeric|min:6|unique:petugas_penomoran,NIP|unique:ketua_departemen,NIP|unique:dosen,NIP|unique:admin,NIP|unique:wakildekan,NIP',
        //     'email_petugas' => 'email|required|unique:petugas_penomoran,email_petugas|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:dosen,email_dosen|unique:wakildekan,email_wd',
        //     'password' => 'required|min:6',
        // ], [
        //     'email_petugas.unique' => 'Email sudah ada yang menggunakan',
        //     'email_petugas.email' => 'Email tidak boleh kosong',
        //     'nama_petugas.required' => 'Nama tidak boleh kosong',
        //     'NIP.required' => 'NIP tidak boleh kosong',
        //     'NIP.unique' => 'NIP sudah ada yang menggunakan',
        //     'password.min' => 'Password harus lebih dari 6 karakter',
        //     'password.required' => 'Password tidak boleh kosong'
        // ]);
        // Petugas::create([
        //     'nama_petugas' => $request->nama_petugas,
        //     'NIP' => $request->NIP,
        //     'email_petugas' => $request->email_petugas,
        //     'password' => Hash::make($request->password),

            
        // ]);
        // Alert::success('Sukses', 'Data Berhasil Ditambah');
        // return redirect('data_petugas');
        $petugas = Staff::where('roles_id', '=', '4')->get();
        if ($request->ajax()){
            return datatables()->of($petugas)->addColumn('action', function($data){
                $url_edit = url('pilihPetugas/'.$data->id.'/konfirmasi');
                $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Pilih</a>';  
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.tambahpetugas', [ 'petugas' => $petugas, "title" => "Tambah Petugas Penomoran"]);
    }

    public function konfirmasiPilihPetugas($id)
    {
        alert()->question('Peringatan','Pilih menjadi Petugas Penomoran? ')
        ->showConfirmButton('<a href="pilih_PetugasPenomoran/'.$id.'/pilihPetugas" class="text-white" style="text-decoration: none">Pilih</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function pilihPetugas($id)
    {
        Staff::where('id', $id)->update([
            'roles_id' => '7'
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('/data_petugas');
    }

    public function editpetugas($id)
    {
        $petugas = Petugas::where('id', $id)->get();
        return view('admin.editpetugas', ['petugas' => $petugas, "title" => "Edit Profil Petugas Penomoran"]);
    }

    public function updatepetugas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|string',
            'NIP' => "required|numeric|min:6|unique:petugas_penomoran,NIP,$id|unique:wakildekan,NIP|unique:ketua_departemen,NIP|unique:admin,NIP|unique:dosen,NIP",
            'email' => "email|required|unique:petugas_penomoran,email_petugas,$id|unique:wakildekan,email_wd|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:dosen,email_dosen"
        ], [
            'email.email' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah ada yang menggunakan',
            'nama.required' => 'Nama tidak boleh kosong',
            'NIP.required' => 'NIP tidak boleh kosong',
            'NIP.unique' => 'NIP sudah ada yang menggunakan'
        ]);
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

        return redirect()->back();
    }

    public function hapuspetugas($id)
    {
        $petugas = Staff::where('id',$id)->update([
            'roles_id' => '4'
        ]);
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->back();
    }

    public function restorepetugas($id)
    {
        $petugas = Petugas::onlyTrashed()->where('id',$id);
        $petugas->restore();
        Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
        return redirect()->back();
    }

    public function konfirmasipetugaspermanen($id)
    {
        alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
        ->showConfirmButton('<a href="/hapus_petugas/'.$id.'/hapuspetugaspermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect()->back();
    }

    public function hapuspetugaspermanen($id)
    {
        $petugas = Petugas::onlyTrashed()->where('id',$id);
        $petugas->forceDelete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect()->back();
    }

    public function updatepasswordpetugas(Request $request)
    {
        Petugas::where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_petugas');
    }

// Route Data Supervisor

public function dataspv(Request $request)
{
    $spv = Staff::where('roles_id', '=', '6')->get();
    if ($request->ajax()){
        return datatables()->of($spv)->addColumn('action', function($data){
            $url_edit = url('edit_spv/'.$data->id);
            $url_hapus = url('hapus_spv/'.$data->id.'/konfirmasi');
            $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
            return $button;
        })
        ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
    }
    return view('admin.datasupervisor', ['spv' => $spv, "title" => "Data Supervisor"]);
}

public function tambahspv(Request $request)
{
    $spv = Staff::where('roles_id', '=', '4')->get();
    if ($request->ajax()){
        return datatables()->of($spv)->addColumn('action', function($data){
            $url_edit = url('pilihSpv/'.$data->id.'/konfirmasi');
            $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i>Pilih</a>';  
            return $button;
        })
        ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
    }
    return view('admin.tambahsupervisor', [ 'spv' => $spv, "title" => "Tambah Supervisor"]);
}

public function konfirmasiPilihSpv($id)
{
    alert()->question('Peringatan','Pilih menjadi Supervisor? ')
    ->showConfirmButton('<a href="pilih_supervisor/'.$id.'/pilih" class="text-white" style="text-decoration: none">Pilih</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect()->back();
}

public function pilihSpv($id)
{
    Staff::where('id', $id)->update([
        'roles_id' => '6'
    ]);
    Alert::success('Sukses', 'Data Berhasil Ditambahkan');
    return redirect('data_supervisor');
}

public function konfirmasispv($id)
{
    alert()->question('Peringatan','Anda yakin akan menghapus? ')
    ->showConfirmButton('<a href="/hapus_spv/'.$id.'/hapusspv" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect()->back();
}

public function hapusspv($id)
{
    $spv = Staff::where('id',$id)->update([
        'roles_id' => '4'
    ]);
    Alert::success('Sukses', 'Data Berhasil Dihapus');
    return redirect()->back();
}

// Route Data Surat


public function datasurat(Request $request)
{
    // $surat = Surat::with('status','prodi')->orderBy('created_at', 'DESC')
    // ->paginate(10);
    // return view('admin.datasurat', ['surat' => $surat, "title" => "Data Surat Tugas"]);

    // $surat = Surat::with('status','prodi')->get();
    // if ($request->ajax()){
    //     return datatables()->of($surat)
    //     ->editColumn('created_at', function ($data) {
    //         return $data->created_at ? with(new Carbon($data->created_at))->isoFormat('D MMMM Y') : '';
    //     })
    //     ->addColumn('action', function($data){
    //         $url_lihat = url('surat/'.$data->id);
    //         $url_hapus = url('hapus_surat/'.$data->id.'/konfirmasiadmin');
    //         $button = '<a href="'.$url_lihat.'" data-toggle="tooltip" target="_blank"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Lihat</a>';
    //         $button .= '&nbsp;&nbsp;';
    //         $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
    //         return $button;
    //     })
    //     ->rawColumns(['action'])
    //                 ->addIndexColumn()
    //                 ->make(true);
    // }
    // return view('admin.datasurat', ["title" => "Data Surat Tugas"]);
    $surat = Surat::with('status','prodi')
    ->orderBy('updated_at', 'DESC')
    ->get();
    return view('admin.datasurat', ['surat' => $surat, "title" => "Data Surat Tugas"]);
}

public function datasuratsementara(Request $request)
{
    $surat = Surat::onlyTrashed()->with('status','prodi')
    ->orderBy('updated_at', 'DESC')
    ->get();
    return view('admin.datasurat_trash', ['surat' => $surat, "title" => "Data Surat Sementara"]);
}

public function confirmIzinkadep(Request $request, $id)
{
    $surat = Surat::findOrFail($id);
    $kadep = Kadep::where('prodi_id', '=', $surat->prodi_id)->get();
    return response()->json([
        'surat' => $surat,
        'kadep' => $kadep,
    ]);
}
// public function validasiKadep(Request $request)
// {
//     $validation = $request->validate([
//         'ttd_kadep' => 'required',
//     ], [
//         'ttd_kadep.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan, silahkan tambahkan di bagian edit akun',
//     ]);
// }

public function izinkanKadepadmin(Request $request, $id)
{
    // $surat = Surat::find($id)->update([
    //     'ttd_kadep' => $request->ttd_kadep,
    //     $this->validasikadep($request),
    //     'status_id' => '2',
    // ]);
    // $this->validasikadep($request);
        $request->validate([
        'ttd_kadep' => 'required',
        
    ], [
        'ttd_kadep.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan, silahkan tambahkan di bagian edit akun',
        
    ]);
    $surat = Surat::where('id', $request->id)->update([
        'ttd_kadep' => $request->ttd_kadep,
        'status_id' => '2',
        'notif' => '1',
        
    ]);
    return response()->json([
        'success' => 'Sukses diizinkan',
        'surat' => $surat,
    ]);
}

public function confirmIzinwd(Request $request, $id)
{
    $surat = Surat::findOrFail($id);
    $wd = WakilDekan::all();
    return response()->json([
        'surat' => $surat,
        'wd' => $wd,
    ]);
}
public function validasiwd(Request $request)
{
    $validation = $request->validate([
        'ttd_wd' => 'required',
    ], [
        'ttd_wd.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan, silahkan tambahkan di bagian edit akun',
    ]);
}

public function izinkanwdadmin(Request $request, $id)
{
    $request->validate([
        'ttd_wd' => 'required',
        
    ], [
        'ttd_wd.required' => 'Anda tidak bisa menyetujui surat. Tanda tangan belum ditambahkan, silahkan tambahkan di bagian edit akun',
        
    ]);
    $surat = Surat::find($id)->update([
        'ttd_wd' => $request->ttd_wd,
        'status_id' => '3',
        'notif' => '1',
    ]);
    return response()->json([
        'success' => 'Sukses diizinkan',
        'surat' => $surat,
    ]);
}

public function izinkanKadep(Request $request, $id)
{
    $prd = Prodi::all();
    $surat = Surat::with('prodi')->where('id', $id)->get();
    return view('admin.izinkankadep', ['surat' => $surat, 'prd' => $prd, 'title' => 'Izinkan Surat']);
}

public function postizinkanKadep(Request $request, $id)
{
    // $request->validate([
    //     'ttd_kadep'=>'mimes:jpg,png,jpeg,svg',
    // ]);

    // $imgName = $request->ttd_kadep->getClientOriginalName() . '-' . time() . '.' . $request->ttd_kadep->extension();
    // $request->ttd_kadep->move(public_path('image'), $imgName);

    Surat::where('id', $request->id)->update([
        'ttd_kadep' => Kadep::where('prodi_id', '=', Surat::first()->prodi_id)
        ->first()->ttd_kadep,
        'status_id' => '2',
        
    ]);
    toast('Data Berhasil Diubah','success')->autoClose(5000);
    return redirect('data_surat');
}
public function izinkanwd(Request $request, $id)
{
    $prd = Prodi::all();
    $surat = Surat::with('prodi')->where('id', $id)->get();
    return view('admin.izinkanwd', ['surat' => $surat, 'prd' => $prd, 'title' => 'Izinkan Surat']);
}

public function postizinkanwd(Request $request, $id)
{
    
    // $request->validate([
    //     'ttd_wd'=>'required|mimes:jpg,png,jpeg,svg',
    // ], [
    //     'ttd_wd.required' => 'Anda belum menambahkan Tanda tangan Wakil Dekan',
    // ]);

    // $imgName = $request->ttd_wd->getClientOriginalName() . '-' . time() . '.' . $request->ttd_wd->extension();
    // $request->ttd_wd->move(public_path('image'), $imgName);
    Surat::where('id', $request->id)->update([
        'ttd_wd' => WakilDekan::first()->ttd_wd,
        'status_id' => '3',
        
    ]);
    toast('Data Berhasil Diubah','success')->autoClose(5000);
    return redirect('data_surat');
}

public function konfirmasisuratadmin($id)
{
    alert()->question('Peringatan','Anda yakin akan menghapus? ')
    ->showConfirmButton('<a href="/hapus_surat/'.$id.'/hapussuratadmin" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect()->back();
}

public function hapussuratadmin($id)
{
    Surat::where('id', $id)->delete();
    Alert::success('Sukses', 'Data Berhasil Dihapus');
    return redirect('/data_surat');
}

public function konfirmasisuratadminpermanen($id)
{
    alert()->question('Peringatan','Anda yakin akan menghapus? ')
    ->showConfirmButton('<a href="/hapus_suratpermanen/'.$id.'/hapussuratadminpermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect()->back();
}

public function hapussuratpermanen($id)
{
    $surat = Surat::onlyTrashed()->where('id',$id);
    $surat->forceDelete();
    Alert::success('Sukses', 'Data Berhasil Dihapus');
    return redirect()->back();
}

public function restoresurat($id)
{
    $surat = Surat::onlyTrashed()->where('id',$id);
    $surat->restore();
    Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
    return redirect()->back();
}

//Controller Staff di Admin

public function indexstaff()
{
    $prd = Prodi::all();
    return view('admin.tambahstaff', ['prd' => $prd, "title" => "Tambah staff"]);
}   
public function datastaff(Request $request)
{
    // $prodi = Prodi::all();
    // $dosen = Dosen::with('prodi')->orderBy('created_at', 'DESC')
    // ->paginate(10);
    // return view('admin.datadosen', ['dosen' => $dosen, 'prodi' => $prodi, "title" => "Data Dosen"]); 
    $staff = Staff::with('prodi','roles')->get();
    if ($request->ajax()){
        $staff = Staff::with('prodi','roles')->get();
        return datatables()->of($staff)->addColumn('action', function($data){
            $url_edit = url('edit_staff/'.$data->id);
            $url_hapus = url('hapus_staff/'.$data->id.'/konfirmasi');
            $button = '<a href="'.$url_edit.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Nonaktif</a>';     
            return $button;
        })
        ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
}
return view('admin.datastaff', ['staff' => $staff, "title" => "Data Staff"]);
}
public function datastaffsementara (Request $request)
{
    $staff = Staff::onlyTrashed()->with('prodi','roles');
    if ($request->ajax()){
        $staff = Staff::onlyTrashed()->with('prodi','roles')
        ->get();
        return datatables()->of($staff)->addColumn('action', function($data){
            $url_restore = url('data_staff/restore/'.$data->id);
            $url_hapus = url('hapus_staffpermanen/'.$data->id.'/konfirmasi');
            $button = '<a href="'.$url_restore.'" data-toggle="tooltip"  data-id="" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i> Restore</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Hapus Permanen</a>';     
            return $button;
        })
        ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
}
return view('admin.datastaff_trash', ['staff' => $staff, "title" => "Data Staff Sementara"]);
}

public function tambahstaff(Request $request)
{
    $request->validate([
        'nama_staff' => 'required|max:255|string',
        'NIP' => 'required|numeric|min:6|unique:staff,NIP|unique:admin,NIP|unique:dosen,NIP',
        'pangkat' => 'required|string',
        'jabatan' => 'required|string',
        'roles_id' => 'required',
        'email_staff' => 'email|required|unique:staff,email_staff|unique:admin,email_admin|unique:dosen,email_dosen',
        'password' => 'required|min:6',
    ], [
        'email_staff.unique' => 'Email sudah ada yang menggunakan',
        'email_staff.email' => 'Email tidak boleh kosong',
        'nama_staff.required' => 'Nama tidak boleh kosong',
        'roles_id.required' => 'status tidak boleh kosong',
        'NIP.required' => 'NIP tidak boleh kosong',
        'NIP.unique' => 'NIP sudah ada yang menggunakan',
        'pangkat.required' => 'Pangkat tidak boleh kosong',
        'jabatan.required' => 'Jabatan tidak boleh kosong',
        'password.min' => 'Password harus lebih dari 6 karakter',
        'password.required' => 'Password tidak boleh kosong'
    ]);
    Staff::create([
        'nama_staff' => $request->nama_staff,
        'NIP' => $request->NIP,
        'pangkat' => $request->pangkat,
        'jabatan' => $request->jabatan,
        'prodi_id' => $request->prodi_id,
        'email_staff' => $request->email_staff,
        'roles_id' => $request->roles_id,
        'password' => Hash::make($request->password),
        
    ]);
    Alert::success('Sukses', 'Data Berhasil Ditambahkan');
    return redirect('data_staff');
}

public function editstaff($id)
{
    $prd = Prodi::all();
    $staff = Staff::with('Prodi')->where('id', $id)->get();
    return view('admin.editstaff', ['staff' => $staff, 'prd' => $prd, "title" => "Edit Profil Staff"]);
}

public function updatestaff(Request $request, $id)
{
    // $this->validate($request,[
    //     'nama_dosen' => 'required|max:255|string',
    //     'NIP' => "required|numeric|min:6|unique:dosen,NIP,$id|unique:ketua_departemen,NIP|unique:admin,NIP|unique:petugas_penomoran,NIP|unique:wakildekan,NIP",
    //     'prodi_id' => 'required',
    //     'pangkat' => 'required|string',
    //     'jabatan' => 'required|string',
    //     'email_dosen' => "email|required|unique:dosen,email_dosen,$id|unique:ketua_departemen,email_kadep|unique:admin,email_admin|unique:petugas_penomoran,email_petugas|unique:wakildekan,email_wd"
    // ], 
    //     [
    //     'email_dosen.email' => 'Email tidak boleh kosong',
    //     'email_dosen.unique' => 'Email sudah ada yang menggunakan',
    //     'nama_dosen.required' => 'Nama tidak boleh kosong',
    //     'NIP.required' => 'NIP tidak boleh kosong',
    //     'NIP.unique' => 'NIP sudah ada yang menggunakan',
    //     'prodi_id.required' => 'Program Studi tidak boleh kosong',
    //     'pangkat.required' => 'Pangkat tidak boleh kosong',
    //     'jabatan.required' => 'Jabatan tidak boleh kosong',

    // ]);
    Staff::where('id', $request->id)->update([
        'nama_staff' => $request->nama_staff,
        'NIP' => $request->NIP,
        'jabatan' => $request->jabatan,
        'pangkat' => $request->pangkat,
        'prodi_id' => $request->prodi_id,
        'email_staff' => $request->email_staff,
    ]);
    toast('Data Berhasil Diubah','success')->autoClose(5000);
    return redirect()->back();
}

public function updatepasswordstaff(Request $request)
{
    Staff::where('id', $request->id)->update([
        'password' => Hash::make($request->password),
        
    ]);
    toast('Password Berhasil Diubah','success')->autoClose(5000);
    return redirect('/data_staff');
}

public function konfirmasistaff($id)
{
    alert()->question('Peringatan','Anda yakin akan Menonaktifkan Akun? ')
    ->showConfirmButton('<a href="/hapus_staff/'.$id.'/hapusstaff" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect('/data_staff');
}

public function hapusstaff($id)
{
    Staff::where('id', $id)->delete();
    Alert::success('Sukses', 'Data Berhasil Dinonaktifkan');
    return redirect('/data_staff');

    // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
    // file::delete()
}
public function konfirmasistaffpermanen($id)
{
    alert()->question('Peringatan','Anda yakin akan Menghapus Akun? ')
    ->showConfirmButton('<a href="/hapus_staff/'.$id.'/hapusstaffpermanen" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
    ->showCancelButton('Batal', '#aaa')->reverseButtons();

    return redirect()->back();
}
public function hapusstaffpermanen($id)
{
    $staff = Staff::onlyTrashed()->where('id',$id);
    $staff->forceDelete();
    Alert::success('Sukses', 'Data Berhasil Dihapus');
    return redirect('/data_staff/trash');

    // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
    // file::delete()
}

public function restorestaff($id)
{
    // staff::where('id', $id)->delete();
    // Alert::success('Sukses', 'Data Berhasil Dihapus');
    // return redirect('/data_staff');

    $staff = Staff::onlyTrashed()->where('id',$id);
    $staff->restore();
    
    Alert::success('Sukses', 'Data Berhasil Dikembalikkan');
    
    return redirect('/data_staff/trash');

    // $dosen = dosen::select('sampul', 'id')->whereId($id)->firstOrfail();
    // file::delete()
}
}
