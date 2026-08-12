<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

});

require __DIR__.'/settings.php';
require __DIR__.'/formations.php';
