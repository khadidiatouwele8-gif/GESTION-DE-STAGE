<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use App\Models\Candidature;
use Illuminate\Http\Request;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::with(['candidature.offre.entreprise', 'encadreur', 'convention', 'rapport'])->get();
        return StageResource::collection($stages);
    }

    public function store(StoreStageRequest $request)
    {
        $data = $request->validated();

        $candidature = Candidature::findOrFail($data['candidature_id']);
        if ($candidature->statut !== 'acceptee') {
            return response()->json(['message' => 'La candidature doit être acceptée pour créer un stage.'], 422);
        }

        if ($candidature->stage) {
            return response()->json(['message' => 'Un stage existe déjà pour cette candidature.'], 422);
        }

        $stage = Stage::create($data);
        return new StageResource($stage->load(['candidature.offre.entreprise', 'encadreur', 'convention', 'rapport']));
    }

    public function show($id)
    {
        $stage = Stage::with(['candidature.offre.entreprise', 'encadreur', 'convention', 'rapport'])->findOrFail($id);
        return new StageResource($stage);
    }

    public function update(StoreStageRequest $request, $id)
    {
        $stage = Stage::findOrFail($id);
        $stage->update($request->validated());
        return new StageResource($stage->load(['candidature.offre.entreprise', 'encadreur', 'convention', 'rapport']));
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return response()->json(['message' => 'Stage supprimé avec succès']);
    }
}
