<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Siswa; // pastikan Anda telah membuat model Siswa
use App\Models\Guru; // pastikan Anda telah membuat model Guru
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

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

    public function searchSiswa(Request $request)
{
    $search = $request->input('search');

    // Mengambil data siswa dari tabel users
    $query = User::where('role', 'siswa');

    // Jika ada pencarian
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nis', 'like', '%' . $search . '%')
              ->orWhere('username', 'like', '%' . $search . '%');
        });
    }

    $siswa = $query->paginate(10);

    // Debug query result
    dd($siswa); // Lihat hasil query di sini

    return view('admin.siswa.index', compact('siswa'));
}





// =====================================================================================================================
// =================================================================================================================


    // Tampilkan daftar siswa
    public function listSiswa()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    // Form tambah siswa
    public function createSiswa()
    {
        return view('admin.siswa.create');
    }

    public function storeSiswa(Request $request)
    {
        // Validasi input
        $request->validate([
            'nis' => 'required|integer|unique:users,nis',
            'nisn' => 'required|string|max:15',
            'username' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'kelas' => 'required|string|max:5',
            'gender' => 'required|string|max:10',
            'alamat' => 'required|string|max:50',
        ]);

        // Simpan siswa sebagai user dengan role siswa
        User::create([
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'username' => $request->username,
            'telepon' => $request->telepon,
            'password' => bcrypt('123456'),  // Password otomatis '123456'
            'kelas' => $request->kelas,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'role' => 'siswa',
        ]);

        return redirect('/admin/siswa/')->with('success', 'Data Siswa berhasil ditambahkan');

    }

    // Form edit siswa
    public function editSiswa($id)
    {
        // Cari siswa berdasarkan id
        $siswa = User::where('role', 'siswa')->findOrFail($id);

        return view('admin.siswa.edit', compact('siswa'));
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


    public function storeGuru(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan guru sebagai user dengan role guru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'guru',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data Guru berhasil ditambahkan');
    }
}
