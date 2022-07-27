<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BonusOmzetController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(
    [
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/ubah-password/{id}', [DashboardController::class, 'changePassword']);
        Route::post('/ubah-password-store/{id}', [DashboardController::class, 'storePassword']);
        Route::post('/year-filter', [DashboardController::class, 'chartByYear']);

        //Route Golongan
        Route::resource('/golongan', GolonganController::class);
        Route::get('/golongan/delete/{id}', [GolonganController::class, 'destroy']);

        //Route jabatan
        Route::resource('/jabatan', JabatanController::class);
        Route::get('/jabatan/delete/{id}', [JabatanController::class, 'destroy']);

        //Route Pegawai
        Route::resource('/pegawai', PegawaiController::class);
        Route::get('/pegawai/delete/{id}', [PegawaiController::class, 'destroy']);
        Route::get('/pegwai/rincian-gaji', [PegawaiController::class, 'rincian']);
        Route::get('/gaji-pegawai',  [PegawaiController::class, 'gaji']);
        Route::get('/filter-gaji-cabang/{id}', [PegawaiController::class, 'filterGajiCabang']);
        Route::get('/slip-gaji/{id}',  [PegawaiController::class, 'slipGaji']);

        //Route Cabang
        Route::resource('/cabang', CabangController::class);
        Route::get('/cabang/delete/{id}', [CabangController::class, 'destroy']);

        //Route Bonus Omzet
        Route::resource('/bonus-omzet', BonusOmzetController::class);
        Route::get('/bonus-omzet/delete/{id}', [BonusOmzetController::class, 'destroy']);

        //Route Transaksi
        Route::resource('/transaksi', PerhitunganController::class);
        Route::get('/tambah-transaksi/{id}', [PerhitunganController::class, 'create']);
        Route::get('/transaksi/delete/{id}', [PerhitunganController::class, 'destroy']);
        Route::get('/data-transaksi', [PerhitunganController::class, 'dataTransaksi']);
        Route::get('/hitung-omzet/{id}', [PerhitunganController::class, 'hitungOmzet']);
        Route::get('/pilih-cabang', [PerhitunganController::class, 'pilihCabang']);
        Route::get('/transaksi/delete/{id}', [PerhitunganController::class, 'destroy']);
        Route::get('/filter-cabang-transaksi/{id}', [PerhitunganController::class, 'filterCabangTransaksi']);
    }
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
