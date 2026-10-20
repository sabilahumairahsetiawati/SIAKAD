<?php

namespace App\Http\Controllers;

class DosenController extends Controller
{
    public function index()
    {
		$kolom = [
			'nidn' => 'NIDN',
			'nama' => 'Nama Dosen',
			'email' => 'Email',
			'bidang' => 'Bidang',
		];

        $dosen = [
            [
                'nidn' => '0012345678',
                'nama' => 'Budi Santoso',
                'email' => 'budi@polnep.ac.id',
                'bidang' => 'Pemrograman',
            ],
            [
                'nidn' => '0012345679',
                'nama' => 'Siti Aminah',
                'email' => 'siti@polnep.ac.id',
                'bidang' => 'Basis Data',
            ],
            [
                'nidn' => '0012345680',
                'nama' => 'Andi Wijaya',
                'email' => 'andi@polnep.ac.id',
                'bidang' => 'Jaringan Komputer',
            ],
        ];

        return view('dosen.index', compact('kolom', 'dosen'));
    }
}