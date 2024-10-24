<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Ujian;
use App\Models\User;
use App\Models\Siswa;
use App\Models\PilihanGanda;
use App\Models\Essay;
use App\Models\JawabanSiswaPilgan;
use App\Models\JawabanSiswaEssay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan auth untuk mengambil siswa

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

        // Mengambil data siswa yang sedang login
        $siswa = Auth::user()->siswa;

        return view('siswa.ujian.view', compact('ujian', 'siswa'));
    }

    public function kerjakan($id)
    {
        // Mengambil detail ujian berdasarkan ID dengan relasi guru dan mapel
        $ujian = Ujian::with(['guru.user', 'mapel'])->findOrFail($id);

        // Mengambil data siswa yang sedang login
        $siswa = Auth::user()->siswa;

        return view('siswa.ujian.kerjakan', compact('ujian', 'siswa'));
    }

    public function mulaiPilgan($id)
    {
        // Mengambil detail ujian dan soal pilihan ganda yang terkait dengan ujian
        $ujian = Ujian::with('pilihanGanda')->findOrFail($id);

        // Ambil soal terkait ujian
        $soals = $ujian->pilihanGanda;

        // Mengambil data siswa yang sedang login
        $siswa = Auth::user()->siswa;

        return view('siswa.ujian.mulai.pilgan', compact('ujian', 'soals', 'siswa'));
    }

    public function submitPilgan(Request $request, $id)
    {
        // Ambil detail ujian
        $ujian = Ujian::findOrFail($id);

        // Ambil id siswa dari session atau model
        $siswaId = auth()->user()->siswa->id;

        // Ambil jawaban dari form
        $jawabanSiswa = $request->input('kunci_jawaban');

        // Simpan jawaban ke database
        foreach ($jawabanSiswa as $soalId => $jawaban) {
            JawabanSiswaPilgan::create([
                'siswa_id' => $siswaId,
                'ujian_id' => $ujian->id,
                'pilihan_ganda_id' => $soalId,
                'jawaban_siswa' => $jawaban
            ]);
        }

        // Redirect ke halaman hasil
        return redirect()->route('siswa.ujian.nilai.pilgan', $ujian->id)->with('success', 'Jawaban berhasil disimpan.');
    }

    public function hasilUjian($id)
    {
        // Ambil detail ujian
        $ujian = Ujian::with(['pilihanGanda'])->findOrFail($id);

        // Ambil id siswa dari session atau model
        $siswaId = auth()->user()->siswa->id;

        // Ambil jawaban siswa dari database
        $jawabanSiswa = JawabanSiswaPilgan::where('siswa_id', $siswaId)
                            ->where('ujian_id', $ujian->id)
                            ->pluck('jawaban_siswa', 'pilihan_ganda_id');

        // Inisialisasi variabel skor
        $jumlahBenar = 0;

        // Periksa jawaban pilihan ganda
        foreach ($ujian->pilihanGanda as $soal) {
            if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->kunci_jawaban) {
                $jumlahBenar++;
            }
        }

        // Hitung skor
        $totalSoal = $ujian->pilihanGanda->count();
        $skor = $totalSoal > 0 ? ($jumlahBenar / $totalSoal) * 100 : 0;

        // Kirim data ke view
        return view('siswa.ujian.nilai.pilgan', compact('ujian', 'jawabanSiswa', 'jumlahBenar', 'totalSoal', 'skor'));
    }

// ==================================================================================================================
// ==================================================================================================================

public function tampilEssay($id)
{
    // Ambil detail ujian berdasarkan ID dengan soal essay yang berelasi
    $ujian = Ujian::with('essay')->findOrFail($id);

    // Ambil semua soal essay terkait ujian
    $soals = $ujian->essay;

    return view('siswa.ujian.mulai.essay', compact('ujian', 'soals'));
}

