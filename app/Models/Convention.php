<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id', 'fichier', 'signee_etudiant', 'signee_entreprise',
        'signee_encadreur', 'signee_responsable', 'date_signature'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
