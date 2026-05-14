<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'candidature_id' => 'required|exists:candidatures,id',
            'encadreur_id' => 'nullable|exists:encadreurs,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'sometimes|in:en_cours,termine,abandonne',
        ];
    }
}
