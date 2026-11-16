<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        return view('mahasiswa.index');
    }

    public function data(): JsonResponse
    {
        $query = Mahasiswa::query()->select([
            'id',
            'nim',
            'nama',
            'angkatan',
            'email',
            'program_studi',
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Mahasiswa $mahasiswa) {
                return view('mahasiswa._aksi', compact('mahasiswa'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('mahasiswa.create', [
            'mahasiswa' => new Mahasiswa(),
        ]);
    }

    
    
    public function store(Request $request): RedirectResponse
    {
        $mahasiswa = Mahasiswa::create($this->validated($request));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa ' . $mahasiswa->nama . ' berhasil ditambahkan.');
    }



    public function show(string $nim): View
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(string $nim): View
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, string $nim): RedirectResponse
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        $mahasiswa->update($this->validated($request, $mahasiswa));

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa ' . $mahasiswa->nama . ' berhasil diperbarui.');
    }

    public function destroy(string $nim): JsonResponse
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        if ($mahasiswa->krs()->exists()) {
            return response()->json([
                'message' => 'Mahasiswa tidak dapat dihapus karena masih memiliki data KRS.',
            ], 409);
        }

        $nama = $mahasiswa->nama;
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Data mahasiswa ' . $nama . ' berhasil dihapus.',
        ]);
    }

    private function validated(Request $request, ?Mahasiswa $mahasiswa = null): array
    {
        return $request->validate([
            'nim' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Mahasiswa::class, 'nim')->ignore($mahasiswa?->id),
            ],
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
            'jenis_kelamin' => [
                'nullable',
                Rule::in(['L', 'P']),
            ],
            'email' => [
                'nullable',
                'email',
                'max:100',
                Rule::unique(Mahasiswa::class, 'email')->ignore($mahasiswa?->id),
            ],
            'angkatan' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'program_studi' => [
                'required',
                'string',
                'max:100',
            ],
        ]);
    }
}
