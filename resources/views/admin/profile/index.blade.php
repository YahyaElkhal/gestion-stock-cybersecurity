@extends('adminlte::page')

@section('title', 'Profil utilisateur')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-user-circle"></i> Mon Profil
    </h1>
    <div class="btn-group">
        <a href="{{ route('profile.edit') }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Modifier
        </a>
        
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="icon fas fa-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-info-circle mr-2"></i>Informations du compte
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=256&background=007bff&color=fff&bold=true" 
                             class="img-circle elevation-3 img-thumbnail" 
                             alt="Avatar utilisateur"
                             style="width: 180px; height: 180px; object-fit: cover;">
                        <span class="badge badge-success position-absolute" style="bottom: 10px; right: 25px;">
                            <i class="fas fa-circle"></i> En ligne
                        </span>
                    </div>
                    <h4 class="mt-3 mb-0">{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->getRoleNames()->first() }}</p>
                </div>
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 30%"><i class="fas fa-user mr-2"></i>Nom complet</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-envelope mr-2"></i>Email</th>
                                <td>
                                    <a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
                                    @if(Auth::user()->hasVerifiedEmail())
                                        <span class="badge badge-success ml-2">
                                            <i class="fas fa-check-circle"></i> Vérifié
                                        </span>
                                    @else
                                        <span class="badge badge-warning ml-2">
                                            <i class="fas fa-exclamation-circle"></i> Non vérifié
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-user-tag mr-2"></i>Rôles</th>
                                <td>
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        <span class="badge badge-primary">{{ $role }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-alt mr-2"></i>Membre depuis</th>
                                <td>
                                    {{ Auth::user()->created_at->format('d/m/Y') }}
                                    <small class="text-muted ml-2">
                                        ({{ Auth::user()->created_at->diffForHumans() }})
                                    </small>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <small class="text-muted">
                Dernière mise à jour: {{ Auth::user()->updated_at->format('d/m/Y H:i') }}
            </small>
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
    .img-thumbnail {
        border: 3px solid #dee2e6;
    }
    .badge-success {
        background-color: #28a745;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .badge-primary {
        background-color: #007bff;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Animation pour les badges de rôle
    $('.badge-primary').hover(
        function() { $(this).fadeTo(200, 0.8); },
        function() { $(this).fadeTo(200, 1); }
    );
});
</script>
@stop