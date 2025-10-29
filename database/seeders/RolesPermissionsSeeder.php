<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 0) Toujours purger le cache Spatie avant de modifier la matrice
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // 1) Permissions (TP Planètes)
        $perms = [
            'planets.view',
            'planets.create',
            'planets.edit',
            'planets.update',   // ← important si ton middleware l’utilise
            'planets.delete',
            'users.manage',
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        }

        // 2) Rôles (tu gardes ta matrice)
        $admin  = Role::firstOrCreate(['name' => 'admin',  'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $author = Role::firstOrCreate(['name' => 'author', 'guard_name' => 'web']);
        $viewer = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        // 3) Attribution des permissions par rôle
        $admin->syncPermissions(Permission::all());

        $editor->syncPermissions([
            'planets.view',
            'planets.create',
            'planets.edit',
            'planets.update',   // ← si tu veux que editor puisse aussi sauver les modifs
        ]);

        $author->syncPermissions([
            'planets.view',
            'planets.create',
        ]);

        $viewer->syncPermissions([
            'planets.view',
        ]);

        // 4) (Optionnel) Auto-assigner le rôle admin à un email connu
        //    Mets ADMIN_EMAIL dans .env, ex: ADMIN_EMAIL=devarsesther@gmail.com
        $adminEmail = env('ADMIN_EMAIL', 'devarsesther@gmail.com');
        if ($u = User::where('email', $adminEmail)->first()) {
            $u->assignRole('admin');
        }

        // 5) Re-purger le cache Spatie après modifications
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
