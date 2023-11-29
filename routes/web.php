<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemancinganController;
use App\Http\Controllers\PemancingController;

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

Route::any('/', [LoginController::class, 'login'])->name('login');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
Route::any('/register', [LoginController::class, 'register'])->name('register');
Route::any('/register_pihak', [LoginController::class, 'registerPihak'])->name('register_pihak');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/proses_register', [LoginController::class, 'prosesRegister'])->name('prosesRegister');
Route::any('/proses_register_pihak', [LoginController::class, 'prosesRegisterPihak'])->name('prosesRegisterPihak');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.index');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::any('/data_pemancing', [AdminController::class, 'dataPemancing'])->name('admin.dataPemancing');
        Route::any('/add_pemancing', [AdminController::class, 'addPemancing'])->name('admin.addPemancing');
        Route::any('/update_pemancing', [AdminController::class, 'updatePemancing'])->name('admin.updatePemancing');
        Route::any('/delete_pemancing/{id}', [AdminController::class, 'deletePemancing'])->name('admin.deletePemancing');
        Route::any('/data_pemilik', [AdminController::class, 'dataPemilik'])->name('admin.dataPemilik');
        Route::any('/add_pemilik', [AdminController::class, 'addPemilik'])->name('admin.addPemilik');
        Route::any('/update_pemilik', [AdminController::class, 'updatePemilik'])->name('admin.updatePemilik');
        Route::any('/delete_pemilik/{id}', [AdminController::class, 'deletePemilik'])->name('admin.deletePemilik');
        Route::any('/data_pemancingan', [AdminController::class, 'dataPemancingan'])->name('admin.dataPemancingan');
        Route::any('/setuju/{id}', [AdminController::class, 'setuju'])->name('admin.setuju');
        Route::any('/tolak/{id}', [AdminController::class, 'tolak'])->name('admin.tolak');
        Route::any('/delete_pemancingan/{id}', [AdminController::class, 'deletePemancingan'])->name('admin.deletePemancingan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('pemancing')->middleware(['pemancing'])->group(function () {
        Route::any('/home', [PemancingController::class, 'index'])->name('pemancing.index');
        Route::any('/about', [PemancingController::class, 'about'])->name('pemancing.about');
        Route::any('/add_rating', [PemancingController::class, 'addRating'])->name('pemancing.addRating');
        Route::any('/search', [PemancingController::class, 'search'])->name('pemancing.search');
        Route::any('/detail/{id}', [PemancingController::class, 'detail'])->name('pemancing.detail');
        Route::any('/pemancingan', [PemancingController::class, 'pemancingan'])->name('pemancing.pemancingan');
        Route::any('/pemancing_profile', [PemancingController::class, 'profile'])->name('pemancing.profile');
        Route::any('/update_profile', [PemancingController::class, 'updateProfile'])->name('pemancing.updateProfile');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('pemancingan')->middleware(['pemancingan'])->group(function () {
        Route::any('/home', [PemancinganController::class, 'index'])->name('pemancingan.index');
        Route::any('/pemancingan_profile', [PemancinganController::class, 'profile'])->name('pemancingan.profile');
        Route::any('/update_profile', [PemancinganController::class, 'updateProfile'])->name('pemancingan.updateProfile');
        Route::any('/data_pemancingan', [PemancinganController::class, 'dataPemancingan'])->name('pemancingan.dataPemancingan');
        Route::any('/data_jadwal', [PemancinganController::class, 'dataJadwal'])->name('pemancingan.dataJadwal');
        Route::any('/add_pemancingan', [PemancinganController::class, 'addPemancingan'])->name('pemancingan.addPemancingan');
        Route::any('/update_pemancingan', [PemancinganController::class, 'updatePemancingan'])->name('pemancingan.updatePemancingan');
        Route::any('/delete_pemancingan/{id}', [PemancinganController::class, 'deletePemancingan'])->name('pemancingan.deletePemancingan');
        Route::any('/add_jadwal', [PemancinganController::class, 'addJadwal'])->name('pemancingan.addJadwal');
        Route::any('/update_jadwal', [PemancinganController::class, 'updateJadwal'])->name('pemancingan.updateJadwal');
        Route::any('/delete_jadwal/{id}', [PemancinganController::class, 'deleteJadwal'])->name('pemancingan.deleteJadwal');
    });
});
