<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KadepController;
use App\Http\Controllers\WakilDekanController;
use App\Http\Controllers\PetugasController;
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
    Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard admin');

    Route::get('/data_admin', [AdminController::class, 'dataadmin'])->name('data admin');
    
    Route::get('/edit_admin/{id}', [AdminController::class, 'editadmin'])->name('edit data admin');
    
    Route::post('/update_admin/{id}', [AdminController::class, 'updateadmin'])->name('update data admin'); 
    
    Route::post('/update_password/{id}', [AdminController::class, 'updatepassword'])->name('aksi ubah password admin'); 
    

    // route untuk data dosen // ///
    Route::get('/data_dosen', [DosenController::class, 'datadosen']);
    
    Route::get('/edit_dosen/{id}', [DosenController::class, 'editdosen']);

    Route::post('/update_dosen/{id}', [DosenController::class, 'updatedosen']);

    Route::get('/tambah_dosen', [DosenController::class, 'index']);

    Route::post('/tambah_dosen', [DosenController::class, 'tambahdosen']);

    Route::get('/hapus_dosen/{id}/konfirmasi', [DosenController::class, 'konfirmasi']);
    
    Route::get('/hapus_dosen/{id}/hapusdosen', [DosenController::class, 'hapusdosen']);

    // route untuk data kadep //
    Route::get('/data_kadep', [KadepController::class, 'datakadep']);

    Route::get('/edit_kadep/{id}', [KadepController::class, 'editkadep']);

    Route::post('/update_kadep/{id}', [KadepController::class, 'updatekadep']);

    Route::get('/tambah_kadep', [KadepController::class, 'index']);

    Route::get('/hapus_kadep/{id}/konfirmasi', [KadepController::class, 'konfirmasi']);
    
    Route::get('/hapus_kadep/{id}/hapuskadep', [KadepController::class, 'hapuskadep']);
    
    Route::post('/tambah_kadep', [KadepController::class, 'tambahkadep']);

    // route untuk data wakil dekan

    Route::get('/data_wakildekan', [WakilDekanController::class, 'datawd1']);

    Route::get('/tambah_wakildekan', [WakilDekanController::class, 'index']);

    Route::post('/tambah_wakildekan', [WakilDekanController::class, 'tambahwd1']);

    Route::get('/edit_wakildekan/{id}', [WakilDekanController::class, 'editwd1']);

    Route::post('/update_wakildekan/{id}', [WakilDekanController::class, 'updatewd1']);
    
    Route::get('/hapus_wakildekan/{id}/konfirmasi', [WakilDekanController::class, 'konfirmasi']);
    
    Route::get('/hapus_wakildekan/{id}/hapuswd1', [WakilDekanController::class, 'hapuswd1']);
    
    // route untuk data petugas //
    
    Route::get('/data_petugas', [PetugasController::class, 'datapetugas']);

    Route::get('/tambah_petugas', [PetugasController::class, 'index']);

    Route::post('/tambah_petugas', [PetugasController::class, 'tambahpetugas']);

    Route::get('/edit_petugas/{id}', [PetugasController::class, 'editpetugas']);

    Route::post('/update_petugas/{id}', [petugasController::class, 'updatepetugas']);

    Route::get('/hapus_petugas/{id}/konfirmasi', [petugasController::class, 'konfirmasi']);
    
    Route::get('/hapus_petugas/{id}/hapuspetugas', [petugasController::class, 'hapuspetugas']);


    // route untuk data surat
    
    Route::get('/data_surat', [SuratController::class, 'datasurat']);

    Route::get('/hapus_surat/{id}/konfirmasiadmin', [SuratController::class, 'konfirmasiadmin']);
    
    Route::get('/hapus_surat/{id}/hapussuratadmin', [SuratController::class, 'hapussuratadmin']);
    
    


    // test test

    

    

    

    

    

    



    
});

/* Route dosen */
Route::group(['middleware' => ['auth:dosen']], function()
{
    Route::get('dashboarddosen', function () {
        return view('/dosen/dashboarddosen');
    });

    Route::get('/profildosen', function () {
        return view('/dosen/profildosen');
    });
    
    Route::get('/daftarsuratdosen', [DosenController::class, 'daftarsurat']);

    Route::get('/buatsurat', [SuratController::class, 'index']);

    Route::post('/tambahsurat', [SuratController::class, 'tambahsurat']);

    Route::get('/hapussurat/{id}/konfirmasi', [SuratController::class, 'konfirmasi']);
    
    Route::get('/hapussurat/{id}/hapussurat', [SuratController::class, 'hapussurat']);
    
    Route::get('/editsurat/{id}', [SuratController::class, 'editsurat']);
    
    Route::post('/updatesurat/{id}', [SuratController::class, 'updatesurat']);
    
});
Route::get('/surat/{surat}', [SuratController::class, 'show']);

// Route::get('/suratpdf', [SuratController::class, 'show']);


// Route::get('/suratpdf', [SuratController::class, 'tampilpdf']);


/* Route kadep */
Route::group(['middleware' => ['auth:ketua_departemen']], function()
{
    Route::get('/dashboardkadep', function () {
        return view('/kadep/dashboardkadep');
    });

    Route::get('/daftarsuratkadep', function () {
        return view('/kadep/daftarsuratkadep');
    });

    Route::get('/profilkadep', function () {
        return view('/kadep/profilkadep');
    });

    Route::get('/daftarsuratkadep', [KadepController::class, 'daftarsurat']);

    Route::get('/izinkan/{id}', [KadepController::class, 'izinkan']);

});


/* Route petugas */
Route::group(['middleware' => ['auth:petugas_penomoran']], function()
{
    Route::get('/dashboardpetugas', function () {
        return view('/petugas/dashboardpetugas');
    });

    Route::get('/daftarsuratpetugas', function () {
        return view('/petugas/daftarsuratpetugas');
    });
        
    Route::get('/profilpetugas', function () {
        return view('/petugas/profilpetugas');
    });
});


/* Route wakil dekan */
Route::group(['middleware' => ['auth:wakildekan']], function()
{
    
    Route::get('/dashboardwd', function () {
        return view('/wd/dashboardwd');
    });
    
    Route::get('/daftarsuratwd', function () {
        return view('/wd/daftarsuratwd');
    });
    
    Route::get('/profilwd', function () {
        return view('/wd/profilwd');
    });

    Route::get('/daftarsuratwd', [WakilDekanController::class, 'daftarsurat']);

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
