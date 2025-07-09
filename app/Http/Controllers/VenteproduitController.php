<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteProduitController extends Controller
{
    public function edit($venteId, $produitId)
    {
        $vente = Vente::findOrFail($venteId);
        $produit = $vente->produits()->where('produit_id', $produitId)->first();
        $pivotData = $produit->pivot;

        return view('admin.ventes.edit_produit', compact('vente', 'produit', 'pivotData'));
    }

    public function update(Request $request, $venteId, $produitId)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        DB::table('vente_produit')
            ->where('vente_id', $venteId)
            ->where('produit_id', $produitId)
            ->update([
                'quantite' => $request->quantite,
                'prix_unitaire' => $request->prix_unitaire,
                'updated_at' => now()
            ]);

        return redirect()->route('ventes.index')->with('success', 'Produit de la vente modifié.');
    }

    public function destroy($venteId, $produitId)
    {
        DB::table('vente_produit')
            ->where('vente_id', $venteId)
            ->where('produit_id', $produitId)
            ->delete();

        return redirect()->route('ventes.index')->with('success', 'Produit supprimé de la vente.');
    }
    public function facture(Vente $vente)
{
 $vente->load('client', 'produits.produit'); // eager loading
return view('admin.ventes.facture', compact('vente'));
}

}
