@extends('adminlte::page')

@section('title', 'Gestion des Ventes')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-cash-register"></i> Gestion des Ventes
    </h1>
    <div class="d-flex">
        <a href="{{ route('ventes.create') }}" class="btn btn-primary btn-flat">
            <i class="fas fa-plus"></i> Nouvelle Vente
        </a>
        <button class="btn btn-secondary btn-flat ml-2" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimer
        </button>
    </div>
</div>
@endsection

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
                <i class="fas fa-list-ol"></i> Liste des Ventes
            </h3>
           
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="ventesTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" style="width: 5%">#ID</th>
                            <th style="width: 30%">Client</th>
                            <th class="text-center" style="width: 15%">Date Vente</th>
                            <th class="text-center" style="width: 15%">Montant Total</th>
                            <th class="text-center" style="width: 20%">Statut</th>
                            <th class="text-center" style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventes as $vente)
                        @php
                            $totalAmount = $vente->venteproduits->sum(function($item) {
                                return $item->quantite * $item->prix_unitaire;
                            });
                        @endphp
                        <tr>
                            <td class="text-center">{{ str_pad($vente->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-light mr-3">
                                        <span class="symbol-label bg-success text-white font-weight-bold">
                                            {{ substr($vente->client->nom ?? 'N/A', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="font-weight-bold">{{ $vente->client->nom ?? 'N/A' }}</div>
                                        <div class="text-muted small">{{ $vente->client->contact ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}
                                <div class="text-muted small">
                                    {{ \Carbon\Carbon::parse($vente->date_vente)->diffForHumans() }}
                                </div>
                            </td>
                            <td class="text-right font-weight-bold">
                                {{ number_format($totalAmount, 2) }} MAD
                            </td>
                            <td class="text-center">
                                @if ($vente->client && $vente->client->trashed())
                                    <span class="badge badge-danger">
                                        <i class="fas fa-exclamation-circle"></i> Client supprimé
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Complété
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('ventes.show', $vente->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       data-toggle="tooltip" 
                                       title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('ventes.edit', $vente->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       data-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('ventes.destroy', $vente->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette vente?');">
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
    </div>
</div>
@endsection

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
        
       
        
        // Make table rows clickable
        $('.clickable-row').click(function() {
            window.location = $(this).data('href');
        });
    });
</script>
@endsection