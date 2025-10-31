<?php

// database/factories/CrewMemberFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CrewMemberFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'slug'       => str()->slug($name),
            'name'       => ['fr' => $name, 'en' => $name],
            'role_title' => ['fr' => 'Ingénieur', 'en' => 'Engineer'],
            'bio'        => ['fr' => $this->faker->sentence(12), 'en' => $this->faker->sentence(12)],
            'image'      => null, // ✅ cohérent avec ton modèle
        ];
    }
}
