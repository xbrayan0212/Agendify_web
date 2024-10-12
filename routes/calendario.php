<?php

use App\Http\Controllers\Gestion\DashboardController;
use App\Http\Controllers\Gestion\CalendarioController; // Import the CalendarioController
use Illuminate\Support\Facades\Route;

// Calendario route
Route::get('/calendario', [CalendarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('calendario');

Route::put('/calendario', [CalendarioController::class, 'change_cita_details'])->name('cambio_detalles_citas');
?>
