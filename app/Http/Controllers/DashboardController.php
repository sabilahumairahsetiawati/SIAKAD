<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => 1250,
                'ikon' => 'bi-people-fill',
                'warna' => 'primary',
            ],
            [
                'judul' => 'Dosen',
                'jumlah' => 85,
                'ikon' => 'bi-person-badge-fill',
                'warna' => 'success',
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => 42,
                'ikon' => 'bi-book-fill',
                'warna' => 'warning',
            ],
            [
                'judul' => 'KRS Aktif',
                'jumlah' => 1120,
                'ikon' => 'bi-journal-check',
                'warna' => 'danger',
            ],
        ];

        $kolomKrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'semester' => 'Semester',
            'status' => 'Status',
        ];

        $krsTerbaru = [
            [
                'nim' => '3202201001',
                'nama' => 'Andi Pratama',
                'semester' => '4',
                'status' => 'Disetujui',
            ],
            [
                'nim' => '3202201002',
                'nama' => 'Siti Aminah',
                'semester' => '4',
                'status' => 'Menunggu',
            ],
            [
                'nim' => '3202201003',
                'nama' => 'Budi Santoso',
                'semester' => '6',
                'status' => 'Ditolak',
            ],
        ];

        $statusKrs = [
            [
                'label' => 'Disetujui',
                'persen' => 75,
                'warna' => 'success',
            ],
            [
                'label' => 'Menunggu',
                'persen' => 20,
                'warna' => 'warning',
            ],
            [
                'label' => 'Ditolak',
                'persen' => 5,
                'warna' => 'danger',
            ],
        ];

        return view('dashboard', compact('statistik', 'kolomKrs', 'krsTerbaru', 'statusKrs'));
    }
}