<?php

namespace App\Http\Controllers;

use App\Models\Ujian; // Pastikan hanya ada satu 'use' statement untuk import model
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;

class ManajemenTugasController extends Controller
{
    public function index()
    {
         // Ambil data ujian dan mata pelajaran dari database
        $ujianTugas = Ujian::paginate(10);
        $mapels = Mapel::all(); // Ambil semua mata pelajaran
        $kelases = Kelas::all(); // Ambil semua kelas

        return view('guru.manajemen-ujian.index', compact('ujianTugas', 'mapels', 'kelases'));
    }

    public function show($id)
    {
        $ujian = Ujian::with('kelas', 'mapel')->findOrFail($id);

        return view('guru.manajemen-ujian.detailsoal', compact('ujian'));
    }


    public function create()
    {
        // Ambil semua mapel dan kelas untuk dropdown di form
        $mapels = Mapel::all();
        $kelases = Kelas::all();
        return view('guru.manajemen-ujian.create', compact('mapels', 'kelases'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'mapel_id' => 'required|exists:mapels,id', // Perbaiki table menjadi 'mapels'
            'kelas_id' => 'required|exists:kelas,id', // Perbaiki table menjadi 'kelases'
            'waktu_pengerjaan' => 'required|integer',
            'info_ujian' => 'required|string',
            'bobot_pilihan_ganda' => 'required|integer|min:0|max:100',
            'bobot_essay' => 'required|integer|min:0|max:100',
            'terbit' => 'required|in:Y,N',
        ]);

        // Simpan data ujian dengan user_id
        $validated['user_id'] = auth()->user()->guru->id; // Mengisi user_id dengan ID guru yang sedang login
        // Simpan data ujian
        Ujian::create($validated);
        return redirect()->route('guru.manajemen-ujian.index')->with('success', 'Ujian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Mengambil data ujian berdasarkan id
        $ujian = Ujian::findOrFail($id);
        $mapels = Mapel::all();
        $kelases = Kelas::all();
        return view('ujian.edit', compact('ujian', 'mapels', 'kelases'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'mapel_id' => 'required|exists:mapels,id', // Sesuaikan dengan nama tabel mapel
            'kelas_id' => 'required|exists:kelas,id', // Sesuaikan dengan nama tabel kelas
            'waktu_pengerjaan' => 'required|integer',
            'info_ujian' => 'required|string',
            'bobot_pilihan_ganda' => 'required|integer|min:0|max:100',
            'bobot_essay' => 'required|integer|min:0|max:100',
            'terbit' => 'required|in:Y,N',
        ]);

        // Update data ujian
        $ujian = Ujian::findOrFail($id);
        $ujian->update($validated);
        return redirect()->route('guru.manajemen-ujian.index')->with('success', 'Ujian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus ujian
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();
        return redirect()->route('guru.manajemen-ujian.index')->with('success', 'Ujian berhasil dihapus.');
    }
}
