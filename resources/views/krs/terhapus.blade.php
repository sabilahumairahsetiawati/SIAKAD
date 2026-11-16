@extends('layouts.app')

@section('title', 'KRS Terhapus')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>KRS Terhapus</h3>
            <p class="text-muted">
                Daftar data KRS yang telah dihapus dan dapat dipulihkan.
            </p>
        </div>

        <a href="{{ route('krs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar KRS Terhapus
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tahun Akademik</th>
                            <th>Semester</th>
                            <th>Total SKS</th>
                            <th>Tanggal Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($krs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                                <td>{{ $item->tahun_akademik }}</td>
                                <td>{{ $item->semester }}</td>
                                <td>{{ $item->mataKuliah->sum('sks') }}</td>
                                <td>{{ $item->deleted_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('krs.restore', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Pulihkan data KRS ini?')">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Restore
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada data KRS yang dihapus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
