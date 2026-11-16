<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosens = [
            [
                'nidn' => '9999999901',
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad@example.com',
                'telepon' => '081234567801',
                'alamat' => 'Pontianak',
            ],
            [
                'nidn' => '9999999902',
                'nama' => 'Siti Rahma',
                'email' => 'siti@example.com',
                'telepon' => '081234567802',
                'alamat' => 'Kubu Raya',
            ],
            [
                'nidn' => '9999999903',
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'telepon' => '081234567803',
                'alamat' => 'Mempawah',
            ],
            [
                'nidn' => '9999999904',
                'nama' => 'Dewi Anggraini',
                'email' => 'dewi@example.com',
                'telepon' => '081234567804',
                'alamat' => 'Singkawang',
            ],
            [
                'nidn' => '9999999905',
                'nama' => 'Rizky Pratama',
                'email' => 'rizky@example.com',
                'telepon' => '081234567805',
                'alamat' => 'Pontianak',
            ],
            [
                'nidn' => '9999999906',
                'nama' => 'Nurul Hidayah',
                'email' => 'nurul@example.com',
                'telepon' => '081234567806',
                'alamat' => 'Sambas',
            ],
            [
                'nidn' => '9999999907',
                'nama' => 'Andi Saputra',
                'email' => 'andi@example.com',
                'telepon' => '081234567807',
                'alamat' => 'Bengkayang',
            ],
            [
                'nidn' => '9999999908',
                'nama' => 'Putri Amelia',
                'email' => 'putri@example.com',
                'telepon' => '081234567808',
                'alamat' => 'Ketapang',
            ],
            [
                'nidn' => '9999999909',
                'nama' => 'Fajar Ramadhan',
                'email' => 'fajar@example.com',
                'telepon' => '081234567809',
                'alamat' => 'Pontianak',
            ],
        ];

        foreach ($dosens as $data) {
            Dosen::updateOrCreate(
                ['nidn' => $data['nidn']],
                $data
            );
        }
    }
}
