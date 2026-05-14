<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'domaine' => fake()->word(),
            'localisation' => fake()->city(),
            'duree_mois' => fake()->numberBetween(1, 6),
            'date_publication' => now(),
            'date_expiration' => now()->addMonths(2),
            'statut' => 'ouverte',
        ];
    }
}
