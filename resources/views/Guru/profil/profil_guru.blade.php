@extends('layout2.app')

@section('konten')
<div class="container mt-5">
    <h1 class="text-center mb-4">Profil Guru</h1>

    <!-- Pesan Error untuk Validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <!-- Pesan Notifikasi -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card shadow-sm p-4">
        <div class="text-center mb-4">
            <img src="{{ $guruData->foto ? asset('images/profil_guru/' . $guruData->foto) : asset('images/default.png') }}"
                 alt="Foto Profil Guru"
                 class="rounded-circle"
                 width="150"
                 height="150">
        </div>

        <!-- Informasi Profil -->
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Nama</div>
            <div class="col-md-8">: {{ $guruData->nama }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">NIP</div>
            <div class="col-md-8">: {{ $guruData->nip }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Email</div>
            <div class="col-md-8">: {{ $guruData->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Alamat</div>
            <div class="col-md-8">: {{ $guruData->alamat }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Tanggal Lahir</div>
            <div class="col-md-8">: {{ $guruData->tgl_lahir }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Telepon</div>
            <div class="col-md-8">: {{ $guruData->telepon }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Jenis Kelamin</div>
            <div class="col-md-8">: {{ $guruData->gender }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 font-weight-bold">Jabatan</div>
            <div class="col-md-8">: {{ $guruData->jabatan }}</div>
        </div>
        <!-- Tombol untuk membuka modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
            Edit Profil
        </button>
    </div>
</div>


<!-- Modal untuk Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guru.profil.updateProfilGuru', ['id' => $guruData->user_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $guruData->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $guruData->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $guruData->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $guruData->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $guruData->tgl_lahir }}" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $guruData->telepon }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="Laki-laki" {{ $guruData->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $guruData->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $guruData->jabatan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Profil</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                        @if($guruData->foto)
                            <img src="{{ asset('images/profil_guru/' . $guruData->foto) }}" alt="Foto Profil" class="mt-2" width="100">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
