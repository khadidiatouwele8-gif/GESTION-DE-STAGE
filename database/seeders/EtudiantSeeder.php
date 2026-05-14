<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Etudiant;

class EtudiantSeeder extends Seeder
{
    public function run(): void
    {
        Etudiant::create([
            'user_id' => 2,
            'matricule' => 'ESP2024001',
            'filiere' => 'Génie Informatique',
            'niveau' => 'L3',
            'telephone' => '771234567',
        ]);
    }
}