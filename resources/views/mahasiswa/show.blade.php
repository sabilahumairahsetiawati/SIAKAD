@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container-fluid py-4">

    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap data mahasiswa." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Informasi Mahasiswa
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">NIM</div>
                <div class="col-md-9 fw-semibold">
                    {{ $mahasiswa->nim }}
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Nama Lengkap</div>
                <div class="col-md-9 fw-semibold">
                    {{ $mahasiswa->nama }}
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Jenis Kelamin</div>
                <div class="col-md-9">
                    @if ($mahasiswa->jenis_kelamin === 'L')
                        Laki-laki
                    @elseif ($mahasiswa->jenis_kelamin === 'P')
                        Perempuan
                    @else
                        Belum diisi
                    @endif
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Email</div>
                <div class="col-md-9">
                    {{ $mahasiswa->email ?? 'Belum diisi' }}
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Angkatan</div>
                <div class="col-md-9">
                    {{ $mahasiswa->angkatan }}
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 text-secondary">Program Studi</div>
                <div class="col-md-9">
                    {{ $mahasiswa->program_studi }}
                </div>
            </div>

        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}"
                class="btn btn-warning">
                <i class="bi bi-pencil-square"></i>
                Edit Mahasiswa
            </a>
        @endif
    </div>

</div>
@endsection
