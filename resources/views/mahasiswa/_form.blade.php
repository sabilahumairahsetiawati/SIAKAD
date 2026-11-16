@php
    $isEdit = isset($mahasiswa) && $mahasiswa->exists;
@endphp

<form action="{{ $isEdit
    ? route('mahasiswa.update', $mahasiswa->nim)
    : route('mahasiswa.store') }}"
    method="POST">

    @csrf

    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row g-3">

        <div class="col-md-4">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" id="nim" name="nim"
                class="form-control @error('nim') is-invalid @enderror"
                value="{{ old('nim', $mahasiswa->nim ?? '') }}"
                maxlength="255" required>
            @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-8">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama" name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $mahasiswa->nama ?? '') }}"
                maxlength="255" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $mahasiswa->email ?? '') }}"
                maxlength="100">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="number" id="angkatan" name="angkatan"
                class="form-control @error('angkatan') is-invalid @enderror"
                value="{{ old('angkatan', $mahasiswa->angkatan ?? '') }}"
                min="2000" max="2100" required>
            @error('angkatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin"
                class="form-select @error('jenis_kelamin') is-invalid @enderror"
                required>

                <option value="">-- Pilih --</option>

                <option value="L"
                    @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'L')>
                    Laki-laki
                </option>

                <option value="P"
                    @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'P')>
                    Perempuan
                </option>

            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="program_studi" class="form-label">Program Studi</label>
            <input type="text" id="program_studi" name="program_studi"
                class="form-control @error('program_studi') is-invalid @enderror"
                value="{{ old('program_studi', $mahasiswa->program_studi ?? 'D3 Teknik Informatika') }}"
                maxlength="100" required>
            @error('program_studi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="mt-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i>
            {{ $isEdit ? 'Perbarui Mahasiswa' : 'Simpan Mahasiswa' }}
        </button>

        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </div>

</form>
