<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = ['entreprise_id', 'titre', 'description', 'domaine', 'localisation', 'duree_mois', 'date_publication', 'date_expiration', 'statut'];

    public function entreprise() {
        return $this->belongsTo(Entreprise::class);
    }
    public function candidatures() {
        return $this->hasMany(Candidature::class);
    }
}
