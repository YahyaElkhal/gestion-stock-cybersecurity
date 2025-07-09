<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer le rôle admin s’il n'existe pas
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Créer l'utilisateur admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'), // change le mot de passe plus tard !
            ]
        );

        // Assigner le rôle
        $admin->assignRole($role);
    }
}
