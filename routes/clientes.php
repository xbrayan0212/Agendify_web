<?php

use App\Http\Controllers\Gestion\ClientesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/clientes',[ClientesController::class,'index'])->name('clientes');
    Route::post('/clientes/guardar', [ClientesController::class, 'guardar'])->name('clientes.guardar');
    Route::delete('clientes/{id}', [ClientesController::class, 'eliminar'])->name('clientes.eliminar');
    Route::put('cliente/update', [ClientesController::class, 'update'])->name('clientes.update');
});
