<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        return response()->json(Rapport::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'fichier' => 'nullable|string',
            'statut' => 'nullable|in:en_cours,termine,abandonne',
            'note' => 'nullable|numeric|min:0|max:20',
            'avis_encadreur' => 'nullable|string',
            'avis_responsable' => 'nullable|string',
        ]);

        $rapport = Rapport::create($data);
        return response()->json($rapport, 201);
    }

    public function show($id)
    {
        return response()->json(Rapport::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $rapport = Rapport::findOrFail($id);
        $rapport->update($request->validate([
            'stage_id' => 'sometimes|exists:stages,id',
            'fichier' => 'nullable|string',
            'statut' => 'nullable|in:en_cours,termine,abandonne',
            'note' => 'nullable|numeric|min:0|max:20',
            'avis_encadreur' => 'nullable|string',
            'avis_responsable' => 'nullable|string',
        ]));

        return response()->json($rapport);
    }

    public function destroy($id)
    {
        $rapport = Rapport::findOrFail($id);
        $rapport->delete();
        return response()->json(['message' => 'Rapport supprimé avec succès']);
    }
}
