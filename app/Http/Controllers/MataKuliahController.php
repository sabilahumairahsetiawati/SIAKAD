<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        $query = MataKuliah::query()->select([
            'id',
            'kode_mk',
            'nama_mk',
            'sks',
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $mataKuliah) {
                return view('matakuliah._aksi', compact('mataKuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', [
            'mataKuliah' => new MataKuliah(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mataKuliah = MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Mata kuliah ' . $mataKuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah): View
    {
        return view('matakuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        return view('matakuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->update($this->validated($request, $mataKuliah));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): JsonResponse
    {
        try {
            $mataKuliah->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Mata kuliah tidak dapat dihapus karena masih digunakan dalam KRS.',
            ], 409);
        }

        return response()->json([
            'message' => 'Mata kuliah berhasil dihapus.',
        ]);
    }

   
    private function validated(Request $request, ?MataKuliah $mataKuliah = null): array
    {
        return $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mata_kuliah', 'kode_mk')->ignore($mataKuliah?->id),
            ],
            'nama_mk' => [
                'required',
                'string',
                'max:100',
            ],
            'sks' => [
                'required',
                'integer',
                'min:1',
                'max:6',
            ],
        ], [
            'kode_mk.required' => 'Kode Mata Kuliah wajib diisi.',
            'kode_mk.unique' => 'Kode Mata Kuliah sudah digunakan.',
            'kode_mk.max' => 'Kode Mata Kuliah maksimal 10 karakter.',

            'nama_mk.required' => 'Nama Mata Kuliah wajib diisi.',
            'nama_mk.max' => 'Nama Mata Kuliah maksimal 100 karakter.',

            'sks.required' => 'Jumlah SKS wajib dipilih.',
            'sks.integer' => 'Jumlah SKS harus berupa angka.',
            'sks.min' => 'Jumlah SKS minimal 1.',
            'sks.max' => 'Jumlah SKS maksimal 6.',
        ]);
    }
}
