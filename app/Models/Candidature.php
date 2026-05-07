<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id', 'offre_id', 'lettre_motivation', 
        'cv_path', 'statut'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function stage()
    {
        return $this->hasOne(Stage::class);
    }
}
