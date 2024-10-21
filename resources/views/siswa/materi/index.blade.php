@extends('layout.app') <!-- Pastikan layout utama digunakan -->

@section('konten')

<div class="container mt-4">
    <h2 class="mb-3">Pilih Materi Sesuai Mata Pelajaran</h2>

    <!-- Tabel Materi -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengajar</th>
                    <th>Lihat Materi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->mapel->nama_mapel }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>
                            <a href="{{ route('siswa.materi.detail', $item->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada materi yang tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $materi->links() }}
    </div>
</div>

<div class="container">
    <h2>Daftar Materi untuk Kelas {{ Auth::user()->kelas->nama_kelas }}</h2> <!-- Menampilkan nama kelas siswa -->
    <p>Pilih Materi Sesuai Mata Pelajaran</p>

    @if($materi->isEmpty())
        <p>Tidak ada materi yang tersedia untuk kelas ini.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Judul Materi</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengajar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><a href="{{ route('siswa.materi.show', $item->id) }}">{{ $item->judul }}</a></td>
                        <td>{{ $item->mapel->nama_mapel ?? 'Mata Pelajaran Tidak Ditemukan' }}</td> <!-- Menampilkan mata pelajaran -->
                        <td>{{ $item->user->username ?? 'Guru Tidak Ditemukan' }}</td> <!-- Menampilkan nama guru -->
                        <td>
                            <a href="{{ asset($item->file_path) }}" class="btn btn-primary" target="_blank">Lihat Materi</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $materi->links() }}
    @endif
</div>
@endsection
