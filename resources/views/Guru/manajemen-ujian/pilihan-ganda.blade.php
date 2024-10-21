@extends('layout.app')

@section('konten')
<div class="container">
    <h3 class="my-4">Manajemen Soal Pilihan Ganda</h3>

    <div class="card">
        <div class="card-header">
            Daftar Soal Pilihan Ganda
            <a href="{{ route('guru.manajemen-ujian.detailsoal', ['id' => $ujian_id]) }}" class="btn btn-secondary float-right">Back</a>
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahSoalModal">+ Tambah Soal</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Pil A</th>
                        <th>Pil B</th>
                        <th>Pil C</th>
                        <th>Pil D</th>
                        <th>Pil E</th>
                        <th>Kunci Jawaban</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soalPilihanGanda as $key => $soal)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $soal->soal }}</td>
                        <td>{{ $soal->pilihan_a }}</td>
                        <td>{{ $soal->pilihan_b }}</td>
                        <td>{{ $soal->pilihan_c }}</td>
                        <td>{{ $soal->pilihan_d }}</td>
                        <td>{{ $soal->pilihan_e }}</td>
                        <td>{{ $soal->kunci_jawaban }}</td>
                        <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSoalModal{{ $soal->id }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusSoalModal{{ $soal->id }}"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>

                    <!-- Modal Edit Pilihan Ganda -->
                    <div class="modal fade" id="editSoalModal{{ $soal->id }}" tabindex="-1" role="dialog" aria-labelledby="editSoalModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('guru.manajemen-ujian.pilihan-ganda.update', ['ujian_id' => $ujian_id, 'id' => $soal->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSoalModalLabel">Edit Soal Pilihan Ganda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="soal">Soal</label>
                                            <textarea class="form-control" name="soal" required>{{ $soal->soal }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_a">Pilihan A</label>
                                            <input type="text" class="form-control" name="pilihan_a" value="{{ $soal->pilihan_a }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_b">Pilihan B</label>
                                            <input type="text" class="form-control" name="pilihan_b" value="{{ $soal->pilihan_b }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_c">Pilihan C</label>
                                            <input type="text" class="form-control" name="pilihan_c" value="{{ $soal->pilihan_c }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_d">Pilihan D</label>
                                            <input type="text" class="form-control" name="pilihan_d" value="{{ $soal->pilihan_d }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="pilihan_e">Pilihan E</label>
                                            <input type="text" class="form-control" name="pilihan_e" value="{{ $soal->pilihan_e }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kunci_jawaban">Kunci Jawaban</label>
                                            <input type="text" class="form-control" name="kunci_jawaban" value="{{ $soal->kunci_jawaban }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>

            <!-- Paginate Links -->
            {{ $soalPilihanGanda->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="tambahSoalModal" tabindex="-1" role="dialog" aria-labelledby="tambahSoalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('guru.manajemen-ujian.pilihan-ganda.storePilgan', $ujian_id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSoalModalLabel">Tambah Soal Pilihan Ganda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea class="form-control" name="soal" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_a">Pilihan A</label>
                        <input type="text" class="form-control" name="pilihan_a" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_b">Pilihan B</label>
                        <input type="text" class="form-control" name="pilihan_b" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_c">Pilihan C</label>
                        <input type="text" class="form-control" name="pilihan_c" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_d">Pilihan D</label>
                        <input type="text" class="form-control" name="pilihan_d" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_e">Pilihan E</label>
                        <input type="text" class="form-control" name="pilihan_e" required>
                    </div>
                    <div class="form-group">
                        <label for="kunci_jawaban">Kunci Jawaban</label>
                        <input type="text" class="form-control" name="kunci_jawaban" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
