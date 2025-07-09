@extends('adminlte::page')

@section('title', 'Gestion des Rôles')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-user-tag"></i> Gestion des Rôles
    </h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-flat">
        <i class="fas fa-plus"></i> Créer un nouveau rôle
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
                <i class="fas fa-list"></i> Liste des rôles
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Rechercher...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 30%">Nom</th>
                        <th style="width: 50%">Permissions</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $role->name }}
                                </span>
                            </td>
                            <td>
                                @foreach($role->getPermissionNames()->chunk(4) as $chunk)
                                    <div class="mb-1">
                                        @foreach($chunk as $permission)
                                            <span class="badge badge-secondary">
                                                {{ $permission }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endforeach
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('roles.edit', $role->id) }}" 
                                   class="btn btn-sm btn-warning mr-2"
                                   data-toggle="tooltip" 
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')"
                                            data-toggle="tooltip" 
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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
    
    .badge {
        font-size: 0.85em;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .thead-light th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .btn-flat {
        border-radius: 0.25rem;
    }
    
    .card-tools .input-group {
        width: 250px;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Initialiser les tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Recherche côté client
    $('input[name="table_search"]').keyup(function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@stop