@extends('layout.app')

@section('konten')
    <div class="container">
        <h3>Soal Pilihan Ganda - {{ $ujian->judul }}</h3>

        <form action="{{ route('ujian.submit.pilgan', $ujian->id) }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    @foreach($soals as $index => $soal)
                        <div class="mb-4">
                            <h5>{{ $index + 1 }}. {{ $soal->pertanyaan }}</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" value="A">
                                <label class="form-check-label">
                                    A. {{ $soal->pilihan_a }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" value="B">
                                <label class="form-check-label">
                                    B. {{ $soal->pilihan_b }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" value="C">
                                <label class="form-check-label">
                                    C. {{ $soal->pilihan_c }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban[{{ $soal->id }}]" value="D">
                                <label class="form-check-label">
                                    D. {{ $soal->pilihan_d }}
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-success">Kumpulkan Jawaban</button>
                </div>
            </div>
        </form>
    </div>
@endsection
