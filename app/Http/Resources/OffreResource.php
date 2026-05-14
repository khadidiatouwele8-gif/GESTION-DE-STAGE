<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OffreResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'entreprise' => [
                'id' => $this->entreprise->id,
                'nom' => $this->entreprise->nom,
            ],
            'titre' => $this->titre,
            'description' => $this->description,
            'domaine' => $this->domaine,
            'localisation' => $this->localisation,
            'duree_mois' => $this->duree_mois,
            'date_publication' => $this->date_publication,
            'date_expiration' => $this->date_expiration,
            'statut' => $this->statut,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
