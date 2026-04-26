<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Champs modifiables
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Champs cachés
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================
    // 🔗 RELATIONS
    // =========================

    /**
     * Un user appartient à un rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Un user peut être un étudiant
     */
    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }

    /**
     * Un user peut être une entreprise
     */
    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }
}
