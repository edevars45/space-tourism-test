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
        app()['cache']->forget('spatie.permission.cache');

        $planets = ['planets.view','planets.create','planets.update','planets.delete'];
        $crew    = ['crew.view','crew.create','crew.update','crew.delete'];
        $all = array_merge($planets, $crew);

        foreach ($all as $name) {
            Permission::firstOrCreate(['name'=>$name,'guard_name'=>'web']);
        }

        $admin  = Role::firstOrCreate(['name'=>'admin','guard_name'=>'web']);
        $editor = Role::firstOrCreate(['name'=>'editor','guard_name'=>'web']);

        $admin->syncPermissions($all);
        $editor->syncPermissions(['planets.view','crew.view']);

        $user = User::where('email', env('ADMIN_EMAIL'))->first() ?? User::first();
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        app()['cache']->forget('spatie.permission.cache');
    }
}
