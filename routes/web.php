<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AntrianController::class, 'index'])->name('dashboard');
    Route::post('/antrian/ambil', [AntrianController::class, 'ambil'])->name('antrian.ambil');
    Route::get('/antrian/{id}/download', [AntrianController::class, 'download'])->name('antrian.download');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/antrian', [AdminController::class, 'index'])->name('admin.antrian');
    Route::put('/admin/antrian/{id}', [AdminController::class, 'updateStatus'])->name('admin.antrian.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
