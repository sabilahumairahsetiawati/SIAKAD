@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Kartu Rencana Studi (KRS)</h3>
            <p class="text-muted">
                Kelola data KRS mahasiswa.
            </p>
        </div>

        @if (Auth::user()->role === 'admin')
            <div class="d-flex gap-2">
                <a href="{{ route('krs.trashed') }}" class="btn btn-outline-danger">
                    <i class="bi bi-trash"></i> KRS Terhapus
                </a>

                <a href="{{ route('krs.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah KRS
                </a>
            </div>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped"
                    id="tabel-krs" width="100%">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Total SKS</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<link rel="stylesheet"
    href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}">
@endpush


@push('scripts')

<script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
$(document).ready(function () {

    let tabel = $('#tabel-krs').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('krs.data') }}",

        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nim', name: 'mahasiswa.nim' },
            { data: 'nama_mahasiswa', name: 'mahasiswa.nama' },
            { data: 'tahun_akademik', name: 'tahun_akademik' },
            { data: 'semester', name: 'semester' },
            { data: 'total_sks', name: 'total_sks', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });

    // Konfirmasi hapus KRS
    $(document).on('click', '.btn-hapus-krs', function () {

        let url = $(this).data('url');
        let nama = $(this).data('nama');

        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: 'KRS milik ' + nama + ' akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (response) {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );

                        tabel.ajax.reload(null, false);
                    },

                    error: function (xhr) {
                        Swal.fire(
                            'Gagal!',
                            xhr.responseJSON?.message || 'Data KRS gagal dihapus.',
                            'error'
                        );
                    }
                });

            }

        });

    });

});
</script>

@endpush

