<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

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
}
