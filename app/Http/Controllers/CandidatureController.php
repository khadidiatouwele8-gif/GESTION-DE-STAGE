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
        $candidatures = Candidature::with(['user', 'stage'])->get();
        return response()->json($candidatures);
    }

    /**
     * Postuler à un stage
     */
    public function store(Request $request)
    {
        $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'user_id' => 'required|exists:users,id',
            'lettre_motivation' => 'required|string',
            'statut' => 'sometimes|string|in:en_attente,acceptee,refusee',
        ]);

        // Vérifier si l'utilisateur a déjà postulé à ce stage
        $existingCandidature = Candidature::where('user_id', $request->user_id)
            ->where('stage_id', $request->stage_id)
            ->first();

        if ($existingCandidature) {
            return response()->json([
                'message' => 'Vous avez déjà postulé à ce stage'
            ], 422);
        }

        $candidature = Candidature::create([
            'stage_id' => $request->stage_id,
            'user_id' => $request->user_id,
            'lettre_motivation' => $request->lettre_motivation,
            'statut' => $request->statut ?? 'en_attente',
        ]);

        return response()->json($candidature, 201);
    }

    /**
     * Afficher une candidature spécifique
     */
    public function show($id)
    {
        $candidature = Candidature::with(['user', 'stage'])->findOrFail($id);
        return response()->json($candidature);
    }

    /**
     * Mettre à jour une candidature
     */
    public function update(Request $request, $id)
    {
        $candidature = Candidature::findOrFail($id);

        $request->validate([
            'lettre_motivation' => 'sometimes|string',
            'statut' => 'sometimes|string|in:en_attente,acceptee,refusee',
        ]);

        $candidature->update($request->all());

        return response()->json($candidature);
    }

    /**
     * Supprimer une candidature
     */
    public function destroy($id)
    {
        $candidature = Candidature::findOrFail($id);
        $candidature->delete();

        return response()->json(['message' => 'Candidature supprimée avec succès']);
    }
}