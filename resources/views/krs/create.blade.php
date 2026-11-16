@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h3>Tambah Kartu Rencana Studi</h3>
        <p class="text-muted">
            Masukkan data KRS dan pilih mata kuliah mahasiswa.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('krs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">
                        Mahasiswa
                    </label>

                    <select name="mahasiswa_id" id="mahasiswa_id"
                        class="form-select @error('mahasiswa_id') is-invalid @enderror"
                        required>

                        <option value="">-- Pilih Mahasiswa --</option>

                        @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs->id }}"
                                {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nim }} - {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>

                    @error('mahasiswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun_akademik" class="form-label">
                        Tahun Akademik
                    </label>

                    <input type="text" name="tahun_akademik"
                        id="tahun_akademik"
                        class="form-control @error('tahun_akademik') is-invalid @enderror"
                        value="{{ old('tahun_akademik') }}"
                        placeholder="Contoh: 2026/2027"
                        maxlength="9" required>

                    @error('tahun_akademik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">
                        Semester
                    </label>

                    <select name="semester" id="semester"
                        class="form-select @error('semester') is-invalid @enderror"
                        required>

                        <option value="">-- Pilih Semester --</option>
                        <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>
                            Ganjil
                        </option>
                        <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>
                            Genap
                        </option>
                    </select>

                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">
                        Status KRS
                    </label>

                    <select name="status" id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required>

                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                        <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>
                            Diajukan
                        </option>
                        <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>
                            Disetujui
                        </option>
                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>
                            Ditolak
                        </option>
                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Pilih Mata Kuliah
                    </label>

                    <div class="border rounded p-3">
                        @foreach ($mataKuliah as $mk)
                            <div class="form-check mb-2">
                                <input class="form-check-input"
                                    type="checkbox"
                                    name="mata_kuliah_ids[]"
                                    value="{{ $mk->id }}"
                                    id="mk{{ $mk->id }}"
                                    {{ in_array($mk->id, old('mata_kuliah_ids', [])) ? 'checked' : '' }}>

                                <label class="form-check-label"
                                    for="mk{{ $mk->id }}">
                                    {{ $mk->kode_mk }} -
                                    {{ $mk->nama_mk }}
                                    ({{ $mk->sks }} SKS)
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('mata_kuliah_ids')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror

                    @error('mata_kuliah_ids.*')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan KRS
                    </button>

                    <a href="{{ route('krs.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
