<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Je crée/MAJ des utilisateurs et j’assigne les rôles Spatie.
     * Idempotent : relancer ce seeder ne duplique rien.
     */
    public function run(): void
    {
        // Suppose que RolesPermissionsSeeder a déjà tourné
        // (Dans DatabaseSeeder, appelle RolesPermissionsSeeder AVANT UsersSeeder.)

        $users = [
            // --- Ton compte principal (admin)
            [
                'email'    => 'devarsesther@gmail.com',
                'name'     => 'esther',
                'password' => '123456789', // sera hashé
                'role'     => 'admin',
            ],

            // --- Démo / tests
            [
                'email'    => 'admin@example.com',
                'name'     => 'Admin Demo',
                'password' => 'password',
                'role'     => 'admin',
            ],
            [
                'email'    => 'planet@example.com',
                'name'     => 'Titi Planet',
                'password' => 'titititi',
                'role'     => 'planetManager',   // gestionnaire Planètes
            ],
            [
                'email'    => 'crew@example.com',
                'name'     => 'Tata Crew',
                'password' => 'tatatata',
                'role'     => 'crewManager',     // gestionnaire Équipage
            ],

            // (Optionnel) ajoute d’autres rôles si tu veux
            // [
            //     'email'    => 'tech@example.com',
            //     'name'     => 'Tutu Tech',
            //     'password' => 'tutututu',
            //     'role'     => 'techManager',  // pour Partie 6 Technologies
            // ],
        ];

        foreach ($users as $u) {
            // 1) S’assurer que le rôle existe (sinon on le crée côté Spatie)
            if (!empty($u['role'])) {
                Role::firstOrCreate([
                    'name'       => $u['role'],
                    'guard_name' => 'web',
                ]);
            }

            // 2) Créer/MAJ l’utilisateur (clé = email)
            $user = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name'              => $u['name'],
                    'password'          => Hash::make($u['password']),
                    'email_verified_at' => now(),
                ]
            );

            // 3) Assigner le rôle
            if (!empty($u['role'])) {
                $user->syncRoles([$u['role']]);
            }
        }
    }
}
