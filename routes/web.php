<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ShareNextCita; 

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', ShareNextCita::class])->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/clientes.php';
require __DIR__.'/citas.php';
require __DIR__.'/calendario.php';
