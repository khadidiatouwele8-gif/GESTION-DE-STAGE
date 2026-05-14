<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Resources\CandidatureResource;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Candidature::with(['etudiant.user', 'offre.entreprise'])->get();
        return CandidatureResource::collection($candidatures);
    }

    public function store(StoreCandidatureRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        if ($request->hasFile('lettre_motivation')) {
            $data['lettre_motivation'] = $request->file('lettre_motivation')->store('lettres', 'public');
        }

        $candidature = Candidature::create($data);
        return new CandidatureResource($candidature->load(['etudiant.user', 'offre.entreprise']));
    }

    public function show($id)
    {
        $candidature = Candidature::with(['etudiant.user', 'offre.entreprise'])->findOrFail($id);
        return new CandidatureResource($candidature);
    }

    public function update(StoreCandidatureRequest $request, $id)
    {
        $candidature = Candidature::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('cv')) {
            if ($candidature->cv) {
                Storage::disk('public')->delete($candidature->cv);
            }
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }

        if ($request->hasFile('lettre_motivation')) {
            if ($candidature->lettre_motivation) {
                Storage::disk('public')->delete($candidature->lettre_motivation);
            }
            $data['lettre_motivation'] = $request->file('lettre_motivation')->store('lettres', 'public');
        }

        $candidature->update($data);
        return new CandidatureResource($candidature->load(['etudiant.user', 'offre.entreprise']));
    }

    public function destroy($id)
    {
        $candidature = Candidature::findOrFail($id);

        if ($candidature->cv) {
            Storage::disk('public')->delete($candidature->cv);
        }
        if ($candidature->lettre_motivation) {
            Storage::disk('public')->delete($candidature->lettre_motivation);
        }

        $candidature->delete();
        return response()->json(['message' => 'Candidature supprimée avec succès']);
    }
}
