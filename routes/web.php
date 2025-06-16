<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProgresController;

// Landing Page
Route::get('/Landing.page-SEJALUR', function () {
    return view('Landing-page/Landing-page');
})->name('Landing.page');

// Register, Login, Logout
Route::get('/Register', [AuthController::class, 'showRegister'])->name('Register');
Route::post('/Register', [AuthController::class, 'register']);

Route::get('/Login', [AuthController::class, 'showLogin'])->name('Login');
Route::post('/Login', [AuthController::class, 'login']);

Route::post('/Logout', [AuthController::class, 'logout'])->name('Logout');

// Dashboard
Route::get('/Dashboard/Admin', [PengaduanController::class, 'indexDashboardAdmin'])->name('Dashboard.admin');
Route::get('/Dashboard/Masyarakat', [PengaduanController::class, 'indexDashboardMasyarakat'])->name('Dashboard.masyarakat');
Route::get('/Dashboard/Petugas', [PengaduanController::class, 'indexDashboardPetugas'])->name('Dashboard.petugas');

// Pengaduan
Route::get('/Pengaduan/Admin', [PengaduanController::class, 'indexAdmin'])->name('Pengaduan.admin');
Route::get('/Pengaduan/Masyarakat', [PengaduanController::class, 'indexMasyarakat'])->name('Pengaduan.masyarakat');
Route::get('/Pengaduan/Petugas', [PengaduanController::class, 'indexPetugas'])->name('Pengaduan.petugas');

// Pengaduan-detail
Route::get('/Pengaduan-detail/Admin/{id}', [PengaduanController::class, 'showPengaduanDetail'])->name('Pengaduan.detail.admin');
Route::get('/Pengaduan-detail/Masyarakat/{id}', [PengaduanController::class, 'showPengaduanDetail'])->name('Pengaduan.detail.masyarakat');
Route::get('/Pengaduan-detail/Petugas/{id}', [PengaduanController::class, 'showPengaduanDetail'])->name('Pengaduan.detail.petugas');

// Pengaduan update
Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
Route::put('/pengaduan/{id}/petugas', [PengaduanController::class, 'updatePetugas'])->name('pengaduan.updatePetugas');

// Form-pengaduan
Route::get('/Form-pengaduan/Masyarakat', function () {
    return view('Form-pengaduan/Form-pengaduan');
})->name('Form.pengaduan');

Route::post('/Form-pengaduan/Masyarakat', [PengaduanController::class, 'store'])->name('pengaduan.store');

// Perbaikan-dikerjakan
Route::get('/perbaikan-dikerjakan-admin', function () {
    $pengaduans = \App\Models\Pengaduan::whereNotNull('petugas')
        ->whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])
        ->get();
    return view('Perbaikan-dikerjakan/Perbaikan-dikerjakan(Admin)', compact('pengaduans'));
})->name('Perbaikan.dikerjakan.admin');
Route::get('/perbaikan-dikerjakan-masyarakat', function () {
    $pengaduans = \App\Models\Pengaduan::whereNotNull('petugas')
        ->whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])
        ->get();
    return view('Perbaikan-dikerjakan/Perbaikan-dikerjakan(Masyarakat)', compact('pengaduans'));
})->name('Perbaikan.dikerjakan.masyarakat');
Route::get('/perbaikan-dikerjakan-petugas', function () {
    $pengaduans = \App\Models\Pengaduan::whereNotNull('petugas')
        ->whereIn('status', ['Belum Diperbaiki', 'Sedang diperbaiki'])
        ->get();
    return view('Perbaikan-dikerjakan/Perbaikan-dikerjakan(Petugas)', compact('pengaduans'));
})->name('Perbaikan.dikerjakan.petugas');

// Perbaikan-dikerjakan-detail
Route::get('/Perbaikan-dikerjakan-detail/Admin/{id}', [PengaduanController::class, 'showPerbaikanDikerjakan'])->name('Perbaikan.dikerjakan.detail.admin');
Route::get('/Perbaikan-dikerjakan-detail/Masyarakat/{id}', [PengaduanController::class, 'showPerbaikanDikerjakan'])->name('Perbaikan.dikerjakan.detail.masyarakat');
Route::get('/Perbaikan-dikerjakan-detail/Petugas/{id}', [PengaduanController::class, 'showPerbaikanDikerjakan'])->name('Perbaikan.dikerjakan.detail.petugas');

// Tampilkan form tambah progres
Route::get('/progres/create/{pengaduan}', [ProgresController::class, 'create'])->name('progres.form');
// Simpan progres
Route::post('/progres/store/{pengaduan}', [ProgresController::class, 'store'])->name('progres.store');

// Perbaikan-selesai
Route::get('/perbaikan-selesai-admin', function () {
    $pengaduans = \App\Models\Pengaduan::where('status', 'Selesai')->whereNotNull('petugas')->get();
    return view('Perbaikan-selesai/Perbaikan-selesai(Admin)', compact('pengaduans'));
})->name('Perbaikan.selesai.admin');
Route::get('/perbaikan-selesai-masyarakat', function () {
    $pengaduans = \App\Models\Pengaduan::where('status', 'Selesai')->whereNotNull('petugas')->get();
    return view('Perbaikan-selesai/Perbaikan-selesai(Masyarakat)', compact('pengaduans'));
})->name('Perbaikan.selesai.masyarakat');
Route::get('/perbaikan-selesai-petugas', function () {
    $pengaduans = \App\Models\Pengaduan::where('status', 'Selesai')->whereNotNull('petugas')->get();
    return view('Perbaikan-selesai/Perbaikan-selesai(Petugas)', compact('pengaduans'));
})->name('Perbaikan.selesai.petugas');

// Perbaikan-selesai-detail
Route::get('/Perbaikan-selesai-detail/Admin/{id}', [ProgresController::class, 'showPerbaikanSelesaiDetail'])->name('Perbaikan.selesai.detail.admin');
Route::get('/Perbaikan-selesai-detail/Masyarakat/{id}', [ProgresController::class, 'showPerbaikanSelesaiDetail'])->name('Perbaikan.selesai.detail.masyarakat');
Route::get('/Perbaikan-selesai-detail/Petugas/{id}', [ProgresController::class, 'showPerbaikanSelesaiDetail'])->name('Perbaikan.selesai.detail.petugas');


// Profil
Route::get('/Profil/Admin', function () {
    return view('Profil/Profil(Admin)');
})->name('Profil.admin');
Route::get('/Profil/Masyarakat', function () {
    return view('Profil/Profil(Masyarakat)');
})->name('Profil.masyarakat');
Route::get('/Profil/Petugas', function () {
    return view('Profil/Profil(Petugas)');
})->name('Profil.petugas');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'editProfil'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfil'])->name('profile.update');
});



