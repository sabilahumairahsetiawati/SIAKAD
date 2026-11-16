
@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Data Pengguna</h3>
            <p class="text-muted">
                Kelola data pengguna SIAKAD.
            </p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Daftar Pengguna</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>

                            @foreach ($kolom as $field => $label)
                                <th>{{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengguna as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                @foreach ($kolom as $field => $label)
                                    <td>
                                        @if ($field === 'role')
                                            {{ ucfirst($item[$field]) }}
                                        @else
                                            {{ $item[$field] }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($kolom) + 1 }}"
                                    class="text-center">
                                    Belum ada data pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            <p class="text-muted mb-0">
                Jumlah pengguna: {{ count($pengguna) }}
            </p>
        </div>
    </div>

</div>
@endsection
