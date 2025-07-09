<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;

use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        AdminUserSeeder::class,
    ]);
    $this->call([
        RolesAndPermissionsSeeder::class,
    ]);
    $this->call([
        CategorieSeeder::class,
        ClientSeeder::class,
        FournisseurSeeder::class,
        ProduitSeeder::class,
        AchatSeeder::class,
        VenteSeeder::class,
    ]);
}

}
