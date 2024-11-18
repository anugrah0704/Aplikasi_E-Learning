@extends('layout2.app')

@section('konten')

<style>
    .btn-custom {
        background-color: #6fbf73;
        color: white;
    }

    .btn-custom:hover {
        background-color: #5aa860;
        color: white;
    }

    .modal-header {
        background-color: #6fbf73;
        color: white;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4 text-center text-success">Manajemen Video Guru</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Upload Video -->
    <div class="mb-3 text-center">
        <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#uploadLokalModal">
            <i class="fas fa-upload"></i> Upload dari Lokal
        </button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadYoutubeModal">
            <i class="fab fa-youtube"></i> Upload dari YouTube
        </button>
    </div>

    <!-- Tabel Daftar Video -->
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Video</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Link/Path</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videos as $index => $video)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $video->judul }}</td>
                    <td>{{ $video->mapel }}</td>
                    <td>{{ $video->kelas }}</td>
                    <td>
                        @if($video->link_youtube)
                            <a href="{{ $video->link_youtube }}" target="_blank">Lihat Video</a>
                        @else
                            {{ $video->file_path }}
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('guru.video.destroy', $video->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada video yang diunggah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Upload dari Lokal -->
<div class="modal fade" id="uploadLokalModal" tabindex="-1" aria-labelledby="uploadLokalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadLokalModalLabel">Upload Video dari Lokal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('guru.video.store.local') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Video</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="mapel" name="mapel" required>
                            <option value="">-- Pilih Mapel --</option>
                            <option value="Matematika">Matematika</option>
                            <option value="IPA">IPA</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File Video</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Upload dari YouTube -->
<div class="modal fade" id="uploadYoutubeModal" tabindex="-1" aria-labelledby="uploadYoutubeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadYoutubeModalLabel">Upload Video dari YouTube</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('guru.video.store.youtube') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Video</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="mapel" name="mapel" required>
                            <option value="">-- Pilih Mapel --</option>
                            <option value="Matematika">Matematika</option>
                            <option value="IPA">IPA</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="link_youtube" class="form-label">Link YouTube</label>
                        <input type="url" class="form-control" id="link_youtube" name="link_youtube" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
