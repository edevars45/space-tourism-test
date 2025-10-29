<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesPermissionsSeeder::class, // crée roles & perms
            UsersSeeder::class,            // crée users + assigne rôles
            // PlanetsSeeder::class,       // si tu as des données de démo
        ]);
    }
}
