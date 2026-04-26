<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InsertionProfessionnelle extends Model
{
    protected $fillable = ['etudiant_id', 'rapport_id', 'statut', 'entreprise_actuelle', 'poste_actuel', 'date_insertion'];

    public function etudiant() {
        return $this->belongsTo(Etudiant::class);
    }
    public function rapport() {
        return $this->belongsTo(Rapport::class);
    }
}
