<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KadepController;
use App\Http\Controllers\WakilDekanController;
use App\Http\Controllers\PetugasPenomoranController;
use App\Http\Controllers\SuratController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route login */
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/* Route Admin */

Route::group(['middleware' => ['auth:admin']], function()
{

    // route untuk data admin //
    Route::get('/dashboard_admin', [AdminController::class, 'indexadmin'])->name('dashboard admin');

    Route::get('/data_admin', [AdminController::class, 'dataadmin'])->name('data admin');
    
    Route::get('/edit_admin/{id}', [AdminController::class, 'editadmin'])->name('edit data admin');
    
    Route::post('/update_admin/{id}', [AdminController::class, 'updateadmin'])->name('update data admin'); 
    
    Route::post('/update_passwordadmin/{id}', [AdminController::class, 'updatepasswordadmin'])->name('aksi ubah password admin'); 
    

    // route untuk data dosen // ///
    Route::get('/data_dosen', [AdminController::class, 'datadosen'])->name('data dosen');

    Route::get('/data_dosen/trash', [AdminController::class, 'datadosensementara'])->name('data dosen sementara');
    
    Route::get('/edit_dosen/{id}', [AdminController::class, 'editdosen'])->name('edit dosen');

    Route::post('/update_dosen/{id}', [AdminController::class, 'updatedosen']);

    Route::get('/tambah_dosen', [AdminController::class, 'indexdosen']);

    Route::post('/tambah_dosen', [AdminController::class, 'tambahdosen']);

    Route::get('/hapus_dosen/{id}/konfirmasi', [AdminController::class, 'konfirmasidosen']);
    
    Route::get('/hapus_dosenpermanen/{id}/konfirmasi', [AdminController::class, 'konfirmasidosenpermanen']);

    Route::get('/hapus_dosenpermanen/konfirmasisemua', [AdminController::class, 'konfirmasidosenpermanensemua']);
    
    Route::get('/hapus_dosen/{id}/hapusdosen', [AdminController::class, 'hapusdosen']);
    
    Route::get('/hapus_dosen/{id}/hapusdosenpermanen', [AdminController::class, 'hapusdosenpermanen']);

    Route::get('/hapusdosenpermanensemua', [AdminController::class, 'hapusdosenpermanensemua']);
    
    Route::get('data_dosen/restore/{id}', [AdminController::class, 'restoredosen']);

    Route::get('data_dosen/restore_semua', [AdminController::class, 'restoredosensemua']);

    Route::post('/update_passworddosen/{id}', [AdminController::class, 'updatepassworddosen'])->name('aksi ubah password dosen'); 

    // route untuk data kadep //
    Route::get('/data_kadep', [AdminController::class, 'datakadep'])->name('data kadep'); 

    Route::get('/data_kadep/trash', [AdminController::class, 'datakadepsementara'])->name('data kadep sementara');

    Route::get('/edit_kadep/{id}', [AdminController::class, 'editkadep']);

    Route::post('/update_kadep/{id}', [AdminController::class, 'updatekadep']);

    Route::get('/tambah_kadep', [AdminController::class, 'indexkadep']);

    Route::get('/hapus_kadep/{id}/konfirmasi', [AdminController::class, 'konfirmasikadep']);

    Route::get('/hapus_kadeppermanen/{id}/konfirmasi', [AdminController::class, 'konfirmasikadeppermanen']);

    Route::get('/hapus_kadeppermanen/konfirmasisemua', [AdminController::class, 'konfirmasikadeppermanensemua']);
    
    Route::get('/hapus_kadep/{id}/hapuskadep', [AdminController::class, 'hapuskadep']);

    Route::get('/hapus_kadep/{id}/hapuskadeppermanen', [AdminController::class, 'hapuskadeppermanen']);

    Route::get('/hapus_kadep/hapuskadeppermanensemua', [AdminController::class, 'hapuskadeppermanensemua']);

    Route::get('data_kadep/restore/{id}', [AdminController::class, 'restorekadep']);

    Route::get('data_kadep/restore_semua', [AdminController::class, 'restorekadepsemua']);
    
    Route::post('/tambah_kadep', [AdminController::class, 'tambahkadep']);

    Route::post('/update_passwordkadep/{id}', [AdminController::class, 'updatepasswordkadep'])->name('aksi ubah password kadep'); 

    Route::post('/update_ttdkadep/{id}', [AdminController::class, 'updatettdkadep'])->name('aksi update ttd kadep'); 

    // route untuk data wakil dekan

    Route::get('/data_wakildekan', [AdminController::class, 'datawd1'])->name('data wakil dekan');

    Route::get('/data_wakildekan/trash', [AdminController::class, 'datawd1sementara'])->name('data wd sementara');

    Route::get('/tambah_wakildekan', [AdminController::class, 'indexwd1']);

    Route::post('/tambah_wakildekan', [AdminController::class, 'tambahwd1']);

    Route::get('/edit_wakildekan/{id}', [AdminController::class, 'editwd1']);

    Route::post('/update_wakildekan/{id}', [AdminController::class, 'updatewd1']);
    
    Route::get('/hapus_wakildekan/{id}/konfirmasi', [AdminController::class, 'konfirmasiwd1']);
    
    Route::get('/hapus_wakildekan/{id}/hapuswd1', [AdminController::class, 'hapuswd1']);

    Route::get('data_wakildekan/restore/{id}', [AdminController::class, 'restorewd1']);

    Route::get('/hapus_wakildekanpermanen/{id}/konfirmasi', [AdminController::class, 'konfirmasiwd1permanen']);

    Route::get('/hapus_wakildekan/{id}/hapuswakildekanpermanen', [AdminController::class, 'hapuswd1permanen']);

    Route::post('/update_passwordwd/{id}', [AdminController::class, 'updatepasswordwd1'])->name('aksi ubah password wakil dekan'); 

    Route::post('/update_ttdwd/{id}', [AdminController::class, 'updatettdwd1'])->name('aksi ubah ttd wakil dekan'); 
    
    // route untuk data petugas //
    
    Route::get('/data_petugas', [AdminController::class, 'datapetugas'])->name('data petugas');
    
    Route::get('/data_petugas/trash', [AdminController::class, 'datapetugassementara'])->name('data petugas sementara');
    
    Route::get('/tambah_petugas', [AdminController::class, 'indexpetugas']);

    Route::post('/tambah_petugas', [AdminController::class, 'tambahpetugas']);

    Route::get('/edit_petugas/{id}', [AdminController::class, 'editpetugas']);

    Route::post('/update_petugas/{id}', [AdminController::class, 'updatepetugas']);

    Route::get('/hapus_petugas/{id}/konfirmasi', [AdminController::class, 'konfirmasipetugas']);
    
    Route::get('/hapus_petugas/{id}/hapuspetugas', [AdminController::class, 'hapuspetugas']);

    Route::get('/hapus_petugaspermanen/{id}/konfirmasi', [AdminController::class, 'konfirmasipetugaspermanen']);

    Route::get('/hapus_petugas/{id}/hapuspetugaspermanen', [AdminController::class, 'hapuspetugaspermanen']);

    Route::get('data_petugas/restore/{id}', [AdminController::class, 'restorepetugas']);

    Route::post('/update_passwordpetugas/{id}', [AdminController::class, 'updatepasswordpetugas'])->name('aksi ubah password petugas'); 


    // route untuk data surat
    
    Route::get('/data_surat', [AdminController::class, 'datasurat'])->name('data surat');
    
    Route::get('/data_surat/trash', [AdminController::class, 'datasuratsementara'])->name('data surat sementara');

    //Route::get('/izinkankadep/{id}', [AdminController::class, 'izinkankadep'])->name('izinkankadep');
    
    Route::get('/confirmIzinkadep/{id}', [AdminController::class, 'confirmIzinkadep'])->name('confirmIzinkadep');
    
    //Route::post('/postizinkankadep/{id}', [AdminController::class, 'postizinkankadep'])->name('izinkankadepadmin');
    
    Route::post('/izinkankadepadmin/{id}', [AdminController::class, 'izinkanKadepadmin'])->name('izinkankadepadmin');
    
    Route::get('/confirmIzinwd/{id}', [AdminController::class, 'confirmIzinwd'])->name('confirmIzinwd');
    
    //Route::post('/postizinkankadep/{id}', [AdminController::class, 'postizinkankadep'])->name('izinkankadepadmin');
    
    Route::post('/izinkanwdadmin/{id}', [AdminController::class, 'izinkanwdadmin'])->name('izinkanwdadmin');

    Route::get('/izinkanwakildekan/{id}', [AdminController::class, 'izinkanwd'])->name('izinkanwd');
    
    //Route::post('/postizinkanwakildekan/{id}', [AdminController::class, 'postizinkanwd'])->name('postizinkanwd');

    Route::get('/hapus_surat/{id}/konfirmasiadmin', [AdminController::class, 'konfirmasisuratadmin']);
    
    Route::get('/hapus_surat/{id}/hapussuratadmin', [AdminController::class, 'hapussuratadmin']);
    
    Route::get('/hapus_suratpermanen/{id}/konfirmasi', [AdminController::class, 'konfirmasisuratadminpermanen']);
    
    Route::get('/hapus_suratpermanen/{id}/hapussuratadminpermanen', [AdminController::class, 'hapussuratpermanen']);

    Route::get('data_surat/restore/{id}', [AdminController::class, 'restoresurat']);


    
    


    // test test

    

    

    

    

    

    



    
});

