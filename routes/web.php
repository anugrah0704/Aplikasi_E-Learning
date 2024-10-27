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
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\GuruMapelController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\KoreksiEssayController;
use App\Http\Controllers\ManajemenPilihanGandaController;

Route::get('/', function () {
    return redirect()->route('login'); // Redirect to login page
});


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


// =====================================================================================================================================
// =====================================================================================================================================


   // Route untuk melihat profil siswa
    Route::get('/siswa/profile/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\SiswaController@profileSiswa', ['id' => $id]);
        }, 'siswa'); // Hanya siswa yang dapat mengakses route ini
    })->name('siswa.profil_siswa');

    // Route Profile Guru
    Route::get('/guru/profil/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\GuruController@profilGuru', ['id' => $id]);
        }, 'guru'); // Hanya guru yang dapat mengakses route ini
    })->name('guru.profil_guru');

    // Route Profile Admin
    Route::get('/admin/profile/{id}', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@profil', ['id' => request()->route('id')]);
        }, 'admin');
    })->name('admin.profil_admin');

// =====================================================================================================================================
// =====================================================================================================================================


    // CRUD untuk Siswa (Hanya admin yang bisa mengakses)
    Route::get('/admin/siswa/search', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@searchSiswa');
        }, 'admin');
    })->name('admin.siswa.search');

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

    // untuk import excel siswa
    Route::post('/admin/siswa/import', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@importSiswa');
        }, 'admin');
    })->name('admin.siswa.import'); // Route untuk meng-handle upload Excel

    // route untuk Download Excel siswa
    Route::get('/admin/siswa/download-template', function () {
        $filePath = public_path('templates/template_siswa.xlsx'); // pastikan file ada di folder public/templates
        return response()->download($filePath, 'template_siswa.xlsx');
    })->name('admin.siswa.downloadTemplateSiswa');

// =====================================================================================================================================
// =====================================================================================================================================

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
    })->name('admin.guru.storeGuru');

    Route::get('/admin/guru/edit/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@editGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.editGuru');

    Route::post('/admin/guru/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@updateGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.updateGuru');

    Route::delete('/admin/guru/delete/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\AdminController@deleteGuru', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru.deleteGuru');

    // untuk import excel guru
    Route::post('/admin/guru/import', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\AdminController@importguru');
        }, 'admin');
    })->name('admin.guru.import'); // Route untuk meng-handle upload Excel

    // route untuk Download Excel guru
    Route::get('/admin/guru/download-template', function () {
        $filePath = public_path('templates/template_guru.xlsx'); // pastikan file ada di folder public/templates
        return response()->download($filePath, 'template_guru.xlsx');
    })->name('admin.guru.downloadTemplateGuru');



// =====================================================================================================================================
// =====================================================================================================================================

    // Route untuk daftar mata pelajaran
    Route::get('/admin/mapel', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MapelController@index');
        }, 'admin');
    })->name('admin.mapel.index');

    // Route untuk form tambah mata pelajaran
    Route::get('/admin/mapel/create', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MapelController@create');
        }, 'admin');
    })->name('admin.mapel.create');

    // Route untuk menyimpan mata pelajaran baru
    Route::post('/admin/mapel/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MapelController@store');
        }, 'admin');
    })->name('admin.mapel.store');

    // Route untuk edit mata pelajaran
    Route::get('/admin/mapel/edit/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\MapelController@edit', ['id' => $id]);
        }, 'admin');
    })->name('admin.mapel.edit');

    // Route untuk update mata pelajaran
    Route::post('/admin/mapel/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\MapelController@update', ['id' => $id]);
        }, 'admin');
    })->name('admin.mapel.update');

    // Route untuk delete mata pelajaran
    Route::delete('/admin/mapel/delete/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\MapelController@destroy', ['id' => $id]);
        }, 'admin');
    })->name('admin.mapel.delete');


// =====================================================================================================================================
// =====================================================================================================================================


     // Route untuk daftar kelas (hanya admin yang bisa mengakses)
     Route::get('/admin/kelas', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\KelasController@index');
        }, 'admin');
    })->name('admin.kelas.index');

    // Route untuk form tambah kelas
    Route::get('/admin/kelas/create', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\KelasController@create');
        }, 'admin');
    })->name('admin.kelas.create');

    // Route untuk menyimpan kelas baru
    Route::post('/admin/kelas/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\KelasController@store');
        }, 'admin');
    })->name('admin.kelas.store');

    // Route untuk form edit kelas
    Route::get('/admin/kelas/edit/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\KelasController@edit', ['id' => $id]);
        }, 'admin');
    })->name('admin.kelas.edit');

    // Route untuk update kelas
    Route::post('/admin/kelas/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\KelasController@update', ['id' => $id]);
        }, 'admin');
    })->name('admin.kelas.update');

    // Route untuk menghapus kelas
    Route::delete('/admin/kelas/delete/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\KelasController@destroy', ['id' => $id]);
        }, 'admin');
    })->name('admin.kelas.destroy');


