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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Voici les routes API de l'application GESTION-DE-STAGE
|
*/

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées (nécessitent token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Stages (Toutes les méthodes CRUD : index, store, show, update, destroy)
    Route::apiResource('stages', StageController::class);

    // Offres, conventions, rapports et encadreurs
    Route::apiResource('offres', OffreController::class);
    Route::apiResource('conventions', ConventionController::class);
    Route::apiResource('rapports', RapportController::class);
    Route::apiResource('encadreurs', EncadreurController::class);

    // Candidatures
    Route::apiResource('candidatures', CandidatureController::class);
});

/*
|--------------------------------------------------------------------------
| Liste des endpoints
|--------------------------------------------------------------------------
|
| Méthode    Endpoint              Description                        Auth requis
| --------   -------------------   --------------------------------    ------------
| POST       /api/register         Inscription d'un nouvel utilisateur   Non
| POST       /api/login            Connexion + génération token          Non
| POST       /api/logout           Déconnexion + révocation token        Oui
| GET        /api/user             Profil de l'utilisateur connecté      Oui
| GET        /api/users            Liste de tous les utilisateurs        Oui
| GET        /api/users/{id}       Détail d'un utilisateur               Oui
| PUT        /api/users/{id}       Modifier un utilisateur               Oui
| DELETE     /api/users/{id}       Supprimer un utilisateur              Oui
| GET        /api/stages           Liste de tous les stages              Oui
| POST       /api/stages           Créer un nouveau stage                Oui
| GET        /api/stages/{id}      Détail d'un stage                     Oui
| PUT        /api/stages/{id}      Modifier un stage                     Oui
| DELETE     /api/stages/{id}      Supprimer un stage                    Oui
| GET        /api/candidatures     Liste des candidatures                Oui
| POST       /api/candidatures     Postuler à un stage                   Oui
| GET        /api/candidatures/{id} Détail d'une candidature              Oui
| PUT        /api/candidatures/{id} Modifier une candidature              Oui
| DELETE     /api/candidatures/{id} Supprimer une candidature             Oui
|
*/
