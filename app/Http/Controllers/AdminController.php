<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Siswa; // pastikan Anda telah membuat model Siswa
use App\Models\Guru; // pastikan Anda telah membuat model Guru

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


    public function search(Request $request)
{
    $search = $request->get('search');

    // Filter berdasarkan role siswa
    $siswa = User::where('role', 'siswa')  // Filter untuk peran siswa
                ->where(function ($query) use ($search) {
                    $query->where('nis', 'like', "%$search%")
                          ->orWhere('username', 'like', "%$search%");
                })
                ->paginate(10); // Menggunakan paginasi dengan 10 siswa per halaman

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
            'username' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email', // email opsional
            'kelas' => 'required|string|max:5',
            'gender' => 'required|string|max:10',
            'alamat' => 'required|string|max:50',
        ]);

        // Simpan siswa sebagai user dengan role siswa
        User::create([
            'nis' => $request->nis,
            'username' => $request->username,
            'email' => $request->email,        // Email bisa kosong
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
        'username' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email,'.$id,  // email opsional
        'kelas' => 'required|string|max:5',
        'gender' => 'required|string|max:10',
        'alamat' => 'required|string|max:50',
    ]);

    // Cari siswa berdasarkan id dan update
    $siswa = User::where('role', 'siswa')->findOrFail($id);
    $siswa->update([
        'nis' => $request->nis,
        'username' => $request->username,
        'email' => $request->email, // Email bisa kosong
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
