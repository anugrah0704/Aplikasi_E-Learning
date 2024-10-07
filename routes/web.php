<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\RoleMiddleware;

Route::middleware(['auth'])->group(function () {
    // Route Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@index');
        }, 'admin');
    })->name('admin.dashboard');

    // Route Dashboard Guru
    Route::get('/guru/index', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\GuruController@index');
        }, 'guru');
    })->name('guru.index');

    // Route Dashboard Siswa
    Route::get('/siswa/index', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\SiswaController@index');
        }, 'siswa');
    })->name('siswa.index');



    // CRUD untuk Siswa (Hanya admin yang bisa mengakses)
    Route::get('/admin/siswa', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@listSiswa');
        }, 'admin');
    })->name('admin.siswa.index');

    Route::get('/admin/siswa/create', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@createSiswa');
        }, 'admin');
    })->name('admin.siswa.create');

    Route::post('/admin/siswa/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@storeSiswa');
        }, 'admin');
    })->name('admin.siswa.store');

    Route::get('/admin/siswa/edit/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@editSiswa', ['id' => $id]);
        }, 'admin');
    })->name('admin.siswa.editSiswa');

    Route::post('/admin/siswa/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@updateSiswa', ['id' => $id]);
        }, 'admin');
    })->name('admin.siswa.updateSiswa');

    Route::delete('/admin/siswa/delete/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@deleteSiswa', ['id' => $id]);
        }, 'admin');
    })->name('admin.siswa.deleteSiswa');



    // CRUD untuk Guru (Hanya admin yang bisa mengakses)
    Route::get('/admin/guru', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@listGuru');
        }, 'admin');
    })->name('admin.guru.index');

    Route::get('/admin/guru/create', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@createGuru');
        }, 'admin');
    })->name('admin.guru.create');

    Route::post('/admin/guru/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@storeGuru');
        }, 'admin');
    })->name('admin.guru.store');

    Route::get('/admin/guru/edit/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@editGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.edit');

    Route::post('/admin/guru/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@updateGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.update');

    Route::delete('/admin/guru/delete/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@deleteGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.delete');
});

// Routes untuk Mata Pelajaran
Route::resource('courses', CourseController::class);

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Dashboard routes for admin, guru, and siswa
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

//     Route::get('/guru/index', [GuruController::class, 'index'])->name('guru.index');
//     // Route untuk form tambah guru
//     Route::get('/admin/guru/create', [AdminController::class, 'createGuru'])->name('admin.guru.create');
//     Route::post('/admin/guru/store', [AdminController::class, 'storeGuru'])->name('admin.guru.store');

//     Route::get('/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
//     // Route untuk form tambah siswa
//     Route::get('/admin/siswa/create', [AdminController::class, 'createSiswa'])->name('admin.siswa.create');
//     Route::post('/admin/siswa/store', [AdminController::class, 'storeSiswa'])->name('admin.siswa.store');
// });


// Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// Route::get('/guru/index', [GuruController::class, 'index'])->name('guru.index');
// Route::get('/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');

// Route::get('/', function () {
//     return view('welcome');
// });


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




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
