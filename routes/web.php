<?php

use App\Http\Controllers\PositionsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PositionsController::class, 'index'])->name('positions.index');
Route::get('/job/{id}', [PositionsController::class, 'job'])->name('positions.job');

Route::get('/submit', function () { return view('submit'); })->name('positions.submitform');
Route::post('/submit', [PositionsController::class, 'submit'])->name('positions.submit');

Route::get('/dashboard', [PositionsController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/activate/{id}', [PositionsController::class, 'activate'])->name('positions.activate');
    Route::get('/deactivate/{id}', [PositionsController::class, 'deactivate'])->name('positions.deactivate');
    Route::get('/spam/{id}', [PositionsController::class, 'spam'])->name('positions.spam');
});

require __DIR__.'/auth.php';
