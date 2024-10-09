<?php

use App\Http\Controllers\Gestion\DashboardController;
use App\Http\Controllers\Gestion\CalendarioController; // Import the CalendarioController
use Illuminate\Support\Facades\Route;

// Calendario route
Route::get('/calendario', [CalendarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('calendario');
?>
