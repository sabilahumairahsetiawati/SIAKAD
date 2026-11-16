@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container-fluid py-4">

    <x-page-header
        judul="Tambah Mahasiswa"
        deskripsi="Masukkan data mahasiswa baru ke dalam sistem." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Form Tambah Mahasiswa
        </div>

        <div class="card-body">
            @include('mahasiswa._form')
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

</div>
@endsection
