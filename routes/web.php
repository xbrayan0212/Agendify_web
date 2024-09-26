<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gestion\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/calendario', function () {
    return view('gestion.calendario');
})->middleware(['auth', 'verified'])->name('calendario');

Route::get('/citas', function () {
    return view('gestion.citas');
})->middleware(['auth', 'verified'])->name('citas');

Route::get('/clientes', function () {
    return view('gestion.clientes');
})->middleware(['auth', 'verified'])->name('clientes');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
