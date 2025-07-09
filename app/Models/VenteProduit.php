<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenteProduit extends Model
{
    use HasFactory;

    protected $table = 'vente_produits';

    protected $fillable = ['vente_id', 'produit_id', 'quantite', 'prix_unitaire'];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
