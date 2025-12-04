<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\IndicatorResultController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // If already logged in, go straight to dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // Guests see the welcome page
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require login (profile, etc.) + projects
Route::middleware('auth')->group(function () {
    // Profile routes (existing)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ CRUD modules – only require auth for now
    Route::resource('projects', ProjectController::class);
    Route::resource('participants', ParticipantController::class);
    Route::resource('indicators', IndicatorController::class);
    Route::resource('indicator-results', IndicatorResultController::class);
});

require __DIR__ . '/auth.php';
