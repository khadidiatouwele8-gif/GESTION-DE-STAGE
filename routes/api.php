<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ConventionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\EncadreurController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profil',  [AuthController::class, 'profil']);
    Route::put('/profil',  [AuthController::class, 'updateProfil']);

    // Offres — lecture pour tous
    Route::get('/offres',        [OffreController::class, 'index']);
    Route::get('/offres/{id}',   [OffreController::class, 'show']);

    // Offres — écriture réservée aux entreprises
    Route::middleware('is.entreprise')->group(function () {
        Route::post('/offres',          [OffreController::class, 'store']);
        Route::put('/offres/{id}',      [OffreController::class, 'update']);
        Route::delete('/offres/{id}',   [OffreController::class, 'destroy']);
    });

    // Candidatures — postuler réservé aux étudiants
    Route::middleware('is.etudiant')->group(function () {
        Route::post('/candidatures', [CandidatureController::class, 'store']);
    });

    // Candidatures — reste pour tous
    Route::get('/candidatures',          [CandidatureController::class, 'index']);
    Route::get('/candidatures/{id}',     [CandidatureController::class, 'show']);
    Route::put('/candidatures/{id}',     [CandidatureController::class, 'update']);
    Route::delete('/candidatures/{id}',  [CandidatureController::class, 'destroy']);

    // Stages, conventions, rapports, encadreurs
    Route::apiResource('stages',      StageController::class);
    Route::apiResource('conventions', ConventionController::class);
    Route::apiResource('rapports',    RapportController::class);
    Route::apiResource('encadreurs',  EncadreurController::class);

    // Admin uniquement
    Route::middleware('is.admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });

});
