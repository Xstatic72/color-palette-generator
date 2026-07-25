<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::get('/color-palette', [App\Http\Controllers\ColorPaletteController::class, 'index'])->name('color-palette');

Route::post('/color-palette', [App\Http\Controllers\ColorPaletteController::class, 'generate'])->name('color-palette.generate');

require __DIR__.'/settings.php';
