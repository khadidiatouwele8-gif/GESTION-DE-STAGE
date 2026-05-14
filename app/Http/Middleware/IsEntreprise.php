<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEntreprise
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'entreprise') {
            return response()->json(['message' => 'Accès refusé — Entreprise requise'], 403);
        }

        return $next($request);
    }
}
