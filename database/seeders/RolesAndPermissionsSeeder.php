<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 🔄 Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🛡️ Créer les permissions de base
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage permissions',
            'manage clients',
            'manage produits',
            'manage achats',
            'manage ventes',
            'view rapports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 👑 Admin - toutes les permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());

        // 📋 Manager - gestion presque complète
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $manager->syncPermissions([
            'view dashboard',
            'manage clients',
            'manage produits',
            'manage achats',
            'manage ventes',
            'view rapports',
        ]);

        // 🛍️ Vendeur - accès ventes & clients
        $vendeur = Role::firstOrCreate(['name' => 'Vendeur']);
        $vendeur->syncPermissions([
            'view dashboard',
            'manage ventes',
            'manage clients',
        ]);

        // 🏪 Magasinier - accès stock et achats
        $magasinier = Role::firstOrCreate(['name' => 'Magasinier']);
        $magasinier->syncPermissions([
            'view dashboard',
            'manage produits',
            'manage achats',
        ]);

        // 👁️ Consultant - uniquement lecture
        $consultant = Role::firstOrCreate(['name' => 'Consultant']);
        $consultant->syncPermissions([
            'view dashboard',
            'view rapports',
        ]);
    }
}
