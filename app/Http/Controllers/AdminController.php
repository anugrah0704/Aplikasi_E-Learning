<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Course;
use App\Models\Siswa; // pastikan Anda telah membuat model Siswa
use App\Models\Guru; // pastikan Anda telah membuat model Guru
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function profil($id)
{
    // Cek apakah user yang login adalah admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        // Mengambil data user berdasarkan id
        $admin = User::find($id); // Ganti dengan model User sesuai dengan tabel Anda

        // Cek apakah user ditemukan
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan');
        }

        // Tampilkan halaman profil admin
        return view('admin.profil_admin', compact('admin'));
    }

    // Jika user bukan admin, redirect atau tampilkan pesan error
    return redirect('/home')->with('error', 'Akses ditolak, Anda bukan admin.');
}








    public function index()
    {
        // Kamu bisa mengambil data dari database dan mengirimkannya ke view jika diperlukan
        // Misalnya mengambil jumlah siswa, guru, dll.
        // Contoh data untuk ditampilkan di dashboard
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalMataPelajaran = Course::count();

    return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalMataPelajaran'));
    }

// ==================================================================================================================
// ==================================================================================================================


    // Metode untuk mengunduh template Excel
    public function downloadTemplateSiswa()
    {
        // Path ke file template
        $filePath = public_path('templates/template_siswa.xlsx');

        // Pastikan file ada
        if (file_exists($filePath)) {
            // Mengunduh file
            return response()->download($filePath, 'template_siswa.xlsx');
        } else {
            // Tampilkan pesan jika file tidak ditemukan
            return redirect()->back()->with('error', 'Template file not found!');
        }
    }

    public function downloadTemplateGuru()
    {
        // Path ke file template
        $filePath = public_path('templates/template_guru.xlsx');

        // Pastikan file ada
        if (file_exists($filePath)) {
            // Mengunduh file
            return response()->download($filePath, 'template_guru.xlsx');
        } else {
            // Tampilkan pesan jika file tidak ditemukan
            return redirect()->back()->with('error', 'Template file not found!');
        }
    }

// ==================================================================================================================


    // fitur untuk mengimport file excel agar data otomatis terisi
    public function importSiswa(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Proses import
        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diimport!');
    }

    public function importGuru(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Proses import
        Excel::import(new GuruImport, $request->file('file'));

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diimport!');
    }

// =====================================================================================================================
// =================================================================================================================


    // Tampilkan daftar siswa
    public function listSiswa()
    {
        $kelas = Kelas::all(); // Mengambil semua kelas
        $users = User::has('siswa')->where('role', 'siswa')->get();

        return view('admin.siswa.index', compact('users','kelas'));
    }

    // Form tambah siswa


    public function storeSiswa(Request $request)
{
    // Validasi input
    $request->validate([
        'nis' => 'required|string|max:20|unique:siswa,nis',
        'nisn' => 'required|string|max:20',
        'username' => 'required|string|max:255|unique:users,username',
        'telepon' => 'required|string|max:20',
        'kelas_id' => 'required|exists:kelas,id', // Pastikan kelas_id ada di tabel kelas
        'gender' => 'required|in:Laki-laki,Perempuan',
        'alamat' => 'required|string|max:255',
        'tgl_lahir' => 'required|string|max:30',
    ]);

    // Simpan siswa sebagai user dengan role siswa dan kelas_id
    $user = User::create([
        'username' => $request->username,
        'password' => bcrypt('123456'),
        'role' => 'siswa',
        'kelas_id' => $request->kelas_id, // Simpan kelas_id di tabel users
    ]);

    // Simpan data siswa dengan user_id terkait
    Siswa::create([
        'user_id' => $user->id, // Menghubungkan siswa dengan user
        'nis' => $request->nis,
        'nisn' => $request->nisn,
        'telepon' => $request->telepon,
        'gender' => $request->gender,
        'alamat' => $request->alamat,
        'tgl_lahir' => $request->tgl_lahir,
    ]);

    return redirect('/admin/siswa/')->with('success', 'Data Siswa berhasil ditambahkan');
}




    // Update siswa
    public function updateSiswa(Request $request, $id)
    {
       // Validasi input
       $request->validate([
        'nis' => 'required|integer|unique:users,nis,'.$id,
        'nisn' => 'required|string|max:15',
        'username' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'kelas' => 'required|string|max:5',
        'gender' => 'required|string|max:10',
        'alamat' => 'required|string|max:50',
        'tgl_lahir' => 'required|string|max:30',
    ]);

    // Cari siswa berdasarkan id dan update
    $siswa = User::where('role', 'siswa')->findOrFail($id);
    $siswa->update([
        'nis' => $request->nis,
        'nisn' => $request->nisn,
        'username' => $request->username,
        'telepon' => $request->telepon,
        'kelas' => $request->kelas,
        'gender' => $request->gender,
        'alamat' => $request->alamat,
        'tgl_lahir' => $request->tgl_lahir,
    ]);

    return redirect('/admin/siswa/')->with('success', 'Data Siswa berhasil diupdate');
    }

    // Hapus siswa
    public function deleteSiswa($id)
    {
        // Cari siswa berdasarkan id dan hapus
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        $siswa->delete();

        return redirect('/admin/siswa/')->with('success', 'Data siswa berhasil dihapus');
    }


// =================================================================================================================
// =================================================================================================================
// =================================================================================================================


    // Tampilkan daftar guru
    public function listGuru()
    {
        $users = User::has('guru')->where('role', 'guru')->get();
        return view('admin.guru.index', compact('users'));
    }

    public function storeGuru(Request $request)
    {
        // Validasi input
        $request->validate([
            'nip' => 'required|string|max:50|unique:guru,nip',
            'username' => 'required|string|max:255|unique:users,username',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:30',
            'telepon' => 'required|string|max:20',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'required|string|max:50',
        ]);

        // Simpan guru sebagai user dengan role guru
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt('123456'), // default password
            'role' => 'guru',
        ]);

        // Pastikan user_id terkait dengan guru
        guru::create([
            'user_id' => $user->id, // Menghubungkan guru dengan user
            'nip' => $request->nip,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jabatan' => $request->jabatan,
        ]);

        return redirect('/admin/guru/')->with('success', 'Data guru berhasil ditambahkan');

    }


    // Update guru
    public function updateGuru(Request $request, $id)
    {
       // Validasi input
       $request->validate([
        'nip' => 'required|string|max:50|unique:guru,nip,'.$id.',user_id', // Validasi di tabel guru
        'username' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'gender' => 'required|string|max:10',
        'alamat' => 'required|string|max:50',
        'tgl_lahir' => 'required|string|max:30',
        'jabatan' => 'required|string|max:50',
    ]);

    // Cari data user dan guru berdasarkan id user
    $user = User::findOrFail($id);
    $guru = Guru::where('user_id', $id)->firstOrFail();

    // Update data user
    $user->update([
        'username' => $request->username,
    ]);

    // Update data guru
    $guru->update([
        'nip' => $request->nip,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'tgl_lahir' => $request->tgl_lahir,
        'gender' => $request->gender,
        'jabatan' => $request->jabatan,
    ]);

    return redirect('/admin/guru/')->with('success', 'Data guru berhasil diupdate');
    }
    // Hapus guru
    public function deleteGuru($id)
    {
        // Cari guru berdasarkan id dan hapus
        $guru = User::where('role', 'guru')->findOrFail($id);
        $guru->delete();

        return redirect('/admin/guru/')->with('success', 'Data guru berhasil dihapus');
    }
}