public function submitEssay(Request $request, $id)
{
    // Validasi jawaban essay
    $request->validate([
        'jawaban' => 'required|array', // Jawaban harus dalam format array
        'jawaban.*' => 'required|string', // Setiap jawaban harus berupa string
    ]);

    // Ambil ujian dan id siswa
    $ujian = Ujian::findOrFail($id);
    $siswaId = auth()->user()->siswa->id;

    // Loop dan simpan jawaban siswa ke dalam database
    foreach ($request->jawaban as $soalId => $jawaban) {
        JawabanSiswaEssay::create([
            'siswa_id' => $siswaId,
            'ujian_id' => $ujian->id,
            'essay_id' => $soalId,
            'jawaban_siswa' => $jawaban
        ]);
    }

    return redirect()->route('siswa.ujian.nilai.essay')->with('success', 'Jawaban berhasil disimpan.');
}

public function nilaiEssay($id)
{
    // Ambil detail ujian berdasarkan ID beserta relasi soal essay
    $ujian = Ujian::with('essay')->findOrFail($id);

    // Ambil id siswa dari session atau auth
    $siswaId = auth()->user()->siswa->id;

    // Ambil jawaban essay siswa
    $jawabanSiswa = JawabanSiswaEssay::where('siswa_id', $siswaId)
                                     ->where('ujian_id', $ujian->id)
                                     ->pluck('jawaban_siswa', 'essay_id');

    // Hitung skor essay
    $nilaiTotal = 0;
    $jumlahSoal = $ujian->essay->count();

    foreach ($ujian->essay as $soal) {
        // Misalkan kita cek apakah jawaban sudah dinilai oleh guru
        // Jika sudah dinilai, gunakan skor dari database
        if (isset($jawabanSiswa[$soal->id])) {
            $nilaiSoal = $soal->nilai ?? 0; // Nilai diisi oleh guru
            $nilaiTotal += $nilaiSoal;
        }
    }

    // Hitung nilai akhir dalam bentuk persentase (0 - 100)
    $nilaiAkhir = $jumlahSoal > 0 ? ($nilaiTotal / ($jumlahSoal * 100)) * 100 : 0;

    return view('siswa.ujian.nilai.essay', compact('ujian', 'jawabanSiswa', 'nilaiTotal', 'jumlahSoal', 'nilaiAkhir'));
}

// ==================================================================================================================
// ===================================== Koreksi Ujian Siswa =========================================================
// ==================================================================================================================


public function daftarSiswa($ujian_id)
{
    // Ambil daftar siswa yang telah mengerjakan ujian
    $siswaSudahUjian = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->join('kelas', 'users.kelas_id', '=', 'kelas.id') // Join ke tabel kelas
        ->join('jawaban_siswa_pilgan', 'siswa.id', '=', 'jawaban_siswa_pilgan.siswa_id')
        ->leftJoin('jawaban_siswa_essay', 'siswa.id', '=', 'jawaban_siswa_essay.siswa_id')
        ->join('ujian', 'jawaban_siswa_pilgan.ujian_id', '=', 'ujian.id')
        ->select('siswa.nisn', 'siswa.nis', 'users.username as nama_siswa', 'kelas.nama_kelas as kelas', 'jawaban_siswa_pilgan.nilai_pg', 'jawaban_siswa_essay.nilai_essay', 'ujian.judul')
        ->where('ujian.id', $ujian_id)
        ->distinct()
        ->get(); // Jalankan query untuk mendapatkan hasil

    return view('guru.manajemen-ujian.koreksi.daftar-siswa', compact('siswaSudahUjian'));
}



// Method untuk menampilkan daftar siswa yang ikut ujian dan mengerjakan soal
// public function daftarSiswa($ujian_id)
// {
//     // Ambil data ujian berdasarkan ID
//     $ujian = Ujian::with('mapel', 'guru')->findOrFail($ujian_id);

//     // Ambil kelas terkait ujian (misalnya, ambil dari objek ujian atau dari request)
//     $kelasId = $ujian->kelas_id; // Pastikan field kelas_id ada di tabel ujian

//     // Ambil jumlah total soal yang diujikan
//     $totalSoalPG = PilihanGanda::where('ujian_id', $ujian_id)->count();
//     $totalSoalEssay = Essay::where('ujian_id', $ujian_id)->count();

