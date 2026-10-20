<?php

namespace App\Http\Controllers;

class MataKuliahController extends Controller
{
    public function index()
    {
        $kolom = [
            'kode' => 'Kode',
            'nama' => 'Nama Mata Kuliah',
            'sks' => 'SKS',
            'semester' => 'Semester',
        ];

        $mataKuliah = [
            [
                'kode' => 'IF101',
                'nama' => 'Algoritma dan Pemrograman',
                'sks' => 3,
                'semester' => 1,
            ],
            [
                'kode' => 'IF102',
                'nama' => 'Basis Data',
                'sks' => 3,
                'semester' => 2,
            ],
            [
                'kode' => 'IF103',
                'nama' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 3,
            ],
        ];

        return view('matakuliah.index', compact('kolom', 'mataKuliah'));
    }
}