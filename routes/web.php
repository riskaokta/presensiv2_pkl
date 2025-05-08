<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresensiController;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::post('/panel', [App\Http\Controllers\AuthController::class, 'proseslogoutadmin'])->name('logoutadmin');

Route::get('/dashboard', [DashboardController::class, 'index'])->name("dash");
Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

//Presensi
Route::get('/presensi/create', [PresensiController::class, 'create']);
Route::post('/presensi/store', [PresensiController::class, 'store']);

//Edit Profile
Route::get('/editprofile', [PresensiController::class, 'editprofile']);
Route::post('/presensi/{npm}/updateprofile', [PresensiController::class, 'updateprofile']);

//Histori
Route::get('/presensi/histori', [PresensiController::class, 'histori']);
Route::post('/gethistori', [PresensiController::class, 'gethistori']);

//Izin
Route::get('presensi/izin', [PresensiController::class, 'izin']);
Route::get('presensi/buatizin', [PresensiController::class, 'buatizin']);
Route::post('presensi/storeizin', [PresensiController::class, 'storeizin']);


//Dashbard Admin
Route::get('/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

//Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
Route::post('/mahasiswa/edit', [MahasiswaController::class, 'edit']);


//Presensi
Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);
Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);

//excel
Route::post('/mahasiswa/import', [MahasiswaController::class, 'importExcel'])->name('mahasiswa.import');

//search
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

Route::resource('mahasiswa', MahasiswaController::class);

Route::post('/mahasiswa/edit', [MahasiswaController::class, 'edit']);

