<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Entreprise;
use App\Models\Etudiant;
use App\Models\Encadreur;
use App\Models\Offre;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles
        $adminRole = Role::create(['nom' => 'admin']);
        $entrepriseRole = Role::create(['nom' => 'entreprise']);
        $etudiantRole = Role::create(['nom' => 'etudiant']);
        $encadreurRole = Role::create(['nom' => 'encadreur']);

        // Créer un admin
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
        ]);

        // Créer une entreprise
        $entreprise = Entreprise::factory()->create();
        $userEntreprise = User::factory()->create([
            'email' => 'entreprise@example.com',
            'role_id' => $entrepriseRole->id,
        ]);
        $entreprise->user_id = $userEntreprise->id;
        $entreprise->save();

        // Créer un étudiant
        $etudiant = Etudiant::factory()->create();
        $userEtudiant = User::factory()->create([
            'email' => 'etudiant@example.com',
            'role_id' => $etudiantRole->id,
        ]);
        $etudiant->user_id = $userEtudiant->id;
        $etudiant->save();

        // Créer un encadreur
        $encadreur = Encadreur::factory()->create();
        $userEncadreur = User::factory()->create([
            'email' => 'encadreur@example.com',
            'role_id' => $encadreurRole->id,
        ]);
        $encadreur->user_id = $userEncadreur->id;
        $encadreur->save();

        // Créer des offres
        Offre::factory(5)->create(['entreprise_id' => $entreprise->id]);
    }
}
