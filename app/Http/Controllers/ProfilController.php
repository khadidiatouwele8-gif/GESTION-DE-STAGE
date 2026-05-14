<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Afficher profil connecté
     */
    public function index(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Modifier profil connecté
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Modifier nom
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        // Modifier email
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        // Modifier mot de passe
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profil mis à jour avec succès',
            'user' => $user
        ]);
    }
}
