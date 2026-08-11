<?php

use App\Http\Controllers\FormationSessionController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('/formations', [FormationSessionController::class, 'index'])->name('formations.index');
});

require __DIR__.'/settings.php';
