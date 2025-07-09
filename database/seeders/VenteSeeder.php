<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use App\Models\VenteProduit;
use Illuminate\Database\Seeder;

class VenteSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $produits = Produit::all();

        for ($i = 0; $i < 5; $i++) {
            $vente = Vente::create([
                'date_vente' => now(),
                'client_id' => $clients->random()->id,
            ]);

            $venteProduits = $produits->random(2);
            foreach ($venteProduits as $produit) {
                $quantite = rand(1, 5);
                if ($produit->quantite_en_stock >= $quantite) {
                    VenteProduit::create([
                        'vente_id' => $vente->id,
                        'produit_id' => $produit->id,
                        'quantite' => $quantite,
                        'prix_unitaire' => $produit->prix ?? rand(70, 180),
                    ]);

                    $produit->decrement('quantite_en_stock', $quantite);
                }
            }
        }
    }
}

