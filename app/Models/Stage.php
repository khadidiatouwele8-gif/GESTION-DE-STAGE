<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = [
        'entreprise_id',
        'titre',
        'description',
        'domaine',
        'date_debut',
        'date_fin',
        'statut'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}
