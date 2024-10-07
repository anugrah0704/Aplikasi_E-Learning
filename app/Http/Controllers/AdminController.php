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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan siswa sebagai user dengan role siswa
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa',
        ]);

        return redirect('/admin/siswa/index')->with('success', 'Data Siswa berhasil ditambahkan');

    }

    // Form edit siswa
    public function editSiswa($id)
    {
        $siswa = User::find($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    // Update siswa
    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::find($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'kelas' => 'required|string|max:100',
        ]);

        $siswa->update([
            'name' => $request->nama,
            'email' => $request->email,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diupdate');
    }

    // Hapus siswa
    public function deleteSiswa($id)
    {
        User::destroy($id);
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus');
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
