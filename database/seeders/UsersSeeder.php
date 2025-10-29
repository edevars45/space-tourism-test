<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assure-toi que RolesPermissionsSeeder a tourné avant (DatabaseSeeder ci-dessous)
        $users = [
            // --- Ton compte principal (Esther admin)
            [
                'email' => 'devarsesther@gmail.com',
                'name' => 'Esther',
                'password' => '123456789',   // sera hashé
                'role' => 'admin',
            ],

            // --- Démo / tests
            [
                'email' => 'admin@example.com',
                'name'  => 'Admin Demo',
                'password' => 'password',
                'role'  => 'admin',
            ],
            [
                'email' => 'editor@example.com',
                'name'  => 'Titi Editor',
                'password' => 'titititi',
                'role'  => 'editor',
            ],
            [
                'email' => 'author@example.com',
                'name'  => 'Tata Author',
                'password' => 'tatatata',
                'role'  => 'author',
            ],
            [
                'email' => 'viewer@example.com',
                'name'  => 'Tutu Viewer',
                'password' => 'tutututu',
                'role'  => 'viewer',
            ],
        ];

        foreach ($users as $u) {
            $newUser = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name'              => $u['name'],
                    'password'          => Hash::make($u['password']),
                    'email_verified_at' => now(),
                ]
            );

            // Nécessite que les rôles existent déjà (donc on seed d'abord RolesPermissionsSeeder)
            $newUser->syncRoles([$u['role']]);
        }
    }
}
