<?php

namespace App\Http\Controllers;

use Auth;
use PDF;
use App\Models\WakilDekan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class WakilDekanController extends Controller
{
    public function datawd1()
    {
        $wakildekan = DB::table('wakildekan') -> get();
        return view('admin.datawd1', ['wakildekan' => $wakildekan, "title" => "Data Wakil Dekan"]);
    }

    public function tambahwd1(Request $request)
    {
        DB::table('wakildekan')->insert([
            'nama_wd' => $request->nama,
            'NIP' => $request->NIP,
            'email_wd' => $request->email,
            'password' => Hash::make($request->password),

            
        ]);
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
        return redirect('/data_wakildekan');
    }

    public function hapuswd1($id)
    {
        DB::table('wakildekan')->where('id', $id)->delete();
        return redirect('/data_wakildekan');
    }
}
