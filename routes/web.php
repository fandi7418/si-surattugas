<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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
use App\Http\Controllers\DashboardadminController;

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

// Route::get('/', function () {
//     return view('login', [
//         "title" => "Halaman Login"
//     ]);
// });

// Route::get('/', function () {
//     return view('login');
// });

//cara singkat
// Route::view('/','v_login'); 
Route::get('/', [LoginController::class, 'index']);

Route::get('/dashboard_admin', [DashboardadminController::class, 'index']);

Route::get('/data_admin', [DataadminController::class, 'index']);

Route::get('/data_dosen', [DatadosenController::class, 'index']);

Route::get('/data_kadep', [DatakadepController::class, 'index']);

Route::get('/data_petugas', [DatapetugasController::class, 'index']);

Route::get('/data_surat', [DatasuratController::class, 'index']);

Route::get('/edit_admin', [EditadminController::class, 'index']);

Route::get('/edit_dosen', [EditdosenController::class, 'index']);

Route::get('/edit_kadep', [EditkadepController::class, 'index']);

Route::get('/edit_petugas', [EditpetugasController::class, 'index']);

Route::get('/tambah_dosen', [TambahdosenController::class, 'index']);

Route::get('/tambah_kadep', [TambahkadepController::class, 'index']);

Route::get('/tambah_petugas', [TambahpetugasController::class, 'index']);




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
