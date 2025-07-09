@extends('adminlte::page')

@section('title', 'Gestion des catégories')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-tags"></i> Gestion des catégories
    </h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter une catégorie
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
            <form method="GET" action="{{ route('categories.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher par nom..." 
                                   value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Rechercher
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt"></i> Réinitialiser
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-outline card-primary mt-3">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list"></i> Liste des catégories
            </h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="categories-table">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 30%">Nom</th>
                        <th style="width: 40%">Description</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                        <tr>
                            <td>#{{ str_pad($categorie->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->description ?? '-' }}</td>
                            <td class="d-flex">
                                <a href="{{ route('categories.edit', $categorie) }}" 
                                   class="btn btn-sm btn-warning mr-2"
                                   data-toggle="tooltip" 
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $categorie) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            data-toggle="tooltip" 
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x mb-2 text-muted"></i><br>
                                Aucune catégorie trouvée.
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
    
    .thead-light th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .empty-state {
        color: #6c757d;
    }
    
    #categories-table td, #categories-table th {
        vertical-align: middle;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Initialiser les tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Recherche rapide dans le tableau
    $('#quick-search').keyup(function() {
        var value = $(this).val().toLowerCase();
        $("#categories-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@stop