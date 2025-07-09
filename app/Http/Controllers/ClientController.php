<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Notifications\NouvelleNotification;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $clients = $query->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'nullable|email',
            'telephone' => 'required|nullable|string|max:20',
            'adresse' => 'required|nullable|string',
        ]);

        Client::create($request->all());
       
    
        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client modifié');
    }

    public function destroy(Client $client)
{
    $client->delete(); // Soft delete
    return redirect()->route('clients.index')->with('success', 'Client supprimé.');
}

}