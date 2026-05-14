<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ConventionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\EncadreurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntrepriseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/**
 * Routes publiques
 */

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/**
 * Routes protégées
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * Auth
     */
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);

    /**
     * Profil connecté
     */
    Route::get('/profil', [AuthController::class, 'profil']);
    Route::put('/profil', [AuthController::class, 'updateProfil']);



    /**
     * =========================
     * ROUTES ETUDIANT
     * =========================
     */
    Route::middleware('isEtudiant')->group(function () {

        // Candidatures
        Route::apiResource('candidatures', CandidatureController::class);

        // Mes candidatures
        Route::get('/mes-candidatures', [CandidatureController::class, 'mesCandidatures']);

        // Consulter offres
        Route::get('/offres', [OffreController::class, 'index']);

        // Voir stages
        Route::get('/stages', [StageController::class, 'index']);
    });



    /**
     * =========================
     * ROUTES ENTREPRISE
     * =========================
     */
    Route::middleware('isEntreprise')->group(function () {

        // CRUD offres
        Route::apiResource('offres', OffreController::class);

        // Voir candidatures reçues
        Route::get('/offres/{id}/candidatures', [CandidatureController::class, 'index']);
    });



    /**
     * =========================
     * ROUTES ENCADREUR
     * =========================
     */
    Route::middleware('isEncadreur')->group(function () {

        // Voir stages assignés
        Route::apiResource('stages', StageController::class);

        // Rapports
        Route::apiResource('rapports', RapportController::class);
    });



    /**
     * =========================
     * ROUTES RESPONSABLE
     * =========================
     */
    Route::middleware('isResponsable')->group(function () {

        // Gestion stages
        Route::apiResource('stages', StageController::class);

        // Conventions
        Route::apiResource('conventions', ConventionController::class);

        // Encadreurs
        Route::apiResource('encadreurs', EncadreurController::class);
    });



    /**
     * =========================
     * ROUTES ADMIN
     * =========================
     */
    Route::middleware('isAdmin')->group(function () {

        // Gestion utilisateurs
        Route::get('/users', [UserController::class, 'index']);

        // Validation entreprises
        Route::put('/entreprises/{id}/valider', [EntrepriseController::class, 'valider']);

        // Gestion complète
        Route::apiResource('offres', OffreController::class);
        Route::apiResource('stages', StageController::class);
        Route::apiResource('candidatures', CandidatureController::class);
        Route::apiResource('conventions', ConventionController::class);
        Route::apiResource('rapports', RapportController::class);
        Route::apiResource('encadreurs', EncadreurController::class);
    });

});
