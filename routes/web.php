<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\GuruController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index'])->name('siswa.index');
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


Route::get('/index', [GuruController::class, 'index'])->name('guru.index');
