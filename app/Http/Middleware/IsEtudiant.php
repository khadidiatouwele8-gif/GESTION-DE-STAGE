<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEtudiant
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'etudiant') {
            return response()->json(['message' => 'Accès refusé — Étudiant requis'], 403);
        }

        return $next($request);
    }
}
