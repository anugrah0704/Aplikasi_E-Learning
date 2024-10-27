@extends('layout.app')

@section('konten')
<div class="container">
    <!-- Heading Card -->
    <div class="card shadow mt-4 mb-4">
        <div class="card-header bg-primary text-white text-center">
            <h3>Nilai Essay Ujian</h3>
            <h4>{{ $ujian->judul }}</h4>
        </div>
    </div>

    <!-- Content Card -->
    <div class="card shadow">
        <div class="card-body">
            <!-- Table for Essay Results -->
            <table class="table table-hover table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban Siswa</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujian->essay as $soal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $soal->soal }}</td>
                            <td>{{ $jawabanSiswa[$soal->id] ?? 'Belum Dijawab' }}</td>
                            <td>
                                @if($soal->nilai !== null)
                                    <span class="badge bg-success">{{ $soal->nilai }}</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Dinilai</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total and Final Score -->
            <div class="alert alert-info mt-4">
                <strong>Nilai Total: </strong> {{ $nilaiTotal }} / {{ $jumlahSoal * 100 }}<br>
                <strong>Nilai Akhir: </strong> {{ number_format($nilaiAkhir, 2) }}%
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('siswa.ujian.kerjakan', ['ujian_id' => $ujian->id]) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ujian
                </a>
            </div>
        </div>
    </div>
</div>
@endsection