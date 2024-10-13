<?php

use App\Http\Controllers\Gestion\CitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ShareNextCita; 

Route::middleware(['auth', ShareNextCita::class])->group(function (){
    
    Route::get('/citas', [CitasController::class, 'index'])->middleware(['auth', 'verified'])->name('citas');
    Route::post('citas/guardar', [CitasController::class, 'guardar'])->name('citas.guardar');
    Route::delete('citas/{id}', [CitasController::class, 'eliminar'])->name('citas.eliminar');
    Route::put('citas/update', [CitasController::class, 'update'])->name('citas.update');
});


?>