<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    protected $fillable = ['stage_id', 'fichier', 'statut', 'note', 'avis_encadreur', 'avis_responsable'];

    public function stage() {
        return $this->belongsTo(Stage::class);
    }
    public function insertionProfessionnelle() {
        return $this->hasOne(InsertionProfessionnelle::class);
    }
}
