<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Je crée les permissions/rôles pour le back-office "Planètes".
     */
    public function run(): void
    {
        // Je nettoie le cache Spatie pour repartir propre.
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Je définis les permissions du CRUD Planètes.
        $perms = [
            'planets.view',   // lister/voir
            'planets.create', // créer
            'planets.edit',   // modifier
            'planets.delete', // supprimer
        ];

        // Je crée (ou retrouve) chaque permission.
        foreach ($perms as $name) {
            Permission::firstOrCreate([
                'name'       => $name,
                'guard_name' => 'web',
            ]);
        }

        // Je crée les rôles nécessaires.
        $admin  = Role::firstOrCreate(['name' => 'admin',  'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        // J’assigne les permissions aux rôles.
        $admin->syncPermissions($perms); // admin a tout
        $editor->syncPermissions(['planets.view', 'planets.create', 'planets.edit']); // éditeur limité
    }
}
