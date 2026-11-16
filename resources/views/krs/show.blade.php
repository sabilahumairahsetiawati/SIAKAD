@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Detail Kartu Rencana Studi</h3>
            <p class="text-muted">
                Informasi KRS mahasiswa.
            </p>
        </div>

        <a href="{{ route('krs.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header fw-semibold">
            Informasi Mahasiswa
        </div>

        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="200">NIM</th>
                    <td>: {{ $krs->mahasiswa->nim ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>: {{ $krs->mahasiswa->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tahun Akademik</th>
                    <td>: {{ $krs->tahun_akademik }}</td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td>: {{ $krs->semester }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: {{ ucfirst($krs->status) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header fw-semibold">
            Daftar Mata Kuliah
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">
                                Total SKS
                            </th>
                            <th>{{ $krs->mataKuliah->sum('sks') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
