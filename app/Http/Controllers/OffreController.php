<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOffreRequest;
use App\Http\Resources\OffreResource;
use App\Models\Offre;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::with('entreprise')->where('statut', 'ouverte')->get();
        return OffreResource::collection($offres);
    }

    public function store(StoreOffreRequest $request)
    {
        $offre = Offre::create($request->validated());
        return new OffreResource($offre);
    }

    public function show($id)
    {
        $offre = Offre::with('entreprise')->findOrFail($id);
        return new OffreResource($offre);
    }

    public function update(StoreOffreRequest $request, $id)
    {
        $offre = Offre::findOrFail($id);
        $offre->update($request->validated());
        return new OffreResource($offre);
    }

    public function destroy($id)
    {
        $offre = Offre::findOrFail($id);
        $offre->delete();
        return response()->json(['message' => 'Offre supprimée avec succès']);
    }
}
