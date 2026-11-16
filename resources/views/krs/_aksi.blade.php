<div class="d-flex gap-1">

    <a href="{{ route('krs.show', $krs->id) }}"
        class="btn btn-sm btn-info text-white">
        Detail
    </a>

    @if (Auth::user()->role === 'admin')

        <a href="{{ route('krs.edit', $krs->id) }}"
            class="btn btn-sm btn-warning">
            Edit
        </a>

        <button type="button"
            class="btn btn-sm btn-danger btn-hapus-krs"
            data-url="{{ route('krs.destroy', $krs->id) }}"
            data-nama="{{ $krs->mahasiswa->nama ?? 'Mahasiswa' }}">
            Hapus
        </button>

    @endif

</div>
