<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gestion\DashboardController;
use App\Http\Controllers\Gestion\CitasController;
use App\Http\Controllers\Gestion\ClientesController;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/clientes',[ClientesController::class,'index'])->middleware(['auth', 'verified'])->name('clientes');
Route::post('/clientes/guardar', [ClientesController::class, 'guardar'])->name('clientes.guardar');
Route::delete('clientes/{id}', [ClientesController::class, 'eliminar'])->name('clientes.eliminar');



Route::get('/citas', [CitasController::class, 'index'])->middleware(['auth', 'verified'])->name('citas');
Route::post('citas/guardar', [CitasController::class, 'guardar'])->name('citas.guardar');
Route::delete('citas/{id}', [CitasController::class, 'eliminar'])->name('citas.eliminar');

Route::get('/calendario', function () {
    return view('gestion.calendario');
})->middleware(['auth', 'verified'])->name('calendario');


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
