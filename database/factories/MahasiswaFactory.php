<?php
namespace Database\Factories;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition(): array
    {
        $jenisKelamin = fake()->randomElement(['L', 'P']);
        $angkatan = fake()->numberBetween(2022, 2025);
        $gender = $jenisKelamin === 'L' ? 'male' : 'female';
        $nama = fake()->firstName($gender) . ' ' . fake()->lastName();

        $nim = substr((string) $angkatan, -2)
            . '0303'
            . fake()->unique()->numerify('####');

        return [
            'nim'           => $nim,
            'nama'          => $nama,
            'jenis_kelamin' => $jenisKelamin,
            'email'         => $nim. '@mhs.example.com',
            'angkatan'      => $angkatan,
            'program_studi' => 'D3 Teknik Informatika',
        ];
    }
}
