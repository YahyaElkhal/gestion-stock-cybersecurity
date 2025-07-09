<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categorie::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(Categorie $categorie)
{
    return view('admin.categories.edit', compact('categorie'));
}


public function update(Request $request, Categorie $categorie)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $categorie->update([
        'nom' => $request->nom,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index')->with('success', 'Catégorie modifiée avec succès.');
}


    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }
}
