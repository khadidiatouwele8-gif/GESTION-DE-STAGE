<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'etudiant_id' => 'required|exists:etudiants,id',
            'offre_id' => 'required|exists:offres,id',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'lettre_motivation' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'statut' => 'sometimes|in:en_attente,acceptee,refusee',
        ];
    }
}
