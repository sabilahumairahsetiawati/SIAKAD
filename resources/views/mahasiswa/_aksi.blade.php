<div class="btn-group btn-group-sm" role="group">

    <a href="{{ route('mahasiswa.show', $mahasiswa->nim) }}"
        class="btn btn-info">
        Detail
    </a>

    @if (Auth::user()->role === 'admin')

        <a href="{{ route('mahasiswa.edit', $mahasiswa->nim) }}"
            class="btn btn-warning">
            Edit
        </a>

        <button type="button"
            class="btn btn-danger btn-hapus-mahasiswa"
            data-url="{{ route('mahasiswa.destroy', $mahasiswa->nim) }}"
            data-nama="{{ $mahasiswa->nama }}">
            Hapus
        </button>

    @endif

</div>