/* Route dosen */
Route::group(['middleware' => ['auth:dosen']], function()
{
    // Route::get('dashboarddosen', function () {
    //     return view('/dosen/dashboarddosen');
    // });
    
    // Route::get('/profildosen', function () {
    //     return view('/dosen/profildosen');
    // });
    
    Route::get('/daftarsuratdosen', [DosenController::class, 'daftarsuratDosen']);

    Route::get('/notifDosen', [DosenController::class, 'notifDosen'])->name('notifDosen');

    Route::post('/clearNotif', [DosenController::class, 'clearNotif'])->name('clearNotif');

    Route::get('/cari', [DosenController::class, 'cari']);

    Route::get('/profildosen', [DosenController::class, 'profildosen']);

    Route::get('/dashboarddosen', [DosenController::class, 'dashboarddosen']);

    Route::post('/updateprofildosen/{id}', [DosenController::class, 'updateprofildosen']);

    Route::post('/editpassworddosen', [DosenController::class, 'editpassworddosen']);

    Route::get('/buatsurat', [SuratController::class, 'index']);

    Route::post('/tambahsurat', [SuratController::class, 'tambahsurat']);

    // Route::get('/hapussurat/{id}/konfirmasi', [SuratController::class, 'konfirmasi']);
    
    Route::get('/confirmHapus/{id}', [SuratController::class, 'confirmHapusDosen'])->name('confirmHapus');

    Route::post('/hapussurat/{id}', [SuratController::class, 'hapussurat'])->name('hapussurat');
    
    Route::get('/editsurat/{id}', [SuratController::class, 'editsurat'])->name('editsurat');
    
    Route::post('/updatesurat/{id}', [SuratController::class, 'updatesurat'])->name('updatesurat');
    
});
Route::get('/surat/{surat}', [SuratController::class, 'show']);

