@extends('layout2.app')

@section('konten')
<div class="container mt-4">
    <h3 class="text-center mb-4">Menu Tambah Nilai Essay</h3>

    <!-- Data Siswa Section -->

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Data Siswa</h5>
            <p><strong>Nama:</strong> {{ $ujian && $ujian->siswa ? $ujian->siswa->username : 'Tidak ada' }}</p>
            <p><strong>NISN:</strong> {{ $ujian && $ujian->siswa ? $ujian->siswa->nisn : 'Tidak ada' }}</p>
            <p><strong>Kelas:</strong> {{ $ujian && $ujian->siswa && $ujian->siswa->kelas ? $ujian->siswa->kelas->nama_kelas : 'Tidak ada' }}</p>
        </div>
    </div>


    <!-- Table Jawaban Essay -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Jawaban</th>
                            <th>Total Nilai Essay</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ujian->essay as $index => $essay)
                            @php
                                $jawaban = $ujian->jawabanEssay->where('essay_id', $essay->id)->first();
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $essay->soal }}</td>
                                <td>{{ $jawaban ? $jawaban->jawaban_siswa : 'Belum dijawab' }}</td>
                                <td>{{ $jawaban->nilai_essay ?? 'Belum ada nilai' }}</td>
                                <td>
                                    <!-- Button untuk membuka modal tambah -->
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahNilaiModal{{ $essay->id }}">
                                        Koreksi Nilai
                                    </button>

                                    <!-- Modal Tambah Nilai -->
                                    <div class="modal fade" id="tambahNilaiModal{{ $essay->id }}" tabindex="-1" aria-labelledby="tambahNilaiLabel{{ $essay->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tambahNilaiLabel{{ $essay->id }}">Tambah Nilai Jawaban</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Soal:</strong> {{ $essay->soal }}</p>
                                                    <p><strong>Jawaban:</strong> {{ $jawaban ? $jawaban->jawaban_siswa : 'Belum dijawab' }}</p>

                                                    <form action="{{ route('guru.manajemen-ujian.koreksi.koreksiNilai', ['jawaban_id' => $jawaban->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="nilai">Nilai (1-100):</label>
                                                            <select name="nilai" id="nilai" class="form-control">
                                                                <option value="">--Pilih Nilai--</option>
                                                                @for($i = 1; $i <= 100; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Koreksi Nilai</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Tambah Nilai -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <a href="{{ route('guru.manajemen-ujian.daftar-siswa', ['ujian_id' => $ujian->id]) }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ujian
        </a>
    </div>
</div>
@endsection
