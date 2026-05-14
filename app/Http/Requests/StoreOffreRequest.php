<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'entreprise_id' => 'required|exists:entreprises,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'domaine' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'duree_mois' => 'required|integer|min:1',
            'date_publication' => 'required|date',
            'date_expiration' => 'required|date|after_or_equal:date_publication',
            'statut' => 'sometimes|in:ouverte,fermee,expiree',
        ];
    }
}
