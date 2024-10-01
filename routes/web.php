<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BerandaController::class, 'index'])->name('siswa.index');
Route::get('/bhsINDO', [BerandaController::class, 'indo'])->name('siswa.bhs_indo');
