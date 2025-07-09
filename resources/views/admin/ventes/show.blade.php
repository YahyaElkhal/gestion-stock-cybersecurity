@extends('adminlte::page')

@section('title', 'Facture de vente #'.$vente->id)

@section('content_header')
<div class="text-center printable-header">
    <div class="company-header">
        <h2 class="mb-0"><strong>IDBAT BATIMENT</strong></h2>
        <p class="mb-0">Bâtiment - Construction - Rénovation</p>
        <p>Tél: +212 522 22 67 89 | Email: contact@idbat.com</p>
    </div>
    <hr class="invoice-divider">
    
    <div class="d-flex justify-content-between align-items-center non-printable">
        <h1 class="m-0">Fiche de vente <span class="badge bg-secondary">#{{ $vente->id }}</span></h1>
        <div>
            
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card card-primary card-outline invoice-card">
    <div class="card-header bg-white non-printable">
        <div class="d-flex justify-content-between">
            <h3 class="card-title text-primary">
                <i class="fas fa-file-invoice mr-2"></i>Détails de la transaction
            </h3>
            <button onclick="window.print()" class="btn btn-sm btn-print">
                <i class="fas fa-print"></i> Imprimer
            </button>
        </div>
    </div>
    
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="info-box bg-light">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-user-tie"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Client</span>
                        <span class="info-box-number">
                            {{ $vente->client->nom ?? 'N/A' }}
                            <small class="text-muted ml-2">
                                {{ $vente->client->contact ?? '' }}
                            </small>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="info-box bg-light">
                    <span class="info-box-icon bg-success">
                        <i class="fas fa-info-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Statut</span>
                        <span class="info-box-number">
                            <span class="badge badge-success">Complété</span>
                            <small class="text-muted ml-2">
                                {{ $vente->created_at->format('d/m/Y H:i') }}
                            </small>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered invoice-table">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 45%">Produit</th>
                        <th class="text-center" style="width: 15%">Quantité</th>
                        <th class="text-right" style="width: 20%">Prix unitaire</th>
                        <th class="text-right" style="width: 15%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vente->venteproduits as $index => $vp)
                    @php $total = $vp->quantite * $vp->prix_unitaire; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $vp->produit->nom ?? 'Produit supprimé' }}</strong>
                            @if($vp->produit)
                            <br>
                            <small class="text-muted">Réf: {{ $vp->produit->reference ?? 'N/A' }}</small>
                            @endif
                        </td>
                        <td class="text-center">{{ $vp->quantite }}</td>
                        <td class="text-right">{{ number_format($vp->prix_unitaire, 2) }} MAD</td>
                        <td class="text-right">{{ number_format($total, 2) }} MAD</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-right">Sous-total :</th>
                        <th class="text-right">{{ number_format($vente->venteproduits->sum(function($item) { return $item->quantite * $item->prix_unitaire; }), 2) }} MAD</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Remise :</th>
                        <th class="text-right">0.00 MAD</th>
                    </tr>
                    <tr class="total-row">
                        <th colspan="4" class="text-right">Total général :</th>
                        <th class="text-right">{{ number_format($vente->venteproduits->sum(function($item) { return $item->quantite * $item->prix_unitaire; }), 2) }} MAD</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group notes-section">
                    <label class="font-weight-bold">Notes :</label>
                    <div class="notes-box">Aucune note pour cette vente.</div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="signature-box">
                    <p>Signature</p>
                    <div class="signature-line"></div>
                    <p class="signature-name">Le Vendeur</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Style général */
    .company-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .company-header h2 {
        color: #0056b3;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }
    
    .invoice-divider {
        border-top: 2px solid #0056b3;
        margin: 15px auto;
        width: 80%;
    }
    
    .invoice-table {
        font-size: 14px;
    }
    
    .total-row {
        background-color: #0056b3;
        color: white;
    }
    
    .notes-box {
        border: 1px solid #eee;
        padding: 10px;
        min-height: 80px;
        border-radius: 4px;
        background-color: #f9f9f9;
    }
    
    .signature-box {
        margin-top: 50px;
        display: inline-block;
        text-align: center;
    }
    
    .signature-line {
        width: 200px;
        border-top: 1px solid #333;
        margin: 5px auto 10px;
    }
    
    .signature-name {
        font-style: italic;
        color: #555;
    }
    
    /* Styles spécifiques à l'impression */
    @media print {
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            background: white;
            font-size: 12pt;
            color: black;
        }
        
        .non-printable {
            display: none !important;
        }
        
        .printable-header {
            margin-bottom: 20px;
        }
        
        .company-header {
            margin-top: 0;
        }
        
        .company-header h2 {
            font-size: 24pt;
        }
        
        .invoice-table {
            font-size: 10pt;
            width: 100%;
        }
        
        .card {
            border: none;
            box-shadow: none;
            padding: 0;
        }
        
        .table-responsive {
            overflow: visible;
        }
        
        .signature-box {
            margin-top: 100px;
        }
    }
    
    /* Styles pour l'écran */
    @media screen {
        .invoice-card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        
        .btn-print {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-print:hover {
            background-color: #5a6268;
        }
        
        .info-box {
            transition: all 0.3s ease;
        }
        
        .info-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Animation pour le chargement
        $('.table').fadeIn(500);
        
        // Optimisation pour l'impression
        window.onafterprint = function() {
            $('body').removeClass('printing');
        };
    });
</script>
@endsection