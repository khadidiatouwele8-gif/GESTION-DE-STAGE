<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntrepriseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => fake()->company(),
            'adresse' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
        ];
    }
}