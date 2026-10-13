<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AdminController;


Route::middleware(['auth'])->group(function () {
    // Route::get('/', [AntrianController::class, 'create'])->name('antrian.ambil');
    Route::post('/antrian/ambil', [AntrianController::class, 'store'])->name('antrian.post');
    Route::get('/antrian/download', [AntrianController::class, 'download'])->name('antrian.download');

    Route::livewire('create', 'pages::antrian.create')->name('antrian.create');
    Route::livewire('update','pages::antrian.update')->name('antrian.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/queue-lists', [AdminController::class, 'index'])->name('queue-lists');
    Route::get('/queue-lists/{antrian}', [AdminController::class, 'show'])->name('queue-lists.show');
    Route::post('/queue-lists/{antrian}/update-status', [AdminController::class, 'updateStatus'])->name('queue-lists.update-status');

    Route::livewire('queue-lists', 'pages::antrian.update')->name('queue-lists');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mailable', function () {
    $antrian = App\Models\Antrian::first();
    return new App\Mail\EmailAntrian($antrian);
});

require __DIR__.'/auth.php';