//     // Ambil data siswa yang telah mengerjakan semua soal (baik PG maupun Essay) berdasarkan kelas
//     $siswaList = User::where('role', 'siswa')
//         ->whereHas('siswa', function ($query) use ($kelasId) {
//             $query->where('kelas_id', $kelasId); // Filter berdasarkan kelas
//         })
//         ->where(function($query) use ($ujian_id, $totalSoalPG, $totalSoalEssay) {
//             $query->whereHas('jawabanSiswaPilgan', function($query) use ($ujian_id, $totalSoalPG) {
//                 $query->where('ujian_id', $ujian_id)
//                       ->havingRaw('COUNT(*) >= ?', [$totalSoalPG]); // Cek apakah jawaban PG selesai
//             })
//             ->whereHas('jawabanSiswaEssay', function($query) use ($ujian_id, $totalSoalEssay) {
//                 $query->where('ujian_id', $ujian_id)
//                       ->havingRaw('COUNT(*) >= ?', [$totalSoalEssay]); // Cek apakah jawaban Essay selesai
//             });
//         })
//         ->paginate(10);

//     return view('guru.manajemen-ujian.koreksi.daftar-siswa', compact('ujian', 'siswaList'));
// }


// Method untuk menampilkan halaman analisa nilai PG
public function analisaPilihanGanda($ujian_id, $siswa_id)
{
    $ujian = Ujian::findOrFail($ujian_id);
    $siswa = Siswa::findOrFail($siswa_id);

    // Ambil jawaban siswa dari tabel jawaban_siswa_pilgan
    $jawabanPG = JawabanSiswaPilgan::where('ujian_id', $ujian_id)
                                    ->where('siswa_id', $siswa_id)
                                    ->get();

    // Logika untuk analisa jawaban PG, misalnya menghitung nilai
    $nilaiPG = $this->hitungNilaiPG($jawabanPG);

    return view('guru.manajemen-ujian.koreksi.analisa_pg', compact('ujian', 'siswa', 'jawabanPG', 'nilaiPG'));
}

// Fungsi tambahan untuk menghitung nilai pilihan ganda
private function hitungNilaiPG($jawabanPG)
{
    // Contoh perhitungan sederhana: cocokkan jawaban siswa dengan kunci
    $nilai = 0;
    foreach ($jawabanPG as $jawaban) {
        if ($jawaban->jawaban == $jawaban->soal->kunci_jawaban) {
            $nilai += 1; // Tambah nilai untuk jawaban yang benar
        }
    }
    return $nilai; // Mengembalikan total nilai PG
}


// Method untuk menampilkan halaman koreksi essay
public function koreksiEssay($ujian_id, $siswa_id)
{
    $ujian = Ujian::findOrFail($ujian_id);
    $siswa = Siswa::findOrFail($siswa_id);

    // Ambil jawaban essay siswa
    $jawabanEssay = JawabanSiswaEssay::where('ujian_id', $ujian_id)
                                     ->where('siswa_id', $siswa_id)
                                     ->first();

    return view('guru.manajemen-ujian.koreksi.koreksi_essay', compact('ujian', 'siswa', 'jawabanEssay'));
}


// Method untuk melakukan update nilai essay setelah dikoreksi
public function simpanKoreksiEssay(Request $request, $ujian_id, $siswa_id)
{
    $siswa = Siswa::findOrFail($siswa_id);

    // Validasi nilai essay yang dikoreksi
    $request->validate([
        'nilai_essay' => 'required|numeric|min:0|max:100',
    ]);

    // Simpan nilai essay yang telah dikoreksi
    $jawabanEssay = JawabanSiswaEssay::where('ujian_id', $ujian_id)
                                     ->where('siswa_id', $siswa_id)
                                     ->first();
    $jawabanEssay->nilai_essay = $request->input('nilai_essay');
    $jawabanEssay->save();

    return redirect()->route('guru.manajemen-ujian.koreksi.daftar-siswa', $ujian_id)
                     ->with('success', 'Nilai Essay berhasil disimpan.');
}

}
