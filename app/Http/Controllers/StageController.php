<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;

class StageController extends Controller
{
    /**
     * Liste de tous les stages
     */
    public function index()
    {
        return response()->json(['message' => 'Liste des stages (Architecture OK)']);
    }

    /**
     * Créer un nouveau stage
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Stage créé (Architecture OK)'], 201);
    }

    /**
     * Détail d'un stage
     */
    public function show($id)
    {
        return response()->json(['message' => 'Détail du stage ' . $id]);
    }

    /**
     * Modifier un stage
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Stage ' . $id . ' mis à jour']);
    }

    /**
     * Supprimer un stage
     */
    public function destroy($id)
    {
        return response()->json(['message' => 'Stage supprimé avec succès']);
    }
}
