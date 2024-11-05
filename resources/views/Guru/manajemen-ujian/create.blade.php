@extends('layout2.app') <!-- Atau layout yang sesuai -->

@section('konten')
<div class="container">
    <h2>Tambah Ujian</h2>
    <form action="{{ route('guru.manajemen-ujian.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul Ujian</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>

        <!-- Mata Pelajaran -->
        <div class="form-group">
            <label for="mapel">Mata Pelajaran</label>
            <select class="form-control" id="mapel" name="mapel_id">
                @foreach($mapels as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <!-- Kelas -->
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select class="form-control" id="kelas" name="kelas_id">
                @foreach($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="waktu_pengerjaan">Waktu Pengerjaan (Menit)</label>
            <input type="number" class="form-control" id="waktu_pengerjaan" name="waktu_pengerjaan" required>
        </div>

        <div class="form-group">
            <label for="info">Info Ujian</label>
            <textarea class="form-control" id="info" name="info_ujian" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="bobot_pilihan_ganda">Bobot Pilihan Ganda (%)</label>
            <input type="number" class="form-control" id="bobot_pilihan_ganda" name="bobot_pilihan_ganda" required>
        </div>

        <div class="form-group">
            <label for="bobot_essay">Bobot Essay (%)</label>
            <input type="number" class="form-control" id="bobot_essay" name="bobot_essay" required>
        </div>

        <div class="form-group">
            <label for="terbit">Terbit?</label>
            <select class="form-control" id="terbit" name="terbit">
                <option value="Y">Y</option>
                <option value="N">N</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
