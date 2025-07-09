<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Achat;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        // Dates par défaut (mois en cours)
        $dateDebut = $request->input('date_debut', Carbon::now()->startOfMonth());
        $dateFin = $request->input('date_fin', Carbon::now()->endOfMonth());

        // Conversion en objets Carbon si ce sont des strings
        if (is_string($dateDebut)) $dateDebut = Carbon::parse($dateDebut);
        if (is_string($dateFin)) $dateFin = Carbon::parse($dateFin);

        // Données de base avec calcul dynamique
        $ventes = Vente::with('produits')
            ->whereBetween('created_at', [$dateDebut, $dateFin])
            ->get()
            ->each(function ($vente) {
                $vente->montant_calcule = $vente->produits->sum(function ($produit) {
                    return $produit->pivot->quantite * $produit->pivot->prix_unitaire;
                });
            });

        $achats = Achat::with('produits')
            ->whereBetween('created_at', [$dateDebut, $dateFin])
            ->get()
            ->each(function ($achat) {
                $achat->montant_calcule = $achat->produits->sum(function ($produit) {
                    return $produit->pivot->quantite * $produit->pivot->prix_unitaire;
                });
            });

        // Statistiques de base
        $totalVentes = $ventes->sum('montant_calcule');
        $totalAchats = $achats->sum('montant_calcule');
        $marge = $totalVentes - $totalAchats;

        return view('admin.rapports.index', compact(
            'dateDebut',
            'dateFin',
            'ventes',
            'achats',
            'totalVentes',
            'totalAchats',
            'marge'
        ));
    }
}