<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidature_id', 'encadreur_id', 'date_debut', 
        'date_fin', 'statut', 'remarques'
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }

    public function encadreur()
    {
        return $this->belongsTo(Encadreur::class);
    }

    public function convention()
    {
        return $this->hasOne(Convention::class);
    }

    public function rapport()
    {
        return $this->hasOne(Rapport::class);
    }

    // Scopes
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeTermine($query)
    {
        return $query->where('statut', 'termine');
    }
}
