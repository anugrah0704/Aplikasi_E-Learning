@extends('layout.app') <!-- Pastikan layout utama digunakan -->

@section('konten')
<div class="container">
    <h3 class="my-4">Menu Manajemen Ujian / Tugas</h3>

    <div class="card">
        <div class="card-header">
            Daftar Tugas dan Ujian
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahUjianModal">
                + Tambah Ujian
            </button>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul/Nama Ujian</th>
                        <th>Keterangan</th>
                        <th>Mata Pelajaran</th>
                        <th>Telah Ujian</th>
                        <th>Lihat Soal</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ujianTugas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->info_ujian }}</td>
                        <td>{{ $item->mapel->nama_mapel }}</td> <!-- singular 'mapel' -->

                        <td>
                            <a href="{{ route('guru.manajemen-ujian.koreksi.daftar-siswa', $item->id) }}" class="btn btn-success">
                                <i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td>
                            <a href="{{ route('guru.manajemen-ujian.detailsoal', $item->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-magnifying-glass"></i></a>
                        </td>
                        <td>
                            <!-- Button Edit dengan trigger modal -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editUjianModal-{{ $item->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('guru.manajemen-ujian.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Edit Ujian -->
                    <div class="modal fade" id="editUjianModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editUjianLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUjianLabel">Edit Ujian</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('guru.manajemen-ujian.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="judul">Judul Ujian</label>
                                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $item->judul }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mapel">Mata Pelajaran</label>
                                            <select class="form-control" id="mapel" name="mapel_id">
                                                @foreach($mapels as $mapel)
                                                    <option value="{{ $mapel->id }}" {{ $item->mapel_id == $mapel->id ? 'selected' : '' }}>
                                                        {{ $mapel->nama_mapel }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas">Kelas</label>
                                            <select class="form-control" id="kelas" name="kelas_id">
                                                @foreach($kelases as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ $item->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                        {{ $kelas->nama_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu_pengerjaan">Waktu Pengerjaan (Menit)</label>
                                            <input type="number" class="form-control" id="waktu_pengerjaan" name="waktu_pengerjaan" value="{{ $item->waktu_pengerjaan }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="info">Info Ujian</label>
                                            <textarea class="form-control" id="info" name="info_ujian" rows="2" required>{{ $item->info_ujian }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="bobot_pilihan_ganda">Bobot Pilihan Ganda (%)</label>
                                            <input type="number" class="form-control" id="bobot_pilihan_ganda" name="bobot_pilihan_ganda" value="{{ $item->bobot_pilihan_ganda }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bobot_essay">Bobot Essay (%)</label>
                                            <input type="number" class="form-control" id="bobot_essay" name="bobot_essay" value="{{ $item->bobot_essay }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="terbit">Terbit?</label>
                                            <select class="form-control" id="terbit" name="terbit">
                                                <option value="Y" {{ $item->terbit == 'Y' ? 'selected' : '' }}>Y</option>
                                                <option value="N" {{ $item->terbit == 'N' ? 'selected' : '' }}>N</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

                        <!-- Modal Tambah Ujian -->
            <div class="modal fade" id="tambahUjianModal" tabindex="-1" aria-labelledby="tambahUjianLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahUjianLabel">Tambah Ujian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('guru.manajemen-ujian.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul Ujian</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="mapel">Mata Pelajaran</label>
                                    <select class="form-control" id="mapel" name="mapel_id">
                                        @foreach($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center my-3">
                <div>
                    Menampilkan {{ $ujianTugas->firstItem() }} - {{ $ujianTugas->lastItem() }} dari {{ $ujianTugas->total() }} Ujian
                </div>
                <div>
                    {{ $ujianTugas->links() }}
                </div>
            </div>


        </div>
    </div>
</div>
<script>
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function(event) {
        if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            event.preventDefault();
        }
    });
});
</script>
@endsection