// Route::get('/suratpdf', [SuratController::class, 'show']);


// Route::get('/suratpdf', [SuratController::class, 'tampilpdf']);


/* Route kadep */
Route::group(['middleware' => ['auth:ketua_departemen']], function()
{
    

    // Route::get('/dashboardkadep', [KadepController::class, 'notifkadep']);

    /* Route::get('/daftarsuratkadep', function () {
        return view('/kadep/daftarsuratkadep');
    }); */

    /* Route::get('/profilkadep', function () {
        return view('/kadep/profilkadep');
    }); */
    Route::get('/notifKadep', [KadepController::class, 'notifKadep'])->name('notifKadep');

    Route::get('/profilkadep', [KadepController::class, 'profilKadep']);

    Route::get('/dashboardkadep', [KadepController::class, 'dashboardkadep']);

    // Route::get('/dashboardkadep', [KadepController::class, 'jumlahnotifkadep']);

    Route::get('/daftarsuratkadep', [KadepController::class, 'daftarsurat']);

    Route::post('/updateprofilkadep/{id}', [KadepController::class, 'updateprofilkadep']);

    Route::post('/editpasswordkadep', [KadepController::class, 'editpasswordkadep']);

    Route::post('/izinkankadep/{id}', [KadepController::class, 'izinkan'])->name('izinkankadep');

    Route::get('/confirmIzin/{id}', [KadepController::class, 'confirmIzin'])->name('confirmIzin');

    Route::get('/confirmTolak/{id}', [KadepController::class, 'confirmTolak'])->name('confirmTolak');

    Route::post('/kadeptolak/{id}', [KadepController::class, 'tolak'])->name('kadeptolak');

    Route::post('/uploadTTDkadep', [KadepController::class, 'tandatangan']);

});


