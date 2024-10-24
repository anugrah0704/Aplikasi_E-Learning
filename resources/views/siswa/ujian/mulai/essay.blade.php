@extends('layout.app')

@section('konten')
<div class="container">
    <h3>Ujian Soal Essay - {{ $ujian->judul }}</h3>

    <div class="card">
        <div class="card-body mt-3">
            <form action="{{ route('siswa.ujian.submitEssay', $ujian->id) }}" method="POST">
                @csrf
                @foreach ($soals as $soal)
                    <div class="form-group mb-2">
                        <label for="jawaban_{{ $soal->id }}">
                            <strong>{{ $loop->iteration }}. {{ $soal->soal }}</strong>
                        </label>
                    </div>
                    <label for="jawaban">Jawab:</label>
                    <textarea name="jawaban[{{ $soal->id }}]" id="jawaban_{{ $soal->id }}" class="form-control" rows="4">{{ old('jawaban.'.$soal->id) }}</textarea><br>
                @endforeach

                <button type="submit" class="btn btn-primary">Submit Jawaban</button>
                <a href="{{ route('siswa.ujian.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
