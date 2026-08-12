<?php

use App\Http\Controllers\FormationSessionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/formations', [FormationSessionController::class, 'index'])->name('formations.index');

    Route::get('/formations/create', [FormationSessionController::class, 'create'])->name('formations.create');
    Route::post('/formations', [FormationSessionController::class, 'store'])->name('formations.store');
    Route::get('/formations/{formation}/edit', [FormationSessionController::class, 'edit'])->name('formations.edit');
    Route::put('/formations/{formation}', [FormationSessionController::class, 'update'])->name('formations.update');


    // Route::resource('formations', FormationSessionController::class)
    // ->only(['store', 'edit', 'update', 'destroy']);
});

