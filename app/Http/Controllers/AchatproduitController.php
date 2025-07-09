<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchatProduitController extends Controller
{
    public function edit($achatId, $produitId)
    {
        $achat = Achat::findOrFail($achatId);
        $produit = $achat->produits()->where('produit_id', $produitId)->first();
        $pivotData = $produit->pivot;

        return view('admin.achats.edit_produit', compact('achat', 'produit', 'pivotData'));
    }

    public function update(Request $request, $achatId, $produitId)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        DB::table('achat_produit')
            ->where('achat_id', $achatId)
            ->where('produit_id', $produitId)
            ->update([
                'quantite' => $request->quantite,
                'prix_unitaire' => $request->prix_unitaire,
                'updated_at' => now()
            ]);

        return redirect()->route('achats.index')->with('success', 'Produit de l\'achat modifié.');
    }

    public function destroy($achatId, $produitId)
    {
        DB::table('achat_produit')
            ->where('achat_id', $achatId)
            ->where('produit_id', $produitId)
            ->delete();

        return redirect()->route('achats.index')->with('success', 'Produit supprimé de l\'achat.');
    }
    public function facture(Achat $achat)
{
    $achat->load('fournisseur', 'produits.produit');
    return view('admin.achats.facture', compact('achat'));
}
}

