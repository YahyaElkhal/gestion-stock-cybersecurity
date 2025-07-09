@extends('adminlte::page')

@section('title', 'Gestion des Utilisateurs')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-users-cog"></i> Gestion des Utilisateurs
    </h1>
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-flat">
            <i class="fas fa-user-plus"></i> Ajouter un utilisateur
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="icon fas fa-check"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list-ol"></i> Liste des Utilisateurs
            </h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="usersTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 25%">Nom</th>
                            <th style="width: 30%">Email</th>
                            <th style="width: 25%">Rôle</th>
                            <th style="width: 20%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-light mr-3">
                                        <span class="symbol-label bg-primary text-white font-weight-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold">{{ $user->name }}</div>
                                        <div class="text-muted small">
                                            Créé le {{ $user->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->getRoleNames() as $role)
                                    <span class="badge badge-primary">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning"
                                       data-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                data-toggle="tooltip" 
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer clearfix">
           
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .symbol {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
        border-radius: 50%;
    }
    
    .symbol-40 {
        width: 40px;
        height: 40px;
    }
    
    .symbol-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
    
    .card-outline {
        border-top: 3px solid #28a745;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(40, 167, 69, 0.05);
        transform: translateY(-1px);
    }
    
    .btn-flat {
        border-radius: 0;
        box-shadow: none;
    }
    
    .btn-group .btn {
        margin-right: 2px;
        border-radius: 4px !important;
    }
    
    .badge {
        padding: 0.4em 0.8em;
        font-size: 85%;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .card-tools {
            width: 100%;
            margin-top: 10px;
        }
        
        .card-header {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('#usersTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('.search-select').select2({
    theme: 'bootstrap4',
    ajax: {
        url: '/api/users/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: data.results
            };
        },
        cache: true
    },
    minimumInputLength: 2
});
    });
</script>
@endsection