<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\AchatProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::with('fournisseur', 'produits')->get();
        return view('admin.achats.index', compact('achats'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $produits = Produit::all();
        return view('admin.achats.create', compact('fournisseurs', 'produits'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $achat = Achat::create([
                'fournisseur_id' => $request->fournisseur_id,
                'date_achat' => $request->date_achat,
            ]);
    
            foreach ($request->produits as $produitData) {
                AchatProduit::create([
                    'achat_id' => $achat->id,
                    'produit_id' => $produitData['produit_id'],
                    'quantite' => $produitData['quantite'],
                    'prix_unitaire' => $produitData['prix_unitaire'],
                ]);
    
                // Mise à jour du stock
                $produit = Produit::find($produitData['produit_id']);
                $produit->quantite_en_stock += $produitData['quantite'];
                $produit->save();
            }
        });
    
        return redirect()->route('achats.index')->with('success', 'Achat enregistré avec mise à jour du stock.');
    }
    public function show($id)
{
    $achat = Achat::with('fournisseur', 'achatproduits.produit')->findOrFail($id);
    return view('admin.achats.show', compact('achat'));
}
public function edit(Achat $achat)
{
    $fournisseurs = Fournisseur::all();
    $produits = Produit::all();
    $achat->load('achatProduits.produit');

    return view('admin.achats.edit', compact('achat', 'fournisseurs', 'produits'));
}
public function update(Request $request, Achat $achat)
{
    $request->validate([
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'date_achat' => 'required|date',
        'produits' => 'required|array|min:1',
        'produits.*.produit_id' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
        'produits.*.prix_unitaire' => 'required|numeric|min:0',
    ]);

    // Restaurer le stock précédent
    foreach ($achat->achatProduits as $achatProduit) {
        $produit = Produit::find($achatProduit->produit_id);
        $produit->decrement('quantite_en_stock', $achatProduit->quantite);
    }

    $achat->update([
        'fournisseur_id' => $request->fournisseur_id,
        'date_achat' => $request->date_achat,
    ]);

    $achat->achatProduits()->delete();

    foreach ($request->produits as $item) {
        AchatProduit::create([
            'achat_id' => $achat->id,
            'produit_id' => $item['produit_id'],
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix_unitaire'],
        ]);

        $produit = Produit::find($item['produit_id']);
        $produit->increment('quantite_en_stock', $item['quantite']);
    }

    return redirect()->route('achats.index')->with('success', 'Achat mis à jour.');
}

public function destroy(Achat $achat)
{
    foreach ($achat->achatProduits as $achatProduit) {
        $produit = Produit::find($achatProduit->produit_id);
        $produit->decrement('quantite_en_stock', $achatProduit->quantite);
    }

    $achat->achatProduits()->delete();
    $achat->delete();

    return redirect()->route('achats.index')->with('success', 'Achat supprimé.');
}

}

