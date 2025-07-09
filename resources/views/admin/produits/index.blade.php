@extends('adminlte::page')

@section('title', 'Gestion des Produits')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-boxes"></i> Gestion des Produits
    </h1>
    <a href="{{ route('produits.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter un produit
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="icon fas fa-check"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtres de recherche
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('produits.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Recherche par nom</label>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-control" placeholder="Nom du produit...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Catégorie</label>
                            <select name="categorie_id" class="form-control select2">
                                <option value="">-- Toutes les catégories --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('categorie_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-search"></i> Rechercher
                            </button>
                            <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                                <i class="fas fa-sync-alt"></i> Réinitialiser
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-outline card-primary mt-3">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list"></i> Liste des produits
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    
                    
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="products-table">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th style="width: 25%">Nom</th>
                        <th style="width: 20%">Catégorie</th>
                        <th style="width: 15%">Quantité</th>
                        <th style="width: 15%">Prix (MAD)</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>
                                @if($produit->categorie)
                                    <span class="badge bg-primary">{{ $produit->categorie->nom }}</span>
                                @else
                                    <span class="badge bg-secondary">Non catégorisé</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $produit->quantite_en_stock > 10 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $produit->quantite_en_stock }}
                                </span>
                            </td>
                            <td>{{ number_format($produit->prix, 2) }}</td>
                            <td class="d-flex">
                                <a href="{{ route('produits.edit', $produit) }}" 
                                   class="btn btn-sm btn-warning mr-2"
                                   data-toggle="tooltip" 
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            data-toggle="tooltip" 
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-box-open fa-2x mb-2 text-muted"></i><br>
                                Aucun produit trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
       
    </div>
</div>
@stop

@section('css')
<style>
    .card-outline {
        border-top: 3px solid #007bff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .badge {
        font-size: 0.85em;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .thead-light th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px);
    }
    
    .empty-state {
        color: #6c757d;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Initialiser Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Sélectionnez une catégorie'
    });

    // Recherche rapide dans le tableau
    $('#table-search').keyup(function() {
        var value = $(this).val().toLowerCase();
        $("#products-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Initialiser les tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop