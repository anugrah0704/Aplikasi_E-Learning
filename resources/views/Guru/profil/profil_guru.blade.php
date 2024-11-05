@extends('layout2.app')

@section('konten')
<div class="container mt-5">
    <h1 class="text-center mb-4">Profil Guru</h1>

    <div class="card shadow-sm p-4">
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
    </div>
</div>
@endsection
