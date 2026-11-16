<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;


// ==========================================
// HALAMAN UNTUK TAMU (BELUM LOGIN)
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.attempt');

});


// ==========================================
// HALAMAN INTERNAL (HARUS LOGIN)
// ==========================================

Route::middleware('auth')->group(function () {

    // Halaman awal
    Route::get('/', fn () => redirect()->route('dashboard'));

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // ==========================================
    // DATA MAHASISWA
    // ==========================================

    
    // ROUTE MAHASISWA
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])
        ->name('mahasiswa.data');

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
        ->name('mahasiswa.index');

    Route::get('/mahasiswa/{nim}', [MahasiswaController::class, 'show'])
        ->where('nim', '[0-9]+')
        ->name('mahasiswa.show');

    // ROUTE KHUSUS ADMIN UNTUK CRUD MAHASISWA
    Route::middleware('role:admin')->group(function () {
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])
            ->name('mahasiswa.create');

        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])
            ->name('mahasiswa.store');

        Route::get('/mahasiswa/{nim}/edit', [MahasiswaController::class, 'edit'])
            ->where('nim', '[0-9]+')
            ->name('mahasiswa.edit');

        Route::put('/mahasiswa/{nim}', [MahasiswaController::class, 'update'])
            ->where('nim', '[0-9]+')
            ->name('mahasiswa.update');

        Route::delete('/mahasiswa/{nim}', [MahasiswaController::class, 'destroy'])
            ->where('nim', '[0-9]+')
            ->name('mahasiswa.destroy');
    });



    // ==========================================
    // DATA DOSEN (JOBSHEET 11)
    // ==========================================

    // Endpoint JSON DataTables
    Route::get('/dosen/data', [DosenController::class, 'data'])
        ->name('dosen.data');

    // Tambah, simpan, edit, update, hapus
    // Khusus admin
    Route::middleware('role:admin')->group(function () {

        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);

    });

    // Daftar dan detail dosen
    // Semua pengguna yang sudah login
    Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);


    
    // ROUTE MATA KULIAH

    Route::get('/mata-kuliah/data', [MataKuliahController::class, 'data'])
        ->name('matakuliah.data');

    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])
        ->name('matakuliah.index');

    // ROUTE KHUSUS ADMIN UNTUK CRUD MATA KULIAH
    Route::middleware('role:admin')->group(function () {

        Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])
            ->name('matakuliah.create');

        Route::post('/mata-kuliah', [MataKuliahController::class, 'store'])
            ->name('matakuliah.store');

        Route::get('/mata-kuliah/{mataKuliah}', [MataKuliahController::class, 'show'])
            ->name('matakuliah.show');

        Route::get('/mata-kuliah/{mataKuliah}/edit', [MataKuliahController::class, 'edit'])
            ->name('matakuliah.edit');

        Route::put('/mata-kuliah/{mataKuliah}', [MataKuliahController::class, 'update'])
            ->name('matakuliah.update');

        Route::delete('/mata-kuliah/{mataKuliah}', [MataKuliahController::class, 'destroy'])
            ->name('matakuliah.destroy');

    });



    
    // ==========================================
    
    // DATA KRS

    Route::get('/krs/data', [KrsController::class, 'data'])
        ->name('krs.data');

    Route::get('/krs', [KrsController::class, 'index'])
        ->name('krs.index');
    // FITUR SOFT DELETE DAN RESTORE KRS
    Route::middleware('role:admin')->group(function () {
        Route::get('/krs/terhapus', [KrsController::class, 'trashed'])
            ->name('krs.trashed');

        Route::patch('/krs/{id}/restore', [KrsController::class, 'restore'])
            ->name('krs.restore');
    });
    

    // Route create harus diletakkan sebelum route {krs}
    Route::middleware('role:admin')->get('/krs/create', [KrsController::class, 'create'])
        ->name('krs.create');

    Route::get('/krs/{krs}', [KrsController::class, 'show'])
        ->name('krs.show');

    Route::middleware('role:admin')->group(function () {
        Route::post('/krs', [KrsController::class, 'store'])
            ->name('krs.store');

        Route::get('/krs/{krs}/edit', [KrsController::class, 'edit'])
            ->name('krs.edit');

        Route::put('/krs/{krs}', [KrsController::class, 'update'])
            ->name('krs.update');

        Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])
            ->name('krs.destroy');
    });




    // ==========================================
    // BERANDA
    // ==========================================

    Route::get('/beranda', [BerandaController::class, 'index'])
        ->name('beranda');


    // ==========================================
    // PENGGUNA (KHUSUS ADMIN)
    // ==========================================

    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');


    // ==========================================
    // LOGOUT
    // ==========================================

    

});
