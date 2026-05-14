<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'matricule' => fake()->unique()->numerify('ESP#####'),
            'telephone' => fake()->phoneNumber(),
            'adresse' => fake()->address(),
        ];
    }
}