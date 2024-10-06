@extends('layout.app')
@section('konten')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard Admin</h1>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Siswa</h5>
                            <p class="card-text">{{ $totalSiswa }} Siswa</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Guru</h5>
                            <p class="card-text">{{ $totalGuru }} Guru</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Mata Pelajaran</h5>
                            <p class="card-text">{{ $totalMataPelajaran }} Pelajaran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
