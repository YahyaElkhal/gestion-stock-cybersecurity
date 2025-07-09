<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'date_vente'];

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
    

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'vente_produits')->withPivot('quantite', 'prix_unitaire');
    }
    public function venteproduits()
{
    return $this->hasMany(VenteProduit::class);
}


}
