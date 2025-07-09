<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Achat;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\AchatProduit;
use Illuminate\Database\Seeder;

class AchatSeeder extends Seeder
{
    public function run(): void
    {
        $fournisseurs = Fournisseur::all();
        $produits = Produit::all();

        for ($i = 0; $i < 5; $i++) {
            $achat = Achat::create([
                'date_achat' => now(),
                'fournisseur_id' => $fournisseurs->random()->id,
            ]);

            $achatProduits = $produits->random(2);
            foreach ($achatProduits as $produit) {
                AchatProduit::create([
                    'achat_id' => $achat->id,
                    'produit_id' => $produit->id,
                    'quantite' => rand(10, 100),
                    'prix_unitaire' => $produit->prix ?? rand(50, 150),
                ]);

                // Mise à jour du stock
                $produit->increment('quantite_en_stock', rand(10, 100));
            }
        }
    }
}

