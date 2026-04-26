<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidature;

class CandidatureController extends Controller
{
    /**
     * Liste des candidatures
     */
    public function index()
    {
        return response()->json(['message' => 'Liste des candidatures (Architecture OK)']);
    }

    /**
     * Postuler à un stage
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Candidature envoyée (Architecture OK)'], 201);
    }

    /**
     * Afficher une candidature spécifique
     */
    public function show($id)
    {
        return response()->json(['message' => 'Détail candidature ' . $id]);
    }

    /**
     * Mettre à jour une candidature
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Candidature ' . $id . ' mise à jour']);
    }

    /**
     * Supprimer une candidature
     */
    public function destroy($id)
    {
        return response()->json(['message' => 'Candidature supprimée avec succès']);
    }
}
