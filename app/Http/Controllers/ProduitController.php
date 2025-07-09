<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    
    public function index(Request $request)
{
    $query = Produit::with('categorie');

    // Filtrage par nom
    if ($request->filled('search')) {
        $query->where('nom', 'like', '%' . $request->search . '%');
    }

    // Filtrage par catégorie
    if ($request->filled('categorie_id')) {
        $query->where('categorie_id', $request->categorie_id);
    }

    $produits = $query->get();
    $categories = \App\Models\Categorie::all();

    return view('admin.produits.index', compact('produits', 'categories'));
}


    public function create()
    {
        $categories = Categorie::all();
        return view('admin.produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_en_stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_en_stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }
}

