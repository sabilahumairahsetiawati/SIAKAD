<div class="row">

    <div class="col-md-6 mb-3">
        <label for="kode_mk" class="form-label">
            Kode Mata Kuliah
        </label>

        <input type="text"
            name="kode_mk"
            id="kode_mk"
            class="form-control @error('kode_mk') is-invalid @enderror"
            value="{{ old('kode_mk', $mataKuliah->kode_mk) }}"
            maxlength="10"
            placeholder="Contoh: TI101"
            required>

        @error('kode_mk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="nama_mk" class="form-label">
            Nama Mata Kuliah
        </label>

        <input type="text"
            name="nama_mk"
            id="nama_mk"
            class="form-control @error('nama_mk') is-invalid @enderror"
            value="{{ old('nama_mk', $mataKuliah->nama_mk) }}"
            maxlength="100"
            placeholder="Masukkan nama mata kuliah"
            required>

        @error('nama_mk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="sks" class="form-label">
            Jumlah SKS
        </label>

        <select name="sks"
            id="sks"
            class="form-select @error('sks') is-invalid @enderror"
            required>

            <option value="">-- Pilih SKS --</option>

            @for ($i = 1; $i <= 6; $i++)
                <option value="{{ $i }}"
                    {{ old('sks', $mataKuliah->sks) == $i ? 'selected' : '' }}>
                    {{ $i }} SKS
                </option>
            @endfor

        </select>

        @error('sks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>
