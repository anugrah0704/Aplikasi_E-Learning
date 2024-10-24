@extends('layout.app')

@section('konten')
<div class="container mt-5">
    <h3>{{ $ujian->judul }}</h3>
    <p>Mata Pelajaran: {{ $ujian->mapel->nama_mapel ?? 'Tidak Ada' }}</p>
    <p>Waktu Pengerjaan: {{ $ujian->waktu_pengerjaan }} Menit</p>

    <form action="{{ route('siswa.ujian.submit.pilgan', $ujian->id) }}" method="POST">
        @csrf

        @foreach($soals as $index => $soal)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Soal #{{ $index + 1 }}</h5>
                <p>{{ $soal->soal }}</p>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kunci_jawaban[{{ $soal->id }}]" value="A" id="pilihanA{{ $soal->id }}">
                    <label for="pilihanA{{ $soal->id }}" class="form-check-label">{{ $soal->pilihan_a }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kunci_jawaban[{{ $soal->id }}]" value="B" id="pilihanB{{ $soal->id }}">
                    <label for="pilihanB{{ $soal->id }}" class="form-check-label">{{ $soal->pilihan_b }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kunci_jawaban[{{ $soal->id }}]" value="C" id="pilihanC{{ $soal->id }}">
                    <label for="pilihanC{{ $soal->id }}" class="form-check-label">{{ $soal->pilihan_c }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kunci_jawaban[{{ $soal->id }}]" value="D" id="pilihanD{{ $soal->id }}">
                    <label for="pilihanD{{ $soal->id }}" class="form-check-label">{{ $soal->pilihan_d }}</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="kunci_jawaban[{{ $soal->id }}]" value="E" id="pilihanE{{ $soal->id }}">
                    <label for="pilihanE{{ $soal->id }}" class="form-check-label">{{ $soal->pilihan_e }}</label>
                </div>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary btn-block">Kirim Jawaban</button>
    </form>
</div>
@endsection
