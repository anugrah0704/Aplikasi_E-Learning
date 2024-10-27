<?php

namespace App\Http\Controllers;

use App\Models\Ujian; // Pastikan hanya ada satu 'use' statement untuk import model
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenTugasController extends Controller
{
    public function index()
    {
        // Ambil ID guru yang sedang login
        $guruId = Auth::user()->guru->id;

        // Ambil data ujian/tugas hanya untuk guru yang sedang login
        $ujianTugas = Ujian::where('user_id', $guruId)
            ->with(['mapel', 'kelas'])
            ->paginate(10);

        // Ambil semua data mapel dan kelas untuk dropdown
        $mapels = Mapel::all();
        $kelases = Kelas::all();

        // Kirim data ke view
        return view('guru.manajemen-ujian.index', compact('ujianTugas', 'mapels', 'kelases'));
    }


    public function show($id)
    {
        $ujian = Ujian::with('kelas', 'mapel')->findOrFail($id);

        return view('guru.manajemen-ujian.detailsoal', compact('ujian'));
    }


    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul' => 'required|string|max:150',
            'mapel_id' => 'required|exists:mapels,id', // Pastikan nama tabel benar
            'kelas_id' => 'required|exists:kelas,id', // Pastikan nama tabel benar
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

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('guru.manajemen-ujian.index')->with('success', 'Ujian berhasil ditambahkan.');
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
