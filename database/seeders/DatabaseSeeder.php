<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $this->call([
        RolesPermissionsSeeder::class, // crée/MAJ roles & permissions (planets.*, crew.*, etc.)
        UsersSeeder::class,            // crée/MAJ les comptes et assigne les rôles
        // PlanetSeeder::class,        // optionnel: données de démo
        // CrewSeeder::class,          // optionnel: données de démo
        ]);
    }
}
