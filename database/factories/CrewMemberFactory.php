<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CrewMemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'role' => $this->faker->randomElement(['Commandant','Ingénieur','Spécialiste','Pilote']),
            'bio'  => $this->faker->sentence(12),
            'image_path' => null,
        ];
    }
}
