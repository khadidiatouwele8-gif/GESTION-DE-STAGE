<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertionProfessionnelle extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id', 'stage_id', 'entreprise_id', 'poste_occupe',
        'date_debut', 'date_fin', 'type_contrat', 'salaire'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
