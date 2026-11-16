@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    <div class="container-fluid py-4">

        <div class="mb-4">
            <h3>Tambah Mata Kuliah</h3>
            <p class="text-muted mb-0">
                Masukkan informasi mata kuliah baru.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf

                    @include('matakuliah._form')

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan
                        </button>

                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
