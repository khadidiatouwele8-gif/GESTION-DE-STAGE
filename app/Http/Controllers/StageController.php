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
        $stages = Stage::with('entreprise')->get();
        return response()->json($stages);
    }

    /**
     * Créer un nouveau stage
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'entreprise_id' => 'required|exists:entreprises,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'statut' => 'sometimes|string|in:actif,encours,termine',
        ]);

        $stage = Stage::create($request->all());

        return response()->json($stage, 201);
    }

    /**
     * Détail d'un stage
     */
    public function show($id)
    {
        $stage = Stage::with('entreprise', 'candidatures')->findOrFail($id);
        return response()->json($stage);
    }

    /**
     * Modifier un stage
     */
    public function update(Request $request, $id)
    {
        $stage = Stage::findOrFail($id);

        $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'entreprise_id' => 'sometimes|exists:entreprises,id',
            'date_debut' => 'sometimes|date',
            'date_fin' => 'sometimes|date',
            'statut' => 'sometimes|string|in:actif,encours,termine',
        ]);

        $stage->update($request->all());

        return response()->json($stage);
    }

    /**
     * Supprimer un stage
     */
    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();

        return response()->json(['message' => 'Stage supprimé avec succès']);
    }
}