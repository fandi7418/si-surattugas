<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KadepController;
use App\Http\Controllers\DataadminController;
use App\Http\Controllers\DatadosenController;
use App\Http\Controllers\DatakadepController;
use App\Http\Controllers\DatasuratController;
use App\Http\Controllers\EditadminController;
use App\Http\Controllers\EditdosenController;
use App\Http\Controllers\EditkadepController;
use App\Http\Controllers\DatapetugasController;
use App\Http\Controllers\EditpetugasController;
use App\Http\Controllers\TambahdosenController;
use App\Http\Controllers\TambahkadepController;
use App\Http\Controllers\TambahpetugasController;
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
    Route::get('/dashboard_admin', [AdminController::class, 'index']);

    Route::get('/data_admin', [AdminController::class, 'dataadmin']);
    
    Route::get('/edit_admin/{$id}', [AdminController::class, 'editadmin']);

    Route::post('/update_admin/{$id}', [AdminController::class, 'updateadmin']); 

    // route untuk data dosen //
    Route::get('/data_dosen', [DosenController::class, 'datadosen']);
    
    Route::get('/edit_dosen', [DosenController::class, 'editdosen']);

    Route::get('/tambah_dosen', [DosenController::class, 'index']);

    Route::post('/tambah_dosen', [DosenController::class, 'tambahdosen']);

    Route::get('/hapus_dosen/{$id}', [DosenController::class, 'hapusdosen']);

    // route untuk data kadep //
    Route::get('/data_kadep', [KadepController::class, 'datakadep']);

    Route::get('/edit_kadep', [EditkadepController::class, 'index']);

    Route::get('/tambah_kadep', [KadepController::class, 'index']);

    Route::get('/hapus_kadep/{$id}', [KadepController::class, 'hapuskadep']);

    Route::post('/tambah_kadep', [KadepController::class, 'tambahkadep']);

    // route untuk data wakil dekan



    // route untuk data petugas //

    Route::get('/data_petugas', [DatapetugasController::class, 'index']);

    Route::get('/edit_petugas', [EditpetugasController::class, 'index']);

    Route::get('/tambah_petugas', [TambahpetugasController::class, 'index']);

    // route untuk data surat
    
    Route::get('/data_surat', [DatasuratController::class, 'index']);
    
    
    

    // Route::get('/edit_admin', [EditadminController::class, 'edit'])->name('admin.editadmin');
    

    

    

    

    

    

    



    
});

/* Route dosen */
Route::group(['middleware' => ['auth:dosen']], function()
{
    Route::get('dashboarddosen', function () {
        return view('/dosen/dashboarddosen');
    });

    Route::get('/daftarsuratdosen', [DosenController::class, 'daftarsurat']);

    Route::get('/profildosen', function () {
        return view('/dosen/profildosen');
    });


    // Route::get('/buatsurat', function () {
    //     return view('/dosen/buatsurat');
    // });
    
    Route::get('/buatsurat', [SuratController::class, 'index']);
    Route::post('/tambahsurat', [SuratController::class, 'tambahsurat']);
    Route::get('/hapussurat/{id}', [SuratController::class, 'hapussurat']);
    Route::get('/editsurat/{id}', [SuratController::class, 'editsurat']);
    Route::post('/updatesurat/{id}', [SuratController::class, 'updatesurat']);

    Route::get('/surat/{surat}', [SuratController::class, 'show']);

});
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
