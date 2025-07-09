<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use App\Models\VenteProduit;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $ventes = Vente::with('client', 'produits')->get();
        return view('admin.ventes.index', compact('ventes'));
    }

    public function create()
    {
        $clients = Client::all();
        $produits = Produit::all();
        return view('admin.ventes.create', compact('clients', 'produits'));
    }

    public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date_vente' => 'required|date',
        'produits' => 'required|array|min:1',
        'produits.*.produit_id' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
        'produits.*.prix_unitaire' => 'required|numeric|min:0',
    ]);

    // Boucle pour valider stock et prix unitaire
    foreach ($request->produits as $item) {
        $produit = \App\Models\Produit::findOrFail($item['produit_id']);

        // Vérifier le stock disponible
        if ($produit->quantite_en_stock < $item['quantite']) {
            return back()->with('error', "Stock insuffisant pour le produit : {$produit->nom}. Stock disponible : {$produit->quantite_en_stock}.")->withInput();
        }

        // Vérifier que le prix de vente est >= au prix du produit
        if ($item['prix_unitaire'] < $produit->prix_unitaire) {
            return back()->with('error', "Le prix de vente pour le produit : {$produit->nom} ne peut pas être inférieur à {$produit->prix_unitaire}.")->withInput();
        }
    }

    // Création de la vente
    $vente = \App\Models\Vente::create([
        'client_id' => $request->client_id,
        'date_vente' => $request->date_vente,
    ]);

    // Association des produits à la vente
    foreach ($request->produits as $item) {
        \App\Models\VenteProduit::create([
            'vente_id' => $vente->id,
            'produit_id' => $item['produit_id'],
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix_unitaire'],
        ]);

        // Mise à jour du stock
        $produit = \App\Models\Produit::find($item['produit_id']);
        $produit->decrement('quantite_en_stock', $item['quantite']);
    }

    return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
}
    
public function show($id)
{
    $vente = Vente::with('venteProduits.produit')->findOrFail($id);

    // Récupérer le client même s'il est supprimé
    $client = Client::withTrashed()->find($vente->client_id);

    return view('admin.ventes.show', compact('vente', 'client'));
}


public function edit(Vente $vente)
{
    $clients = Client::all();
    $produits = Produit::all();
    $vente->load('venteProduits.produit');

    return view('admin.ventes.edit', compact('vente', 'clients', 'produits'));
}
public function update(Request $request, Vente $vente)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date_vente' => 'required|date',
        'produits' => 'required|array',
        'quantites' => 'required|array',
        'prix_unitaires' => 'required|array',
    ]);

    $vente->update([
        'client_id' => $request->client_id,
        'date_vente' => $request->date_vente,
    ]);

    // Supprimer les anciens
    $vente->venteproduits()->delete();

    foreach ($request->produits as $key => $produit_id) {
        $quantite = $request->quantites[$key];
        $prix_unitaire = $request->prix_unitaires[$key];

        $vente->venteproduits()->create([
            'produit_id' => $produit_id,
            'quantite' => $quantite,
            'prix_unitaire' => $prix_unitaire,
        ]);

        // Diminuer le stock
        $produit = Produit::find($produit_id);
        if ($produit) {
            $produit->quantite_en_stock -= $quantite;
            $produit->save();
        }
    }

    return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');
}

public function destroy(Vente $vente)
{
    foreach ($vente->venteProduits as $venteProduit) {
        $produit = Produit::find($venteProduit->produit_id);
        $produit->increment('quantite_en_stock', $venteProduit->quantite);
    }

    $vente->venteProduits()->delete();
    $vente->delete();

    return redirect()->route('ventes.index')->with('success', 'Vente supprimée.');
}


}

