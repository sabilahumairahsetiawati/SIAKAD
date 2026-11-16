@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
    <div class="container-fluid py-4">

        <div class="mb-4">
            <h3>Detail Mata Kuliah</h3>
            <p class="text-muted mb-0">
                Informasi lengkap mata kuliah.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">
                Informasi Mata Kuliah
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold">Kode Mata Kuliah</div>
                    <div class="col-md-9">{{ $mataKuliah->kode_mk }}</div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold">Nama Mata Kuliah</div>
                    <div class="col-md-9">{{ $mataKuliah->nama_mk }}</div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-md-3 fw-semibold">Jumlah SKS</div>
                    <div class="col-md-9">{{ $mataKuliah->sks }} SKS</div>
                </div>

                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>
        </div>

    </div>
@endsection
