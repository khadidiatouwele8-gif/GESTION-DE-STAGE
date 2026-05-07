<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Entreprise;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        Entreprise::create([
            'user_id' => 3,
            'nom' => 'Sonatel',
            'secteur' => 'Télécommunications',
            'adresse' => 'Dakar, Sénégal',
            'telephone' => '338001000',
            'statut' => 'validee',
        ]);
    }
}