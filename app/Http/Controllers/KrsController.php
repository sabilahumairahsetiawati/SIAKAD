<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    // Menampilkan daftar KRS
    public function index()
    {
        return view('krs.index');
    }

    // Mengambil data KRS untuk DataTables
    public function data()
    {
        $query = Krs::with(['mahasiswa', 'mataKuliah'])
            ->select('krs.*');

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('nim', function ($krs) {
                return $krs->mahasiswa->nim ?? '-';
            })

            ->addColumn('nama_mahasiswa', function ($krs) {
                return $krs->mahasiswa->nama ?? '-';
            })

            ->addColumn('total_sks', function ($krs) {
                return $krs->mataKuliah->sum('sks');
            })

            ->addColumn('aksi', function ($krs) {
                return view('krs._aksi', compact('krs'))->render();
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form tambah KRS
    public function create()
    {
        $mahasiswa = Mahasiswa::orderBy('nim')->get();
        $mataKuliah = MataKuliah::orderBy('kode_mk')->get();

        return view('krs.create', compact(
            'mahasiswa',
            'mataKuliah'
        ));
    }

    // Menyimpan KRS baru
    public function store(Request $request)
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $krs = Krs::create([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            $krs->mataKuliah()->sync(
                $validated['mata_kuliah_ids']
            );
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    // Menampilkan detail KRS
    public function show(Krs $krs)
    {
        $krs->load(['mahasiswa', 'mataKuliah']);

        return view('krs.show', compact('krs'));
    }

    // Menampilkan form edit KRS
    public function edit(Krs $krs)
    {
        $krs->load('mataKuliah');

        $mahasiswa = Mahasiswa::orderBy('nim')->get();
        $mataKuliah = MataKuliah::orderBy('kode_mk')->get();

        return view('krs.edit', compact(
            'krs',
            'mahasiswa',
            'mataKuliah'
        ));
    }

    // Memperbarui KRS
    public function update(Request $request, Krs $krs)
    {
        $validated = $this->validated($request, $krs);

        DB::transaction(function () use ($validated, $krs) {
            $krs->update([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            $krs->mataKuliah()->sync(
                $validated['mata_kuliah_ids']
            );
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    // Menghapus KRS
    public function destroy(Krs $krs)
    {
        $krs->delete();

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.'
        ]);
    }
    
    // Menampilkan daftar KRS yang sudah dihapus
    public function trashed()
    {
        $krs = Krs::onlyTrashed()
            ->with(['mahasiswa', 'mataKuliah'])
            ->latest('deleted_at')
            ->get();

        return view('krs.terhapus', compact('krs'));
    }

    // Memulihkan KRS yang sudah dihapus
    public function restore($id)
    {
        $krs = Krs::onlyTrashed()->findOrFail($id);

        $krs->restore();

        return redirect()
            ->route('krs.trashed')
            ->with('success', 'Data KRS berhasil dipulihkan.');
    }

    // Validasi data KRS
   
    private function validated(Request $request, ?Krs $krs = null)
    {
        $uniqueKrs = Rule::unique('krs', 'mahasiswa_id')
            ->where(function ($query) use ($request) {
                return $query
                    ->where('tahun_akademik', $request->tahun_akademik)
                    ->where('semester', $request->semester);
            });

        // Saat edit, abaikan data KRS yang sedang diperbarui
        if ($krs) {
            $uniqueKrs->ignore($krs->id);
        }

         $uniqueKrs = Rule::unique('krs', 'mahasiswa_id')
        ->where(function ($query) use ($request) {
            return $query
                ->where('tahun_akademik', $request->tahun_akademik)
                ->where('semester', $request->semester);
        });

        // Saat edit, abaikan data KRS yang sedang diperbarui
        if ($krs) {
            $uniqueKrs->ignore($krs->id);
        }

        $validated = $request->validate([
            'mahasiswa_id' => [
                'required',
                'integer',
                'exists:mahasiswa,id',
                $uniqueKrs,
            ],

            'tahun_akademik' => [
                'required',
                'string',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'required',
                Rule::in(['Ganjil', 'Genap']),
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'diajukan',
                    'disetujui',
                    'ditolak',
                ]),
            ],

            'mata_kuliah_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'mata_kuliah_ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:mata_kuliah,id',
            ],
        ], [
            'mahasiswa_id.unique' =>
                'Mahasiswa sudah memiliki KRS untuk tahun akademik dan semester tersebut.',

            'tahun_akademik.regex' =>
                'Format tahun akademik harus seperti 2026/2027.',
        ]);

        // Hitung total SKS dari mata kuliah yang dipilih
        $totalSks = MataKuliah::whereIn(
            'id',
            $validated['mata_kuliah_ids']
        )->sum('sks');

        // Batasi maksimal 24 SKS
        if ($totalSks > 24) {
            throw ValidationException::withMessages([
                'mata_kuliah_ids' =>
                    'Total SKS tidak boleh melebihi 24 SKS. Total pilihan saat ini: '
                    . $totalSks . ' SKS.',
            ]);
        }

        return $validated;
    }
}

