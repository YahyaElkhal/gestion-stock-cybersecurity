<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    protected $fillable = ['fournisseur_id', 'date_achat'];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'achat_produits')->withPivot('quantite', 'prix_unitaire');
    }
    public function achatproduits()
{
    return $this->hasMany(AchatProduit::class);
}
protected $casts = [
 'date_achat' => 'date',
    ];
    

}
