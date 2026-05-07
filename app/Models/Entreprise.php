<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nom', 'description', 'adresse', 
        'telephone', 'email_contact', 'site_web', 'statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function scopeValidee($query)
    {
        return $query->where('statut', 'validee');
    }
}
