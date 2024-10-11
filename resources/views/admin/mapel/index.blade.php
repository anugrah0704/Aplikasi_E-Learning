@extends('layout.app')

@section('konten')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Daftar Mata Pelajaran</h2>
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMapelModal">
            Tambah Mata Pelajaran
        </button>
    </div>

    <!-- Tabel untuk menampilkan data mapel -->
    <table class="table table-bordered mt-3" id="mapelTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Pelajaran</th>
                <th>Nama Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mapels as $mapel)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mapel->kode_mapel }}</td>
                <td>{{ $mapel->nama_mapel }}</td>
                <td>
                    <!-- Edit button -->
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editMapelModal-{{ $mapel->id }}">
                        Edit
                    </button>

                    <!-- Delete form -->
                    <form action="{{ route('admin.mapel.delete', $mapel->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Mapel -->
            <div class="modal fade" id="editMapelModal-{{ $mapel->id }}" tabindex="-1" role="dialog" aria-labelledby="editMapelModalLabel-{{ $mapel->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMapelModalLabel-{{ $mapel->id }}">Edit Mata Pelajaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="kode_mapel">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" value="{{ $mapel->kode_mapel }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="{{ $mapel->nama_mapel }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Mapel -->
<div class="modal fade" id="addMapelModal" tabindex="-1" role="dialog" aria-labelledby="addMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMapelModalLabel">Tambah Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMapelForm" action="{{ route('admin.mapel.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mata Pelajaran</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_mapel">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
