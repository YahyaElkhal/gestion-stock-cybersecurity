@extends('adminlte::page')

@section('title', 'Gestion des fournisseurs')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-truck"></i> Gestion des fournisseurs
    </h1>
    <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter un fournisseur
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
            <form method="GET" action="{{ route('fournisseurs.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" 
                                   class="form-control" 
                                   placeholder="Rechercher par nom, email ou téléphone..." 
                                   value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Rechercher
                                </button>
                                <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
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
                <i class="fas fa-list"></i> Liste des fournisseurs
            </h3>
           
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap" id="suppliers-table">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 8%">ID</th>
                        <th style="width: 20%">Nom</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 15%">Téléphone</th>
                        <th style="width: 25%">Adresse</th>
                        <th style="width: 12%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fournisseurs as $fournisseur)
                        <tr>
                            <td>#{{ str_pad($fournisseur->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $fournisseur->nom }}</td>
                            <td>
                                @if($fournisseur->email)
                                    <a href="mailto:{{ $fournisseur->email }}">{{ $fournisseur->email }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($fournisseur->telephone)
                                    <a href="tel:{{ $fournisseur->telephone }}">{{ $fournisseur->telephone }}</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $fournisseur->adresse ?? '-' }}</td>
                            <td class="d-flex">
                                <a href="{{ route('fournisseurs.edit', $fournisseur) }}" 
                                   class="btn btn-sm btn-warning mr-2"
                                   data-toggle="tooltip" 
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('fournisseurs.destroy', $fournisseur) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            data-toggle="tooltip" 
                                            title="Supprimer"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fournisseur ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x mb-2 text-muted"></i><br>
                                Aucun fournisseur trouvé.
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
    
    #suppliers-table td, #suppliers-table th {
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
        $("#suppliers-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@stop