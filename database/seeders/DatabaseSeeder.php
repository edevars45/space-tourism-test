<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ordre important :
     * 1) Rôles & permissions (créés une seule fois)
     * 2) Users (qui reçoivent des rôles/permissions)
     * 3) Données métiers (planètes de démo)
     */
    public function run(): void
    {
        $this->call([
            RolesPermissionsSeeder::class, // crée roles & permissions
            UsersSeeder::class,            // crée des utilisateurs + assigne les rôles
            PlanetSeeder::class,           // données de démo des planètes (singulier, tel que ton fichier)
        ]);
    }
}
