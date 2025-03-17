<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PaiementController;

Route::post('/paiement/especes', [PaiementController::class, 'payerEspeces'])->name('paiement.especes');

