<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'matricule', 'filiere', 'niveau',
        'telephone', 'adresse'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    public function insertionsProfessionnelles()
    {
        return $this->hasMany(InsertionProfessionnelle::class);
    }

    public function stages()
    {
        return $this->hasManyThrough(Stage::class, Candidature::class, 'etudiant_id', 'candidature_id');
    }
}
