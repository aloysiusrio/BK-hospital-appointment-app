<?php

use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\Users\DokterController;
use App\Http\Controllers\Admin\Users\PasienController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dokter\PeriksaController;
use App\Http\Controllers\Dokter\RiwayatController;
use App\Http\Controllers\Dokter\JadwalDokterController;
use App\Http\Controllers\Pasien\PoliController as PasienPoliController;
use App\Http\Controllers\PasienController as ControllersPasienController;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
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
    return view('client.contents.index');
})->name('register.pasien.view');
Route::post('/', [ControllersPasienController::class, 'register'])->name('register.pasien');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('pasien')->middleware(['auth', 'pasien', 'active'])->name('pasien.')->group(function () {
        Route::resource('poli', PasienPoliController::class);
    });

    Route::prefix('admin')->middleware(['auth', 'admin', 'active'])->name('admin.')->group(function () {
        Route::resource('obat', ObatController::class);
        Route::resource('poli', PoliController::class);
        Route::prefix('users')->name('users.')->group(function () {
            Route::resource('dokter', DokterController::class);
            Route::resource('pasien', PasienController::class);
        });
    });

    Route::prefix('dokter')->middleware(['auth', 'dokter', 'active'])->name('dokter.')->group(function () {
        Route::resource('jadwal', JadwalDokterController::class);
        
        Route::get('jadwal/{id}/edit', [JadwalDokterController::class, 'edit'])->name('jadwal.edit');
        Route::put('jadwal/{id}', [JadwalDokterController::class, 'update'])->name('jadwal.update');
        Route::put('jadwal/{id}/toggle-active', [JadwalDokterController::class, 'toggleActive'])->name('jadwal.toggleActive');
        Route::delete('/jadwal/{id}', [JadwalDokterController::class, 'destroy'])->name('dashboard.dokter.jadwal.destroy');

        Route::get('profil/edit', [DokterController::class, 'editProfile'])->name('profil.edit');
        Route::post('profil/edit', [DokterController::class, 'updateProfile'])->name('profil.update');

        Route::get('periksa', [PeriksaController::class, 'index'])->name('periksa.index');
        Route::get('periksa/{id}', [PeriksaController::class, 'periksaForm'])->name('periksa.form');
        Route::post('periksa/{id}', [PeriksaController::class, 'periksa'])->name('periksa');
        Route::put('periksa/{id}/update', [PeriksaController::class, 'update'])->name('periksa.update');

        Route::get('riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
        Route::get('riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');
    });
});
