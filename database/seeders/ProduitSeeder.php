<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Categorie::all();

        foreach ($categories as $categorie) {
            Produit::factory()->count(5)->create([
                'categorie_id' => $categorie->id,
            ]);
        }
    }
}
