<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Mapel; // Model untuk Mata Pelajaran
use App\Models\Kelas; // Model untuk Kelas
class MateriController extends Controller
{
    //
    public function index()
    {
        $materi = Materi::all();
         // Ambil data mata pelajaran dan kelas dari database
        $mapel = Mapel::all();
        $kelas = Kelas::all();

        return view('guru.materi.index', compact('materi', 'mapel', 'kelas'));
    }

    public function indexSiswa()
{
    // Ambil kelas_id dari user yang sedang login
    $kelasId = Auth::user()->kelas_id;

    // Ambil materi sesuai kelas_id
    $materi = Materi::with(['mapel', 'user'])
                ->where('kelas_id', $kelasId)
                ->paginate(10);

    return view('siswa.materi.index', compact('materi'));
}


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|integer',
            'kelas_id' => 'required|integer',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Maksimal 2MB
        ]);

        // Proses upload file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/materi', $fileName, 'public');
        }

        // Simpan data ke database
        $materi = new Materi();
        $materi->judul = $request->input('judul');
        $materi->mapel_id = $request->input('mapel_id');
        $materi->kelas_id = $request->input('kelas_id');
        $materi->file_path = $filePath; // Path file yang di-upload
        $materi->user_id = Auth::id(); // Menggunakan ID dari tabel users
        $materi->save();

        // Redirect ke halaman materi index dengan pesan sukses
        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }


    public function detailMateri($id)
{
    // Ambil kelas_id dari user yang sedang login
    $kelasId = Auth::user()->kelas_id;

    // Ambil materi sesuai id dan kelas_id
    $materi = Materi::with(['mapel', 'user'])
                ->where('kelas_id', $kelasId)
                ->where('id', $id)
                ->first();  // Mengambil satu record

    // Pastikan materi ditemukan, jika tidak kembalikan ke halaman sebelumnya
    if (!$materi) {
        return redirect()->back()->with('error', 'Materi tidak ditemukan.');
    }

    return view('siswa.materi.detail', compact('materi'));
}


}
