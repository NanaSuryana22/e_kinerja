<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses tanpa login - jika perlu)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Redirect::route('login');
});

// Route Login & Logout (Nanti dibuat di AuthController)
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (Harus Login Dulu)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama (Bisa diakses semua yang sudah login)
    Route::resource('halaman_utama', 'HalamanUtamaController');

    /*
    |--- KHUSUS ROLE: ADMIN (ATASAN) ---
    | Bisa kelola Master Data (Pegawai, Jabatan, Tugas) dan Menilai Kinerja
    |-----------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('pegawai', 'PegawaiController');
        Route::resource('jabatan', 'JabatanController');
        Route::resource('tugas_jabatan', 'TugasJabatanController');
        
        // Admin hanya boleh Update (Penilaian) dan Delete di Laporan Kinerja
        Route::delete('/laporan_kinerja/{id}', 'KinerjaController@destroy')->name('laporan_kinerja.destroy');
        Route::get('/laporan_kinerja/{id}/edit', 'KinerjaController@edit')->name('laporan_kinerja.edit');
        Route::put('/laporan_kinerja/{id}', 'KinerjaController@update')->name('laporan_kinerja.update');
    });

    /*
    |--- KHUSUS ROLE: PEGAWAI ---
    | Hanya bisa membuat laporan kinerjanya sendiri
    |----------------------------
    */
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/laporan_kinerja/create', 'KinerjaController@create')->name('laporan_kinerja.create');
        Route::post('/laporan_kinerja', 'KinerjaController@store')->name('laporan_kinerja.store');
    });

    /*
    |--- AKSES BERSAMA (ADMIN & PEGAWAI) ---
    | Keduanya boleh melihat daftar laporan dan detailnya
    |---------------------------------------
    */
    Route::get('/laporan_kinerja', 'KinerjaController@index')->name('laporan_kinerja.index');
    Route::get('/laporan_kinerja/{id}', 'KinerjaController@show')->name('laporan_kinerja.show');

});