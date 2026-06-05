<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\API\DataMasterController;
use Illuminate\Support\Facades\Route;

// Route ::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    // Pastikan data dummy-nya ada agar tidak error saat di-render
    $daftarAduan = \App\Models\AduanHilir::with(['jalurKiri.asal', 'jalurKanan.asal'])->get();
    
    return view('index', compact('daftarAduan')); 
    // view('index') akan otomatis mencari file resources/views/index.blade.php
});

// Public API for live updates
Route::get('/api/aduan/list', [ResultsController::class, 'getList'])->name('api.aduan.list');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Results Routes
Route::get('/input-results', [ResultsController::class, 'index'])->middleware(['auth', 'verified'])->name('input-results');

// API Routes untuk Data Master
Route::middleware('auth')->group(function () {
    Route::post('/api/asal/store', [DataMasterController::class, 'storeAsal'])->name('api.asal.store');
    Route::post('/api/jalur/store', [DataMasterController::class, 'storeJalur'])->name('api.jalur.store');
    Route::post('/api/aduan/store', [DataMasterController::class, 'storeAduan'])->name('api.aduan.store');
    Route::post('/api/user/store', [DataMasterController::class, 'storeUser'])->name('api.user.store');
    
    // Results API Routes
    Route::post('/api/aduan/update/{id}', [ResultsController::class, 'update'])->name('api.aduan.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
