@extends('layout.app')

@section('konten')
<div class="container">
    <h3 class="my-4">Manajemen Soal Essay</h3>

    <div class="card">
        <div class="card-header">
            Daftar Soal Essay
            <a href="{{ route('guru.manajemen-ujian.detailsoal', ['id' => $ujian_id]) }}" class="btn btn-secondary float-right">Back</a>
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahSoalEssayModal">+ Tambah Soal</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Tanggal Buat</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soalEssay as $key => $soal)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $soal->soal }}</td>
                        <td>{{ $soal->created_at }}</td>
                        <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSoalEssayModal{{ $soal->id }}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusSoalEssayModal{{ $soal->id }}"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginate Links -->
            {{ $soalEssay->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Soal Essay -->
<div class="modal fade" id="tambahSoalEssayModal" tabindex="-1" role="dialog" aria-labelledby="tambahSoalEssayModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('guru.manajemen-ujian.essay.store', $ujian_id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSoalEssayModalLabel">Tambah Soal Essay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="soal">Pertanyaan</label>
                        <textarea class="form-control" name="soal" required></textarea>
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

<!-- Modal Edit Soal Essay -->
@foreach($soalEssay as $soal)
<div class="modal fade" id="editSoalEssayModal{{ $soal->id }}" tabindex="-1" role="dialog" aria-labelledby="editSoalEssayModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('guru.manajemen-ujian.essay.update', ['ujian_id' => $ujian_id, 'id' => $soal->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSoalEssayModalLabel">Edit Pertanyaan Essay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea class="form-control" name="soal" required>{{ $soal->soal }}</textarea>
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

<!-- Modal Hapus Soal Essay -->
@foreach($soalEssay as $soal)
<div class="modal fade" id="hapusSoalEssayModal{{ $soal->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusSoalEssayModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('guru.manajemen-ujian.essay.destroy', ['ujian_id' => $ujian_id, 'id' => $soal->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusSoalEssayModalLabel">Hapus Soal Essay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus soal ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
