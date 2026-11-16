@extends('layouts.app')

@section('title', 'Edit KRS')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h3>Edit Kartu Rencana Studi</h3>
        <p class="text-muted">
            Perbarui informasi KRS mahasiswa.
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <form action="{{ route('krs.update', $krs->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                                {{ old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id ? 'selected' : '' }}>
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
                        value="{{ old('tahun_akademik', $krs->tahun_akademik) }}"
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

                        <option value="Ganjil"
                            {{ old('semester', $krs->semester) == 'Ganjil' ? 'selected' : '' }}>
                            Ganjil
                        </option>

                        <option value="Genap"
                            {{ old('semester', $krs->semester) == 'Genap' ? 'selected' : '' }}>
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

                        @foreach (['draft', 'diajukan', 'disetujui', 'ditolak'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $krs->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
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
                                    {{ in_array(
                                        $mk->id,
                                        old('mata_kuliah_ids', $krs->mataKuliah->pluck('id')->toArray())
                                    ) ? 'checked' : '' }}>

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
                        Simpan Perubahan
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
