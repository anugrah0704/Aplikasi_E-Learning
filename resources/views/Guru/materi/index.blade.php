@extends('layout.app')
@section('konten')

<style>
    .modal-header {
        background-color: #f8f9fa;
    }

    .modal-title {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

</style>

<div class="container mt-4">
    <h1>Daftar Materi</h1>

    <!-- Tombol Tambah Materi -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMateriModal">
        Tambah Materi
    </button>

    <!-- Tabel Daftar Materi -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materi as $m)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->judul }}</td>
                    <td>{{ $m->mapel->nama_mapel }}</td>
                    <td>{{ $m->kelas->nama_kelas }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $m->file_path) }}" target="_blank">Lihat File</a>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada materi yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah Materi -->
<div class="modal fade" id="tambahMateriModal" tabindex="-1" role="dialog" aria-labelledby="tambahMateriModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMateriModalLabel">Tambah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul Modul / Materi</label>
                        <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukkan judul materi" required>
                    </div>
                    <div class="form-group">
                        <label for="mapel_id">Mata Pelajaran</label>
                        <select name="mapel_id" class="form-control" id="mapel_id" required>
                            <option value="" disabled selected>Pilih Mata Pelajaran</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" class="form-control" id="kelas_id" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" class="form-control-file" id="file" required>
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

@endsection
