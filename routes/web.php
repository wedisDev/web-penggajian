<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
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

        //Route Cabang
        Route::resource('/cabang', CabangController::class);
        Route::get('/cabang/delete/{id}', [CabangController::class, 'destroy']);
    }
);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
