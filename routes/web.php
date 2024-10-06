<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;

Route::resource('courses', CourseController::class);

// Dashboard routes for admin, guru, and siswa
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/index', [GuruController::class, 'index'])->name('guru.index');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/bhsINDO', [PelajaranController::class, 'indo'])->name('siswa.bhs_indo');
Route::get('/bhsINGGRIS', [PelajaranController::class, 'inggris'])->name('siswa.bhs_inggris');
Route::get('/bhsJAWA', [PelajaranController::class, 'jawa'])->name('siswa.bhs_jawa');
Route::get('/INFORMATIKA', [PelajaranController::class, 'informatika'])->name('siswa.informatika');
Route::get('/BK', [PelajaranController::class, 'bk'])->name('siswa.bk');
Route::get('/MATEMATIKA', [PelajaranController::class, 'mtk'])->name('siswa.mtk');
Route::get('/IPA', [PelajaranController::class, 'ipa'])->name('siswa.ipa');
Route::get('/IPS', [PelajaranController::class, 'ips'])->name('siswa.ips');
Route::get('/AGAMA', [PelajaranController::class, 'agama'])->name('siswa.pai');
Route::get('/PJOK', [PelajaranController::class, 'pjok'])->name('siswa.pjok');
Route::get('/SENI BUDAYA', [PelajaranController::class, 'seni'])->name('siswa.seni');
Route::get('/PPKN', [PelajaranController::class, 'ppkn'])->name('siswa.ppkn');
Route::get('/User Profil', [PelajaranController::class, 'profil'])->name('siswa.profil_siswa');
Route::get('/Jadwal', [PelajaranController::class, 'jadwal'])->name('siswa.jadwal');


Route::get('/guru/index', [GuruController::class, 'index'])->name('guru.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
