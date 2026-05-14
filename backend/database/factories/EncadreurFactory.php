<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EncadreurFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'specialite' => fake()->jobTitle(),
            'telephone' => fake()->phoneNumber(),
        ];
    }
}
