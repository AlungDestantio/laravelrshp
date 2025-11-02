<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;

// Halaman umum
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/struktur-organisasi', [PageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');

// Halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

// akses administrator
Route::middleware('isAdmin')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
    Route::post('/admin/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');
    Route::get('/admin/jenis-hewan/{id}/edit', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('admin.jenis-hewan.edit');
    Route::put('/admin/jenis-hewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('admin.jenis-hewan.update');
    Route::delete('/admin/jenis-hewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('admin.jenis-hewan.destroy');   



    Route::get('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
    Route::post('/admin/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('admin.ras-hewan.store');
    Route::get('/admin/ras-hewan/{id}/edit', [App\Http\Controllers\Admin\RasHewanController::class, 'edit'])->name('admin.ras-hewan.edit');
    Route::put('/admin/ras-hewan/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'update'])->name('admin.ras-hewan.update');
    Route::delete('/admin/ras-hewan/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'destroy'])->name('admin.ras-hewan.destroy');


    Route::get('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/admin/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{id}/edit', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('admin.kategori.destroy');


    Route::get('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
    Route::post('/admin/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');
    Route::get('/admin/kategori-klinis/{id}/edit', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'edit'])->name('admin.kategori-klinis.edit');
    Route::put('/admin/kategori-klinis/{id}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'update'])->name('admin.kategori-klinis.update');
    Route::delete('/admin/kategori-klinis/{id}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'destroy'])->name('admin.kategori-klinis.destroy');


    Route::get('/admin/kode-tindakan', [App\Http\Controllers\Admin\KodeTindakanController::class, 'index'])->name('admin.kode-tindakan.index');
    Route::post('/admin/kode-tindakan', [App\Http\Controllers\Admin\KodeTindakanController::class, 'store'])->name('admin.kode-tindakan.store');
    Route::get('/admin/kode-tindakan/{id}/edit', [App\Http\Controllers\Admin\KodeTindakanController::class, 'edit'])->name('admin.kode-tindakan.edit');
    Route::put('/admin/kode-tindakan/{id}', [App\Http\Controllers\Admin\KodeTindakanController::class, 'update'])->name('admin.kode-tindakan.update');
    Route::delete('/admin/kode-tindakan/{id}', [App\Http\Controllers\Admin\KodeTindakanController::class, 'destroy'])->name('admin.kode-tindakan.destroy');


    Route::get('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('admin.pet.index');
    Route::post('/admin/pet', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('admin.pet.store');
    Route::get('/admin/pet/{id}/edit', [App\Http\Controllers\Admin\PetController::class, 'edit'])->name('admin.pet.edit');
    Route::put('/admin/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'update'])->name('admin.pet.update');
    Route::delete('/admin/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'destroy'])->name('admin.pet.destroy');


    Route::get('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.role.index');
    Route::post('/admin/role', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.role.store');
    Route::get('/admin/role/{id}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.role.edit');
    Route::put('/admin/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.role.update');
    Route::delete('/admin/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('admin.role.destroy');


    Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.destroy');
});

// akses Resepsionis
Route::middleware('isResepsionis')->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\resepsionis\ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard');

    Route::get('/resepsionis/registrasi-pemilik', [App\Http\Controllers\resepsionis\PemilikController::class, 'index'])->name('resepsionis.registrasi-pemilik.index');
    Route::post('/resepsionis/registrasi-pemilik', [App\Http\Controllers\resepsionis\PemilikController::class, 'store'])->name('resepsionis.registrasi-pemilik.store');

    Route::get('/resepsionis/registrasi-pet', [App\Http\Controllers\resepsionis\PetController::class, 'index'])->name('resepsionis.registrasi-pet.index');
    Route::post('/resepsionis/registrasi-pet', [App\Http\Controllers\resepsionis\PetController::class, 'store'])->name('resepsionis.registrasi-pet.store');

    Route::get('/resepsionis/temu-dokter', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'index'])->name('resepsionis.temu-dokter.index');
    Route::post('/resepsionis/temu-dokter', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'store'])->name('resepsionis.temu-dokter.store');
    Route::put('/resepsionis/temu-dokter/{id}', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'updateStatus'])->name('resepsionis.temu-dokter.updateStatus');
});

// akses perawat
Route::middleware('isPerawat')->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\Perawat\PerawatDashboardController::class, 'index'])->name('perawat.dashboard');

    Route::get('/perawat/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'index'])->name('perawat.rekam-medis.index');
    Route::post('/perawat/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'store'])->name('perawat.rekam-medis.store');
    Route::get('/perawat/rekam-medis/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'show'])->name('perawat.rekam-medis.show');

    Route::post('/perawat/rekam-medis/{id}/tindakan', [App\Http\Controllers\Perawat\TindakanController::class, 'store'])->name('perawat.rekam-medis.tindakan.store');
    Route::get('/perawat/rekam-medis/tindakan/{id}/edit', [App\Http\Controllers\Perawat\TindakanController::class, 'edit'])->name('perawat.rekam-medis.tindakan.edit');
    Route::put('/perawat/rekam-medis/tindakan/{id}', [App\Http\Controllers\Perawat\TindakanController::class, 'update'])->name('perawat.rekam-medis.tindakan.update');
    Route::delete('/perawat/rekam-medis/tindakan/{id}', [App\Http\Controllers\Perawat\TindakanController::class, 'destroy'])->name('perawat.rekam-medis.tindakan.destroy');
});

// akses dokter
Route::middleware('isDokter')->group(function () {
    Route::get('/dokter/dashboard', [App\Http\Controllers\Dokter\DokterDashboardController::class, 'index'])->name('dokter.dashboard');

    Route::get('/dokter/rekam-medis', [App\Http\Controllers\Dokter\RekamMedisController::class, 'index'])->name('dokter.rekam-medis.index');
    Route::get('/dokter/rekam-medis/{id}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'show'])->name('dokter.rekam-medis.show');
});

// akses pemilik
Route::middleware('isPemilik')->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\Pemilik\PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');

    Route::get('/pemilik/pet', [App\Http\Controllers\Pemilik\PetController::class, 'index'])->name('pemilik.pet.index');

    Route::get('/pemilik/reservasi', [App\Http\Controllers\Pemilik\ReservasiController::class, 'index'])->name('pemilik.reservasi.index');

    Route::get('/pemilik/rekam-medis', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'index'])->name('pemilik.rekam-medis.index');
    Route::get('/pemilik/rekam-medis/{id}', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'show'])->name('pemilik.rekam-medis.show');
});