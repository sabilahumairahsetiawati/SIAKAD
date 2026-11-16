@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container-fluid py-4">

    <x-page-header
        judul="Data Mahasiswa"
        deskripsi="Kelola data mahasiswa SIAKAD.">

        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Tambah Mahasiswa
        </a>

    </x-page-header>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar Mahasiswa
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-mahasiswa"
                    class="table table-hover table-striped align-middle w-100">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Angkatan</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection


@section('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet">
@endsection

@push('scripts')

    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            const tabel = $('#tabel-mahasiswa').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('mahasiswa.data') }}",
                    type: "GET"
                },

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'nim', name: 'nim' },
                    { data: 'nama', name: 'nama' },
                    { data: 'angkatan', name: 'angkatan' },
                    {
                        data: 'email',
                        name: 'email',
                        defaultContent: '-'
                    },
                    { data: 'program_studi', name: 'program_studi' },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-nowrap text-center',
                        orderable: false,
                        searchable: false
                    }
                ],

                order: [[2, 'asc']],

                language: {
                    processing: 'Memuat data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ data)',
                    zeroRecords: 'Data tidak ditemukan',
                    paginate: {
                        first: 'Awal',
                        last: 'Akhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }
            });

            const csrfToken = @json(csrf_token());

            $(document).on('click', '.btn-hapus-mahasiswa', function () {

                const url = this.dataset.url;
                const nama = this.dataset.nama;

                Swal.fire({
                    title: 'Hapus data mahasiswa?',
                    text: 'Data ' + nama + ' akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d'
                }).then(function (hasil) {

                    if (!hasil.isConfirmed) {
                        return;
                    }

                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    }).done(function (response) {

                        tabel.ajax.reload(null, false);

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message || 'Data mahasiswa berhasil dihapus.',
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }).fail(function (xhr) {

                        const pesan =
                            (xhr.responseJSON && xhr.responseJSON.message)
                            || 'Data tidak dapat dihapus.';

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal (' + xhr.status + ')',
                            text: pesan
                        });

                    });

                });

            });

        });
    </script>

@endpush

