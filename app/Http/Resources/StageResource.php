<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'candidature' => [
                'id' => $this->candidature->id,
                'statut' => $this->candidature->statut,
                'offre_id' => $this->candidature->offre_id,
            ],
            'encadreur' => $this->whenLoaded('encadreur', function () {
                return [
                    'id' => $this->encadreur->id,
                    'specialite' => $this->encadreur->specialite,
                    'departement' => $this->encadreur->departement,
                ];
            }),
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'statut' => $this->statut,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
