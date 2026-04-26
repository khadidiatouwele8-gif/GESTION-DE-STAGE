<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'etudiant_id',
        'stage_id',
        'statut',
        'lettre_motivation'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
