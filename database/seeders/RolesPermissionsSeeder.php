<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Toujours vider le cache interne de Spatie avant d'altérer la matrice
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // --- Permissions (adaptées au TP Planètes)
        $perms = [
            'planets.view',
            'planets.create',
            'planets.edit',
            'planets.delete',
            'users.manage',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        // --- Rôles
        $admin  = Role::firstOrCreate(['name' => 'admin',  'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $author = Role::firstOrCreate(['name' => 'author', 'guard_name' => 'web']);
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        // --- Matrice rôles → permissions
        $admin->syncPermissions(Permission::all());

        $editor->syncPermissions([
            'planets.view',
            'planets.create',
            'planets.edit',
        ]);

        $author->syncPermissions([
            'planets.view',
            'planets.create',
        ]);

        $viewer->syncPermissions([
            'planets.view',
        ]);

        // Rafraîchir le cache des permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
