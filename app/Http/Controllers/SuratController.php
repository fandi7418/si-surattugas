<?php

namespace App\Http\Controllers;

// use Auth;
use PDF;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Prodi;
use App\Models\Kadep;
use App\Models\WakilDekan;
use App\Models\StatusSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->orderBy('updated_at', 'DESC')
        ->get();
        $count = Surat::with('status')
        ->where([
            'surat.prodi_id' => Auth::user()->prodi_id,
            ])
        ->count();
        return view('/dosen/buatsurat', ['surat' => $surat, 'count' => $count]);
    }

    public function show(Surat $surat)
    {
        return view('suratpdf', compact('surat'));
        // $pdf = PDF::loadView('suratpdf', compact('surat'));
        // return $pdf->stream();
    }

    public function tambahsurat(Request $request)
    {
        Surat::create([
            'nama_dosen' => $request->nama,
            'NIP' => $request->nip,
            'prodi_id' => Auth::guard('dosen')->user()->prodi->id,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'judul' => $request->judul,
            'jenis' => $request->jeniskegiatan,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
            'status_id' => '1',
            'nama_kadep' => Kadep::where('prodi_id', '=', Auth::user()->prodi_id)
            ->first()->nama_kadep,
            'NIP_kadep' => Kadep::where('prodi_id', '=', Auth::user()->prodi_id)
            ->first()->NIP,
            'nama_wd' => WakilDekan::first()->nama_wd,
            'NIP_wd' => WakilDekan::first()->NIP,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Sukses', 'Data Berhasil Ditambah');
        return redirect('/daftarsuratdosen');
    }

    public function konfirmasi($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapussurat/'.$id.'/hapussurat" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/daftarsuratdosen');
    }

    public function hapussurat($id)
    {
        DB::table('surat')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/daftarsuratdosen');
    }

    public function editsurat($id)
    {
        $surat = Surat::findOrFail($id);
        return response()->json([
            'surat' => $surat
        ]);
    }

    public function updatesurat(Request $request, $id)
    {
        $surat = Surat::find($id)->update([
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'tempat' => $request->tempat,
            'kota' => $request->kota,
            'tanggalawal' => $request->tanggalawal,
            'tanggalakhir' => $request->tanggalakhir,
        ]);
        return response()->json([ 
            'success' => true,
            'surat' => $surat
        ]);
        
        // Surat::where('id', $request->id)->update([
        //     'nama_dosen' => $request->nama,
        //     'NIP' => $request->nip,
        //     'prodi' => $request->prodi,
        //     'pangkat' => $request->pangkat,
        //     'judul' => $request->judul,
        //     'jenis' => $request->jeniskegiatan,
        //     'tempat' => $request->tempat,
        //     'kota' => $request->kota,
        //     'tanggalawal' => $request->tanggalawal,
        //     'tanggalakhir' => $request->tanggalakhir,
        // ]);
        // toast('Data Berhasil Diubah', 'success')->autoClose(5000);
        // return redirect('/daftarsuratdosen');
    }

    public function datasurat(Request $request)
    {
        // $surat = Surat::with('status','prodi')->orderBy('created_at', 'DESC')
        // ->paginate(10);
        // return view('admin.datasurat', ['surat' => $surat, "title" => "Data Surat Tugas"]);
    
        $surat = Surat::with('status','prodi')->get();
        if ($request->ajax()){
            return datatables()->of($surat)
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with(new Carbon($data->created_at))->isoFormat('D MMMM Y') : '';
            })
            ->addColumn('action', function($data){
                $url_lihat = url('surat/'.$data->id);
                $url_hapus = url('hapus_surat/'.$data->id.'/konfirmasiadmin');
                $button = '<a href="'.$url_lihat.'" data-toggle="tooltip" target="_blank"  data-id="" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Lihat</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href="'.$url_hapus.'" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>';     
                return $button;
            })
            ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.datasurat', ["title" => "Data Surat Tugas"]);

    }

    public function konfirmasiadmin($id)
    {
        alert()->question('Peringatan','Anda yakin akan menghapus? ')
        ->showConfirmButton('<a href="/hapus_surat/'.$id.'/hapussuratadmin" class="text-white" style="text-decoration: none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return redirect('/data_surat');
    }

    public function hapussuratadmin($id)
    {
        DB::table('surat')->where('id', $id)->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/data_surat');
    }

}