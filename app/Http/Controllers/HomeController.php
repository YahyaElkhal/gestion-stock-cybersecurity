<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

        return view('admin.home', [
            'total_clients' => Client::count(),
            'total_produits' => Produit::count(),
            'total_ventes' => Vente::count(),
            'total_achats' => Achat::count(),
            
            
        ]);
    }
}