// =====================================================================================================================================
// =====================================================================================================================================

    // Route untuk daftar Guru dengan Mata Pelajaran
    Route::get('/admin/guru-mapel', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\GuruMapelController@index');
        }, 'admin');
    })->name('admin.guru-mapel.index');

    // Route untuk form tambah Guru ke Mata Pelajaran
    Route::get('/admin/guru-mapel/create', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\GuruMapelController@create');
        }, 'admin');
    })->name('admin.guru-mapel.create');

    // Route untuk menyimpan Guru ke Mata Pelajaran baru
    Route::post('/admin/guru-mapel/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\GuruMapelController@store');
        }, 'admin');
    })->name('admin.guru-mapel.store');


    // Route untuk update Guru ke Mata Pelajaran
    Route::post('/admin/guru-mapel/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\GuruMapelController@update', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru-mapel.update');

    // Route untuk delete Guru ke Mata Pelajaran
    Route::delete('/admin/guru-mapel/destroy/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\GuruMapelController@destroy', ['id' => $id]);
        }, 'admin');
    })->name('admin.guru-mapel.destroy');


// =====================================================================================================================================
// ======================      Route untuk materi guru        ======================================================
// =====================================================================================================================================


    // Route untuk materi guru
    Route::get('/guru/materi', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MateriController@index');
        }, 'guru');
    })->name('guru.materi.index');

    // Route untuk menyimpan materi baru
    Route::post('/guru/materi/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MateriController@store');
        }, 'guru');
    })->name('guru.materi.store');

    // Route untuk menampilkan daftar materi bagi siswa
    Route::get('/siswa/materi', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\MateriController@indexSiswa');
        }, 'siswa');  // Sesuaikan dengan peran siswa
    })->name('siswa.materi.index');


        // Route untuk menampilkan materi bagi siswa berdasarkan ID
    Route::get('/siswa/materi/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\MateriController@detailMateri', ['id' => $id]);
        }, 'siswa');  // Sesuaikan dengan peran siswa
    })->name('siswa.materi.detail');


// =====================================================================================================================================
// ======================      Route untuk Manajemen Ujian / Tugas  HAL GURU        ======================================================
// =====================================================================================================================================


    // Route untuk Manajemen ujian
    Route::get('/guru/manajemen_ujian', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\ManajemenTugasController@index');
        }, 'guru');
    })->name('guru.manajemen-ujian.index');

    // Route untuk Manajemen ujian menggunakan POST
    Route::post('/guru/manajemen_ujian/store', function () {
        return (new RoleMiddleware)->handle(request(), function () {
            return app()->call('App\Http\Controllers\ManajemenTugasController@store');
        }, 'guru');
    })->name('guru.manajemen-ujian.store');

    // Route untuk Manajemen ujian
    Route::get('/guru/manajemen_ujian/detail/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\ManajemenTugasController@show', ['id' => $id]);
        }, 'guru');  // Sesuaikan dengan peran siswa
    })->name('guru.manajemen-ujian.detailsoal');

    Route::post('/guru/manajemen_ujian/update/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\ManajemenTugasController@update', ['id' => $id]);
        }, 'guru');  // Sesuaikan dengan peran siswa
    })->name('guru.manajemen-ujian.update');

    Route::delete('/guru/manajemen_ujian/destroy/{id}', function ($id) {
        return (new RoleMiddleware)->handle(request(), function () use ($id) {
            return app()->call('App\Http\Controllers\ManajemenTugasController@destroy', ['id' => $id]);
        }, 'guru');
    })->name('guru.manajemen-ujian.destroy');

