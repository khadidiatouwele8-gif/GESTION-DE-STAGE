<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CandidatureResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'etudiant' => [
                'id' => $this->etudiant->id,
                'matricule' => $this->etudiant->matricule,
            ],
            'offre' => [
                'id' => $this->offre->id,
                'titre' => $this->offre->titre,
            ],
            'cv' => $this->cv ? Storage::url($this->cv) : null,
            'lettre_motivation' => $this->lettre_motivation ? Storage::url($this->lettre_motivation) : null,
            'statut' => $this->statut,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