/* Route petugas */
Route::group(['middleware' => ['auth:petugas_penomoran']], function()
{
    // Route::get('/dashboardpetugas', function () {
    //     return view('/petugas/dashboardpetugas');
    // });
        
    // Route::get('/profilpetugas', function () {
    //     return view('/petugas/profilpetugas');
    // });

    Route::get('/notifPetugas', [PetugasPenomoranController::class, 'notifPetugas'])->name('notifPetugas');
    
    Route::get('/dashboardpetugas', [PetugasPenomoranController::class, 'dashboardpetugas']);
    
    Route::get('/daftarsuratpetugas', [PetugasPenomoranController::class, 'daftarsuratpetugas'])->name('daftarsuratpetugas');
    
    // Route::get('/dropdown/{id}', [PetugasPenomoranController::class, 'dropdown'])->name('dropdown');
    
    Route::get('/profilpetugas', [PetugasPenomoranController::class, 'profilpetugas']);
    
    Route::post('/updateprofilpetugas/{id}', [PetugasPenomoranController::class, 'updateprofilpetugas']);

    Route::post('/editpasswordpetugas', [PetugasPenomoranController::class, 'editpasswordpetugas']);

    Route::post('/updatenomorsurat/{id}', [PetugasPenomoranController::class, 'updatenomorsurat'])->name('updatenomorsurat');

    Route::get('/editnomorsurat/{id}', [PetugasPenomoranController::class, 'editnomorsurat'])->name('editnomorsurat');
});


/* Route wakil dekan */
Route::group(['middleware' => ['auth:wakildekan']], function()
{
    
    // Route::get('/dashboardwd', function () {
    //     return view('/wd/dashboardwd');
    // });
    
    Route::get('/daftarsuratwd', function () {
        return view('/wd/daftarsuratwd');
    });
    
    // Route::get('/profilwd', function () {
    //     return view('/wd/profilwd');
    // });
    Route::get('/notifWD', [WakilDekanController::class, 'notifWD'])->name('notifWD');

    Route::get('/dashboardwd', [WakilDekanController::class, 'dashboardwd']);

    Route::get('/profilwd', [WakilDekanController::class, 'profilwd']);

    Route::get('/daftarsuratwd', [WakilDekanController::class, 'daftarsurat']);

    Route::post('/updateprofilwd/{id}', [WakilDekanController::class, 'updateprofilwd']);

    Route::post('/editpasswordwd', [WakilDekanController::class, 'editpasswordwd']);

    Route::post('/uploadTTD', [WakilDekanController::class, 'tandatangan']);

    Route::get('/confirmIzinWD/{id}', [KadepController::class, 'confirmIzin'])->name('confirmIzinWD');

    Route::post('/izinkan/{id}', [WakilDekanController::class, 'izinkan']);

    Route::get('/confirmTolakWD/{id}', [KadepController::class, 'confirmTolak'])->name('confirmTolakWD');

    Route::post('/tolakWD/{id}', [WakilDekanController::class, 'tolak'])->name('tolakWD');


});















// Route::view('/template',function(){
//     return view('template.v_app'[
//         "title" => ""
//     ]
// );

// Route::get('/data_admin',function(){
//     return view('dataadmin', [
//         "title" => "Data Admin"
//     ]);
// });

// Route::view('/data_dosen','datadosen');

// Route::view('/data_kadep','datakadep');

// Route::view('/data_petugas','datapetugas');

// Route::view('/data_surat','datasurat');

// Route::view('/edit_admin','editadmin');

// Route::view('/edit_dosen','editdosen');

// Route::view('/edit_kadep','editkadep');

// Route::view('/edit_petugas','editpetugas');

// Route::view('/tambah_dosen','tambahdosen');

// Route::view('/tambah_kadep','tambahkadep');

// Route::view('/tambah_petugas','tambahpetugas');
