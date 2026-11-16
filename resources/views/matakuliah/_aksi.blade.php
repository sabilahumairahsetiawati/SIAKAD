
<div class="btn-group btn-group-sm" role="group">

    <a href="{{ route('matakuliah.show', $mataKuliah->id) }}"
        class="btn btn-info">
        Detail
    </a>

    @if (Auth::user()->role === 'admin')

        <a href="{{ route('matakuliah.edit', $mataKuliah->id) }}"
            class="btn btn-warning">
            Edit
        </a>

        <button type="button"
            class="btn btn-danger btn-hapus-matakuliah"
            data-url="{{ route('matakuliah.destroy', $mataKuliah->id) }}"
            data-nama="{{ $mataKuliah->nama_mk }}">
            Hapus
        </button>

    @endif

</div>
