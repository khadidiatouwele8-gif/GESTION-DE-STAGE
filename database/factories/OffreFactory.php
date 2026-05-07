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
            'statut' => 'ouverte',
        ];
    }
}