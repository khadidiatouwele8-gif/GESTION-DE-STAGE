<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEtudiant
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || !$user->role || $user->role->nom !== 'etudiant') {
            return response()->json([
                'success' => false,
                'message' => 'Accès refusé. Rôle étudiant requis.'
            ], 403);
        }

        return $next($request);
    }
}
