<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\Kadep;
use Illuminate\Http\Request;

class KadepController extends Controller
{
    public function datakadep()
    {
        $kadep = DB::table('ketua_departemen') -> get();
        return view('admin.datakadep', ['kadep' => $kadep, "title" => "Data Ketua Departemen"]);
    }
    public function index()
    {
        return view('admin.tambahkadep', [
            "title" => "Tambah Ketua Departemen"
        ]); 
    }

    public function tambahkadep(Request $request)
    {
        DB::table('ketua_departemen')->insert([
            'nama_kadep' => $request->nama,
            'NIP' => $request->NIP,
            'prodi_kadep' => $request->prodi,
            'email_kadep' => $request->email,
            'password' => Hash::make($request->password),

            
        ]);
        return redirect('data_kadep');
    }

    public function hapuskadep($id)
    {
        DB::table('ketua_departemen')->where('id', $id)->delete();
        return redirect('/data_kadep');
    }
}
