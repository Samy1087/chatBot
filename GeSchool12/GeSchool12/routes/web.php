<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:etudiant'])->group(function () {
    Route::get('/etudiant/dashboard', [EtudiantController::class, 'index'])->name('etudiant.dashboard');
});

// Routes pour les professeurs
Route::middleware(['auth', 'role:professeur'])->group(function () {
    Route::get('/professeur/dashboard', [ProfesseurController::class, 'index'])->name('professeur.dashboard');
});
