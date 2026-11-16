@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
    <div class="container-fluid py-4">

        <div class="mb-4">
            <h3>Edit Mata Kuliah</h3>
            <p class="text-muted mb-0">
                Perbarui informasi mata kuliah.
            </p>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('matakuliah.update', $mataKuliah->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('matakuliah._form')

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan Perubahan
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
