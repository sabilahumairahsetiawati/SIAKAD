@extends('layouts.app')

@section('title', 'Data KRS')

@section('content')
    <x-page-header judul="Kartu Rencana Studi (KRS)"
        deskripsi="Daftar KRS mahasiswa (data contoh)." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar KRS</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$krs" />
        </div>
    </div>
@endsection