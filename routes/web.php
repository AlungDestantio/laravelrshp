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
Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::get('/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::post('/jenis-hewan', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/jenis-hewan/{id}/edit', [App\Http\Controllers\Admin\JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('/jenis-hewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('/jenis-hewan/{id}', [App\Http\Controllers\Admin\JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');   



    Route::get('/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::get('/ras-hewan/create', [App\Http\Controllers\Admin\RasHewanController::class, 'create'])->name('ras-hewan.create');
    Route::post('/ras-hewan', [App\Http\Controllers\Admin\RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::get('/ras-hewan/{id}/edit', [App\Http\Controllers\Admin\RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('/ras-hewan/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'update'])->name('ras-hewan.update');
    Route::delete('/ras-hewan/{id}', [App\Http\Controllers\Admin\RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');


    Route::get('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [App\Http\Controllers\Admin\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [App\Http\Controllers\Admin\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');


    Route::get('/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::get('/kategori-klinis/create', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    Route::post('/kategori-klinis', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('/kategori-klinis/{id}/edit', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('/kategori-klinis/{id}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::delete('/kategori-klinis/{id}', [App\Http\Controllers\Admin\KategoriKlinisController::class, 'destroy'])->name('kategori-klinis.destroy');


    Route::get('/kode-tindakan', [App\Http\Controllers\Admin\KodeTindakanController::class, 'index'])->name('kode-tindakan.index');
    Route::get('/kode-tindakan/create', [App\Http\Controllers\Admin\KodeTindakanController::class, 'create'])->name('kode-tindakan.create');
    Route::post('/kode-tindakan', [App\Http\Controllers\Admin\KodeTindakanController::class, 'store'])->name('kode-tindakan.store');
    Route::get('/kode-tindakan/{id}/edit', [App\Http\Controllers\Admin\KodeTindakanController::class, 'edit'])->name('kode-tindakan.edit');
    Route::put('/kode-tindakan/{id}', [App\Http\Controllers\Admin\KodeTindakanController::class, 'update'])->name('kode-tindakan.update');
    Route::delete('/kode-tindakan/{id}', [App\Http\Controllers\Admin\KodeTindakanController::class, 'destroy'])->name('kode-tindakan.destroy');


    Route::get('/pet', [App\Http\Controllers\Admin\PetController::class, 'index'])->name('pet.index');
    Route::get('/pet/create', [App\Http\Controllers\Admin\PetController::class, 'create'])->name('pet.create');
    Route::post('/pet', [App\Http\Controllers\Admin\PetController::class, 'store'])->name('pet.store');
    Route::get('/pet/{id}/edit', [App\Http\Controllers\Admin\PetController::class, 'edit'])->name('pet.edit');
    Route::put('/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'update'])->name('pet.update');
    Route::delete('/pet/{id}', [App\Http\Controllers\Admin\PetController::class, 'destroy'])->name('pet.destroy');


    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
    Route::post('/role', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('role.destroy');

    Route::get('manajemen-role', [\App\Http\Controllers\Admin\ManajemenRoleController::class, 'index'])->name('manajemen_role.index');
    Route::get('manajemen-role/{iduser}/edit', [\App\Http\Controllers\Admin\ManajemenRoleController::class, 'edit'])->name('manajemen_role.edit');
    Route::put('manajemen-role/{iduser}', [\App\Http\Controllers\Admin\ManajemenRoleController::class, 'update'])->name('manajemen_role.update');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    Route::post('/user', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');

    // DATA PEMILIK
    Route::get('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pemilik/create', [App\Http\Controllers\Admin\PemilikController::class, 'create'])->name('pemilik.create');
    Route::post('/pemilik', [App\Http\Controllers\Admin\PemilikController::class, 'store'])->name('pemilik.store');
    Route::get('/pemilik/{id}/edit', [App\Http\Controllers\Admin\PemilikController::class, 'edit'])->name('pemilik.edit');
    Route::put('/pemilik/{id}', [App\Http\Controllers\Admin\PemilikController::class, 'update'])->name('pemilik.update');
    Route::delete('/pemilik/{id}', [App\Http\Controllers\Admin\PemilikController::class, 'destroy'])->name('pemilik.destroy');

    // DATA DOKTER
    Route::get('/dokter', [App\Http\Controllers\Admin\DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [App\Http\Controllers\Admin\DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [App\Http\Controllers\Admin\DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{id}/edit', [App\Http\Controllers\Admin\DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{id}', [App\Http\Controllers\Admin\DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{id}', [App\Http\Controllers\Admin\DokterController::class, 'destroy'])->name('dokter.destroy');

    // DATA PERAWAT
    Route::get('/perawat', [App\Http\Controllers\Admin\PerawatController::class, 'index'])->name('perawat.index');
    Route::get('/perawat/create', [App\Http\Controllers\Admin\PerawatController::class, 'create'])->name('perawat.create');
    Route::post('/perawat', [App\Http\Controllers\Admin\PerawatController::class, 'store'])->name('perawat.store');
    Route::get('/perawat/{id}/edit', [App\Http\Controllers\Admin\PerawatController::class, 'edit'])->name('perawat.edit');
    Route::put('/perawat/{id}', [App\Http\Controllers\Admin\PerawatController::class, 'update'])->name('perawat.update');
    Route::delete('/perawat/{id}', [App\Http\Controllers\Admin\PerawatController::class, 'destroy'])->name('perawat.destroy');

    // TEMU DOKTER
    Route::get('/temu-dokter', [App\Http\Controllers\Admin\TemuDokterController::class, 'index'])->name('temu-dokter.index');
    Route::post('/temu-dokter', [App\Http\Controllers\Admin\TemuDokterController::class, 'store'])->name('temu-dokter.store');
    Route::put('/temu-dokter/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'updateStatus'])->name('temu-dokter.updateStatus');
    Route::delete('/temu-dokter/{id}', [App\Http\Controllers\Admin\TemuDokterController::class, 'destroy'])->name('temu-dokter.delete');

    // REKAM MEDIS
    Route::get('/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/create', [App\Http\Controllers\Admin\RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('/rekam-medis', [App\Http\Controllers\Admin\RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'show'])->name('rekam-medis.show');
    Route::delete('/rekam-medis/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'destroy'])->name('rekam-medis.delete');
    Route::get('/rekam-medis/{id}/edit', [App\Http\Controllers\Admin\RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [App\Http\Controllers\Admin\RekamMedisController::class, 'update'])->name('rekam-medis.update');

    Route::post('/rekam-medis/{id}/tindakan', [App\Http\Controllers\Admin\TindakanController::class, 'store'])->name('tindakan.store');
    Route::get('/tindakan/{id}/edit', [App\Http\Controllers\Admin\TindakanController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/{id}', [App\Http\Controllers\Admin\TindakanController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{id}', [App\Http\Controllers\Admin\TindakanController::class, 'destroy'])->name('tindakan.destroy');
});

// akses Resepsionis
Route::middleware('isResepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\resepsionis\ResepsionisDashboardController::class, 'index'])->name('dashboard');

    Route::get('/registrasi-pemilik', [App\Http\Controllers\Resepsionis\PemilikController::class, 'index'])->name('registrasi-pemilik.index');
    Route::post('/registrasi-pemilik', [App\Http\Controllers\Resepsionis\PemilikController::class, 'store'])->name('registrasi-pemilik.store');
    Route::get('/registrasi-pemilik/{id}/edit', [App\Http\Controllers\Resepsionis\PemilikController::class, 'edit'])->name('registrasi-pemilik.edit');
    Route::put('/registrasi-pemilik/{id}', [App\Http\Controllers\Resepsionis\PemilikController::class, 'update'])->name('registrasi-pemilik.update');
    Route::delete('/registrasi-pemilik/{id}', [App\Http\Controllers\Resepsionis\PemilikController::class, 'destroy'])->name('registrasi-pemilik.destroy');


    Route::get('/registrasi-pet', [App\Http\Controllers\Resepsionis\PetController::class, 'index'])->name('registrasi-pet.index');
    Route::post('/registrasi-pet', [App\Http\Controllers\Resepsionis\PetController::class, 'store'])->name('registrasi-pet.store');
    Route::get('/registrasi-pet/{id}/edit', [App\Http\Controllers\Resepsionis\PetController::class, 'edit'])->name('registrasi-pet.edit');
    Route::put('/registrasi-pet/{id}', [App\Http\Controllers\Resepsionis\PetController::class, 'update'])->name('registrasi-pet.update');
    Route::delete('/registrasi-pet/{id}', [App\Http\Controllers\Resepsionis\PetController::class, 'destroy'])->name('registrasi-pet.delete');

    Route::get('/temu-dokter', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'index'])->name('temu-dokter.index');
    Route::post('/temu-dokter', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'store'])->name('temu-dokter.store');
    Route::put('/temu-dokter/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'updateStatus'])->name('temu-dokter.updateStatus');
    Route::delete('/temu-dokter/{id}', [App\Http\Controllers\Resepsionis\TemuDokterController::class, 'destroy'])->name('temu-dokter.delete');
});

// akses perawat
Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Perawat\PerawatDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\Perawat\PerawatDashboardController::class, 'profile'])->name('profile');

    Route::get('/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::post('/rekam-medis', [App\Http\Controllers\Perawat\RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'show'])->name('rekam-medis.show');
    Route::delete('/rekam-medis/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'destroy'])->name('rekam-medis.delete');
    Route::get('/rekam-medis/{id}/edit', [App\Http\Controllers\Perawat\RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [App\Http\Controllers\Perawat\RekamMedisController::class, 'update'])->name('rekam-medis.update'); 
});

// akses dokter
Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dokter\DokterDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\Dokter\DokterDashboardController::class, 'profile'])->name('profile');

    Route::get('/rekam-medis', [App\Http\Controllers\Dokter\RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [App\Http\Controllers\Dokter\RekamMedisController::class, 'show'])->name('rekam-medis.show');

    Route::post('/rekam-medis/{id}/tindakan', [App\Http\Controllers\Dokter\TindakanController::class, 'store'])->name('tindakan.store');
    Route::get('/tindakan/{id}/edit', [App\Http\Controllers\Dokter\TindakanController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/{id}', [App\Http\Controllers\Dokter\TindakanController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{id}', [App\Http\Controllers\Dokter\TindakanController::class, 'destroy'])->name('tindakan.destroy');
});

// akses pemilik
Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Pemilik\PemilikDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [App\Http\Controllers\Pemilik\PemilikDashboardController::class, 'profile'])->name('profile');

    Route::get('/pet', [App\Http\Controllers\Pemilik\PetController::class, 'index'])->name('pet.index');

    Route::get('/reservasi', [App\Http\Controllers\Pemilik\ReservasiController::class, 'index'])->name('reservasi.index');

    Route::get('/rekam-medis', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [App\Http\Controllers\Pemilik\RekamMedisController::class, 'show'])->name('rekam-medis.show');
});