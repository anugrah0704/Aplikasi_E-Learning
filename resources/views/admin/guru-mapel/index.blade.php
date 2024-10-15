@extends('layout.app')

@section('konten')
<div class="container">
    <h2>Daftar Guru Mapel</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addGuruMapelModal">Tambah Guru Mapel</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengajar</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guruMapels as $index => $guruMapel)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $guruMapel->user ? $guruMapel->user->username : 'Tidak Ada Guru' }}</td>
                <td>{{ $guruMapel->mapel ? $guruMapel->mapel->nama_mapel : 'Tidak Ada Mapel' }}</td>
                <td>{{ $guruMapel->kelas ? $guruMapel->kelas->nama_kelas : 'Tidak Ada Kelas' }}</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editGuruMapelModal{{ $guruMapel->id }}">Edit</button>
                    <form action="{{ route('admin.guru-mapel.destroy', $guruMapel->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Guru Mapel -->
            <div class="modal fade" id="editGuruMapelModal{{ $guruMapel->id }}" tabindex="-1" role="dialog" aria-labelledby="editGuruMapelModalLabel{{ $guruMapel->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGuruMapelModalLabel{{ $guruMapel->id }}">Edit Guru Mapel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.guru-mapel.update', $guruMapel->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="user_id">Pilih Guru</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">Pilih Guru</option>
                                        @foreach($guru as $g)
                                            <option value="{{ $g->id }}" {{ $g->id == $guruMapel->user_id ? 'selected' : '' }}>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="mapel_id">Pilih Mata Pelajaran</label>
                                    <select name="mapel_id" class="form-control" required>
                                        <option value="">Pilih Mata Pelajaran</option>
                                        @foreach($mapels as $mapel)
                                            <option value="{{ $mapel->id }}" {{ $mapel->id == $guruMapel->mapel_id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas_id">Pilih Kelas</label>
                                    <select name="kelas_id" class="form-control" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}" {{ $kelasItem->id == $guruMapel->kelas_id ? 'selected' : '' }}>{{ $kelasItem->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Guru Mapel -->
<div class="modal fade" id="addGuruMapelModal" tabindex="-1" role="dialog" aria-labelledby="addGuruMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuruMapelModalLabel">Tambah Guru Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.guru-mapel.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="user_id">Pilih Guru</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Pilih Guru</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}">{{ $g->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mapel_id">Pilih Mata Pelajaran</label>
                        <select name="mapel_id" id="mapel_id" class="form-control" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas_id">Pilih Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
