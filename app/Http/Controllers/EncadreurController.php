<?php

namespace App\Http\Controllers;

use App\Models\Encadreur;
use Illuminate\Http\Request;

class EncadreurController extends Controller
{
    public function index()
    {
        return response()->json(Encadreur::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialite' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'telephone' => 'required|string|max:50',
        ]);

        $encadreur = Encadreur::create($data);
        return response()->json($encadreur, 201);
    }

    public function show($id)
    {
        return response()->json(Encadreur::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $encadreur = Encadreur::findOrFail($id);
        $encadreur->update($request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'specialite' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:50',
        ]));

        return response()->json($encadreur);
    }

    public function destroy($id)
    {
        $encadreur = Encadreur::findOrFail($id);
        $encadreur->delete();
        return response()->json(['message' => 'Encadreur supprimé avec succès']);
    }
}
