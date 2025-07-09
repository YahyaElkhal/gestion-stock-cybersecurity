<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    public function run()
    {
        $fournisseurs = [
            [
                'nom' => 'TechnoImport Maroc',
                'email' => 'contact@technoimport.ma',
                'telephone' => '0522334455',
                'adresse' => '45 Avenue Hassan II, Casablanca'
            ],
            [
                'nom' => 'ElectroDistrib',
                'email' => 'info@electrodistrib.ma',
                'telephone' => '0533788990',
                'adresse' => '12 Rue Mohammed V, Rabat'
            ],
            [
                'nom' => 'MegaFournitures',
                'email' => null, // Exemple sans email
                'telephone' => '0612345678',
                'adresse' => '33 Boulevard Zerktouni, Marrakech'
            ],
            [
                'nom' => 'OfficePro',
                'email' => 'ventes@officepro.ma',
                'telephone' => '0522887766',
                'adresse' => '67 Rue Palestine, Tanger'
            ],
            [
                'nom' => 'HighTech Solutions',
                'email' => 'contact@hightech.ma',
                'telephone' => '0667890123',
                'adresse' => '89 Avenue Al Amir Fal Oualou, Fès'
            ],
            [
                'nom' => 'Bureau & Co',
                'email' => 'info@bureauco.ma',
                'telephone' => '0533654789',
                'adresse' => null // Exemple sans adresse
            ],
            [
                'nom' => 'ElectroPlus',
                'email' => 'electroplus@example.com',
                'telephone' => '0678901234',
                'adresse' => '56 Avenue des FAR, Meknès'
            ],
            [
                'nom' => 'Global Import',
                'email' => 'import@global.ma',
                'telephone' => null, // Exemple sans téléphone
                'adresse' => '78 Rue de la Liberté, Oujda'
            ],
            [
                'nom' => 'TechMaroc',
                'email' => 'tech@maroc.ma',
                'telephone' => '0689012345',
                'adresse' => '90 Avenue Ibn Sina, Kénitra'
            ],
            [
                'nom' => 'Fournitures Express',
                'email' => 'express@fournitures.ma',
                'telephone' => '0690123456',
                'adresse' => '123 Rue Ibn Tachfine, Agadir'
            ]
        ];

        foreach ($fournisseurs as $fournisseur) {
            Fournisseur::create($fournisseur);
        }
    }
}