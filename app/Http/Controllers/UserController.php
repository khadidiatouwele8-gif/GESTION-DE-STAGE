<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Liste de tous les utilisateurs
     */
    public function index()
    {
        return response()->json(['message' => 'Liste des utilisateurs (Architecture OK)']);
    }

    /**
     * Afficher un utilisateur spécifique
     */
    public function show($id)
    {
        return response()->json(['message' => 'Détail utilisateur ' . $id]);
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Utilisateur ' . $id . ' mis à jour']);
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy($id)
    {
        return response()->json(['message' => 'Utilisateur supprimé avec succès']);
    }
}
