@extends('adminlte::page')

@section('title', 'Rapport Simplifié')

@section('content_header')
    <h1 class="d-flex justify-content-between">
        Rapport Simplifié
        <small class="text-muted">
            {{ $dateDebut->format('d/m/Y') }} - {{ $dateFin->format('d/m/Y') }}
        </small>
    </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="GET" class="form-inline">
            <div class="form-group mr-2">
                <label for="date_debut" class="mr-2">De</label>
                <input type="date" name="date_debut" class="form-control" 
                       value="{{ $dateDebut->format('Y-m-d') }}">
            </div>
            <div class="form-group mr-2">
                <label for="date_fin" class="mr-2">À</label>
                <input type="date" name="date_fin" class="form-control" 
                       value="{{ $dateFin->format('Y-m-d') }}">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </form>
    </div>
    
    <div class="card-body">
        <!-- Cartes de synthèse -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-cash-register"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ventes Total</span>
                        <span class="info-box-number">{{ number_format($totalVentes, 2) }} MAD</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Achats Total</span>
                        <span class="info-box-number">{{ number_format($totalAchats, 2) }} MAD</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Marge</span>
                        <span class="info-box-number">{{ number_format($marge, 2) }} MAD</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des ventes -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Détail des Ventes</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Produits</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventes as $vente)
                            <tr>
                                <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $vente->client->nom ?? 'N/A' }}</td>
                                <td>
                                    @foreach($vente->produits as $produit)
                                        {{ $produit->nom }} (x{{ $produit->pivot->quantite }})<br>
                                    @endforeach
                                </td>
                                <td class="text-right">{{ number_format($vente->montant_calcule, 2) }} MAD</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <th colspan="3">Total</th>
                                <th class="text-right">{{ number_format($totalVentes, 2) }} MAD</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .info-box {
        cursor: pointer;
        min-height: 85px;
    }
    .info-box:hover {
        opacity: 0.9;
    }
    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
@endsection