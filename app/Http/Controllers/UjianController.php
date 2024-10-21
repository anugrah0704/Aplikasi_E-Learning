<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        // Mengambil jumlah ujian yang dikelompokkan berdasarkan guru
        $ujians = Ujian::with(['mapel', 'guru.user'])
        ->withCount('guru') // Hitung jumlah ujian per guru
        ->get();


        return view('siswa.ujian.index', compact('ujians'));
    }

    public function view($id)
    {
        // Mengambil detail ujian berdasarkan ID
        $ujian = Ujian::with(['guru.user', 'mapel']) // Menambahkan mapel juga
            ->find($id);

        if (!$ujian) {
            return redirect()->route('siswa.ujian.index')->with('error', 'Ujian tidak ditemukan.');
        }

        return view('siswa.ujian.view', compact('ujian'));
    }

    public function kerjakan($id)
{
    // Mengambil detail ujian berdasarkan ID dengan relasi guru dan mapel
    $ujian = Ujian::with(['guru.user', 'mapel'])->findOrFail($id);

    return view('siswa.ujian.kerjakan', compact('ujian'));
}

// =================================================================================================================
// = = = = = = = = =  = = = = = = = = == Mulai Mengerjkan = =  = = = = = = = = = = = = = = = = = = = = = = = = =  =
// =================================================================================================================

    public function mulaiPilgan($id)
    {
        // Mengambil detail ujian dan soal pilihan ganda
        $ujian = Ujian::with(['soalPilihanGanda'])->findOrFail($id);

        // Ambil soal terkait ujian
        $soals = $ujian->soalPilihanGanda; // Asumsi model memiliki relasi soalPilihanGanda

        return view('siswa.ujian_pilgan', compact('ujian', 'soals'));
    }

    public function submitPilgan(Request $request, $id)
    {
        $ujian = Ujian::findOrFail($id);
        $jawabanSiswa = $request->input('jawaban', []);

        // Ambil semua soal dari ujian ini
        $soals = $ujian->soalPilihanGanda;

        $jumlahBenar = 0;

        // Periksa jawaban
        foreach ($soals as $soal) {
            if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->jawaban_benar) {
                $jumlahBenar++;
            }
        }

        // Hitung skor
        $skor = ($jumlahBenar / $soals->count()) * 100;

        // Simpan hasil ujian ke database (opsional, sesuai dengan struktur database Anda)

        return redirect()->route('ujian.hasil', $id)->with('success', "Ujian selesai! Skor Anda: $skor");
    }



}
