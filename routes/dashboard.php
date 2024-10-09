<?php

use App\Http\Controllers\Gestion\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/gServicio', [DashboardController::class, 'gServicio'])->name('guardar.servicio');
    Route::delete('/dashboard/{id}', [DashboardController::class,'eServicio'])->name('eliminar.servicio');
    Route::put('/dashboard/update',[DashboardController::class,'uServicio'])->name('actualizar.servicio');
});
