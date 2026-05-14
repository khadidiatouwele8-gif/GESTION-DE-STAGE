<?php

namespace App\Http\Controllers;

use App\Models\Convention;
use Illuminate\Http\Request;

class ConventionController extends Controller
{
    public function index()
    {
        return response()->json(Convention::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'stage_id' => 'required|exists:stages,id',
            'fichier' => 'nullable|string',
            'signee_etudiant' => 'nullable|boolean',
            'signee_entreprise' => 'nullable|boolean',
            'signee_encadreur' => 'nullable|boolean',
            'signee_responsable' => 'nullable|boolean',
            'date_signature' => 'nullable|date',
        ]);

        $convention = Convention::create($data);
        return response()->json($convention, 201);
    }

    public function show($id)
    {
        return response()->json(Convention::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $convention = Convention::findOrFail($id);
        $convention->update($request->validate([
            'stage_id' => 'sometimes|exists:stages,id',
            'fichier' => 'nullable|string',
            'signee_etudiant' => 'nullable|boolean',
            'signee_entreprise' => 'nullable|boolean',
            'signee_encadreur' => 'nullable|boolean',
            'signee_responsable' => 'nullable|boolean',
            'date_signature' => 'nullable|date',
        ]));

        return response()->json($convention);
    }

    public function destroy($id)
    {
        $convention = Convention::findOrFail($id);
        $convention->delete();
        return response()->json(['message' => 'Convention supprimée avec succès']);
    }
}