// =====================================================================================================================================
// ======================      Route untuk Manajemen Ujian / Tugas  Essay dan pilihan ganda        ======================================================
// =====================================================================================================================================



});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/siswa/ujian', [UjianController::class, 'index'])->name('siswa.ujian.index');
    Route::get('/siswa/ujian/{id}', [UjianController::class, 'view'])->name('siswa.ujian.view');
    Route::get('/siswa/ujian/kerjakan/{ujian_id}', [UjianController::class, 'kerjakan'])->name('siswa.ujian.kerjakan');

    Route::get('/siswa/ujian/{id}/pilgan', [UjianController::class, 'mulaiPilgan'])->name('siswa.ujian.mulai.pilgan');
    Route::post('/siswa/ujian/{id}/pilgan/submit', [UjianController::class, 'submitPilgan'])->name('siswa.ujian.submit.pilgan');
    Route::get('/siswa/ujian/{id}/nilai/pilgan', [UjianController::class, 'hasilUjian'])->name('siswa.ujian.nilai.pilgan');

    Route::get('/siswa/ujian/{id}/essay', [UjianController::class, 'mulaiEssay'])->name('siswa.ujian.mulai.essay');
    Route::get('/ujian/essay/{id}', [UjianController::class, 'tampilEssay'])->name('siswa.ujian.mulai.essay');
    Route::post('/ujian/essay/{id}', [UjianController::class, 'submitEssay'])->name('siswa.ujian.submitEssay');
    Route::get('/ujian/nilai-essay/{id}', [UjianController::class, 'nilaiEssay'])->name('siswa.ujian.nilai.essay');


});

// =====================================================================================================================================
// ======================      Route untuk Manajemen Ujian / Tugas  HAL GURU        ====================================================
// ======================                   Route untuk Login Guru        ======================================================
// =====================================================================================================================================


//==============================    Route Guru ==========================================================
Route::group(['middleware' => ['auth']], function () {

    // Route untuk menampilkan soal pilihan ganda
    Route::get('/guru/manajemen_ujian/pilihan-ganda/{ujian_id}', [ManajemenPilihanGandaController::class, 'index'])->name('guru.manajemen-ujian.pilihan-ganda');

    // Route untuk menyimpan soal pilihan ganda
    Route::post('/guru/manajemen_ujian/pilihan-ganda/{ujian_id}', [ManajemenPilihanGandaController::class, 'storePilgan'])->name('guru.manajemen-ujian.pilihan-ganda.storePilgan');

    // Route untuk mengupdate soal pilihan ganda
    Route::put('/guru/manajemen_ujian/pilihan-ganda/{ujian_id}/{id}', [ManajemenPilihanGandaController::class, 'update'])->name('guru.manajemen-ujian.pilihan-ganda.update');

    // Route untuk menghapus soal pilihan ganda
    Route::delete('/guru/manajemen_ujian/pilihan-ganda/{ujian_id}/{id}', [ManajemenPilihanGandaController::class, 'destroy'])->name('guru.manajemen-ujian.pilihan-ganda.destroy');

    Route::get('/guru/manajemen-ujian/essay/{ujian_id}', [EssayController::class, 'index'])->name('guru.manajemen-ujian.essay');
    Route::post('/guru/manajemen-ujian/essay/{ujian_id}', [EssayController::class, 'store'])->name('guru.manajemen-ujian.essay.store');
    Route::put('/guru/manajemen-ujian/essay/{ujian_id}/{id}', [EssayController::class, 'update'])->name('guru.manajemen-ujian.essay.update');
    Route::delete('/guru/manajemen-ujian/essay/{ujian_id}/{id}', [EssayController::class, 'destroy'])->name('guru.manajemen-ujian.essay.destroy');

    // Route untuk daftar siswa yang ikut ujian
    Route::get('/guru/manajemen-ujian/koreksi/{ujian_id}/daftar-siswa', [UjianController::class, 'daftarSiswa'])->name('guru.manajemen-ujian.koreksi.daftar-siswa');

    // Route untuk analisa pilihan ganda
    Route::get('/guru/manajemen-ujian/koreksi/{ujian_id}/pg/{siswa_id}', [UjianController::class, 'analisaPilihanGanda'])->name('guru.manajemen-ujian.koreksi.analisa_pg');

    // Route untuk koreksi essay
    Route::get('/guru/koreksi/{ujian_id}/{siswa_id}', [KoreksiEssayController::class, 'showKoreksi'])->name('guru.manajemen-ujian.koreksi.koreksi_essay');
    Route::post('/guru/manajemen-ujian/koreksi/nilai/{jawaban_id}', [KoreksiEssayController::class, 'KoreksiNilai'])->name('guru.manajemen-ujian.koreksi.koreksiNilai');






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
