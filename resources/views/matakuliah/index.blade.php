@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Data Mata Kuliah</h3>
                <p class="text-muted mb-0">
                    Kelola data mata kuliah SIAKAD.
                </p>
            </div>

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Mata Kuliah
                </a>
            @endif
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-body fw-semibold">
                Daftar Mata Kuliah
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabel-matakuliah" class="table table-striped table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}">
@endpush



@push('scripts')

    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            const tabel = $('#tabel-matakuliah').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('matakuliah.data') }}",
                    type: "GET"
                },

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'kode_mk', name: 'kode_mk' },
                    { data: 'nama_mk', name: 'nama_mk' },
                    { data: 'sks', name: 'sks' },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        className: 'text-nowrap text-center',
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {
                    processing: 'Memuat data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
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

            // FUNGSI HAPUS MATA KULIAH
            $(document).on('click', '.btn-hapus-matakuliah', function () {

                const url = this.dataset.url;
                const nama = this.dataset.nama;

                Swal.fire({
                    title: 'Hapus mata kuliah?',
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
                            text: response.message || 'Mata kuliah berhasil dihapus.',
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }).fail(function (xhr) {

                        const pesan =
                            (xhr.responseJSON && xhr.responseJSON.message)
                            || 'Mata kuliah tidak dapat dihapus.';

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

