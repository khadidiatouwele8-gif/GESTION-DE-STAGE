<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Inscription
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:etudiant,entreprise,encadreur,responsable,admin',
        ]);

        // Création utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        /**
         * Création automatique du profil
         * selon le rôle
         */
        if ($validated['role'] === 'etudiant') {

            Etudiant::create([
                'user_id' => $user->id,
            ]);

        } elseif ($validated['role'] === 'entreprise') {

            Entreprise::create([
                'user_id' => $user->id,
            ]);
        }

        // Création token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    /**
     * Connexion
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['Email ou mot de passe incorrect.'],
            ]);
        }

        // Supprimer anciens tokens
        $user->tokens()->delete();

        // Nouveau token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }

    /**
     * Voir profil connecté
     */
    public function profil(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    /**
     * Modifier profil
     */
    public function updateProfil(Request $request)
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

    /**
     * Rafraîchir token
     */
    public function refresh(Request $request)
    {
        $user = $request->user();

        // Supprimer anciens tokens
        $user->tokens()->delete();

        // Nouveau token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Token rafraîchi',
            'token' => $token
        ]);
    }
}
