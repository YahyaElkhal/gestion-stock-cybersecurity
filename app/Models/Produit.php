<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    
    protected $fillable = ['nom', 'description', 'quantite_en_stock', 'prix', 'categorie_id'];

    public function categorie()
{
    return $this->belongsTo(Categorie::class);
}

public function achats()
{
    return $this->belongsToMany(Achat::class, 'achat_produits')->withPivot('quantite', 'prix_unitaire');
}

public function ventes()
{
    return $this->belongsToMany(Vente::class, 'vente_produits')->withPivot('quantite', 'prix_unitaire');
}

}
