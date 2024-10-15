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

@endsection
