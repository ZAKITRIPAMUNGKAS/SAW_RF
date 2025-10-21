<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\HasilController;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});

// Routes untuk authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes yang memerlukan authentication
Route::middleware(['admin.auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kandidat
    Route::resource('kandidat', KandidatController::class);
    
    // Kriteria
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    
    // Penilaian
    Route::resource('penilaian', PenilaianController::class);
    Route::post('/penilaian/matriks', [PenilaianController::class, 'simpanMatriks'])->name('penilaian.matriks');
    
    // Hasil SAW
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::post('/hasil/hitung-ulang', [HasilController::class, 'hitungUlang'])->name('hasil.hitung-ulang');
    Route::get('/hasil/{kandidatId}/detail', [HasilController::class, 'detail'])->name('hasil.detail');
    Route::get('/hasil/ekspor-pdf', [HasilController::class, 'eksporPdf'])->name('hasil.ekspor-pdf');
    Route::get('/hasil/ekspor-excel', [HasilController::class, 'eksporExcel'])->name('hasil.ekspor-excel');
});
