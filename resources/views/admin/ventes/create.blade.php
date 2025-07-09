@extends('adminlte::page')

@section('title', 'Nouvelle Vente')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-cash-register"></i> Nouvelle Vente
    </h1>
    <div>
        <a href="{{ route('ventes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="icon fas fa-ban"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="icon fas fa-check"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i> Formulaire de vente
            </h3>
        </div>

        <form action="{{ route('ventes.store') }}" method="POST" id="venteForm">
            @csrf
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_id" class="font-weight-bold">Client <span class="text-danger">*</span></label>
                            <select name="client_id" id="client_id" class="form-control select2" required>
                                <option value="">-- Sélectionner un client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->nom }} ({{ $client->contact ?? 'N/C' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_vente" class="font-weight-bold">Date de vente <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="date" name="date_vente" class="form-control" required>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold mb-0">
                        <i class="fas fa-boxes"></i> Produits vendus
                    </h5>
                    <button type="button" class="btn btn-sm btn-success" onclick="ajouterProduit()">
                        <i class="fas fa-plus"></i> Ajouter un produit
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="produits-table">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 40%">Produit</th>
                                <th style="width: 15%">Stock</th>
                                <th style="width: 15%">Quantité</th>
                                <th style="width: 15%">Prix unitaire</th>
                                <th style="width: 10%">Total</th>
                                <th style="width: 5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="produits-container">
                            <tr class="produit-item">
                                <td>
                                    <select name="produits[0][produit_id]" class="form-control select2 produit-select" required onchange="updateStock(this)">
                                        <option value="">-- Sélectionner un produit --</option>
                                        @foreach($produits as $produit)
                                            <option value="{{ $produit->id }}" data-stock="{{ $produit->quantite_en_stock }}" data-prix="{{ $produit->prix_vente ?? 0 }}">
                                                {{ $produit->nom }} ({{ $produit->reference ?? 'N/R' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="stock-display">-</td>
                                <td>
                                    <input type="number" name="produits[0][quantite]" 
                                           class="form-control quantite" 
                                           min="1" 
                                           required
                                           onchange="verifierStock(this); calculerTotal(this)">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" name="produits[0][prix_unitaire]" 
                                               class="form-control prix" 
                                               min="0" 
                                               step="0.01" 
                                               required
                                               onchange="calculerTotal(this)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">MAD</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right total">0.00 MAD</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4 offset-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-right">Total HT</th>
                                        <td class="text-right" id="totalHT">0.00 MAD</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right">TVA</th>
                                        <td class="text-right" id="totalTVA">0.00 MAD</td>
                                    </tr>
                                    <tr class="table-active">
                                        <th class="text-right">Total TTC</th>
                                        <td class="text-right font-weight-bold" id="totalTTC">0.00 MAD</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="reset" class="btn btn-secondary mr-2">
                    <i class="fas fa-undo"></i> Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer la vente
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px);
        padding: .375rem .75rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px);
    }
    
    .produit-item {
        transition: all 0.3s ease;
    }
    
    .produit-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .input-group-text {
        min-width: 40px;
        justify-content: center;
    }
    
    .stock-warning {
        color: #dc3545;
        font-weight: bold;
    }
    
    @media (max-width: 768px) {
        #produits-table th, 
        #produits-table td {
            padding: 0.5rem;
            font-size: 0.85rem;
        }
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
       

        // Set default price when product is selected
        $(document).on('change', '.produit-select', function() {
            const selectedOption = $(this).find('option:selected');
            const defaultPrice = selectedOption.data('prix');
            const prixInput = $(this).closest('tr').find('.prix');
            
            if (defaultPrice && prixInput.val() === '') {
                prixInput.val(defaultPrice.toFixed(2));
                calculerTotal(prixInput[0]);
            }
        });
    });

    let index = 1;
    function ajouterProduit() {
        const container = $('#produits-container');
        const newRow = $(`
            <tr class="produit-item">
                <td>
                    <select name="produits[${index}][produit_id]" class="form-control select2 produit-select" required onchange="updateStock(this)">
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" data-stock="{{ $produit->quantite_en_stock }}" data-prix="{{ $produit->prix_vente ?? 0 }}">
                                {{ $produit->nom }} ({{ $produit->reference ?? 'N/R' }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="stock-display">-</td>
                <td>
                    <input type="number" name="produits[${index}][quantite]" 
                           class="form-control quantite" 
                           min="1" 
                           required
                           onchange="verifierStock(this); calculerTotal(this)">
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" name="produits[${index}][prix_unitaire]" 
                               class="form-control prix" 
                               min="0" 
                               step="0.01" 
                               required
                               onchange="calculerTotal(this)">
                        <div class="input-group-append">
                            <span class="input-group-text">MAD</span>
                        </div>
                    </div>
                </td>
                <td class="text-right total">0.00 MAD</td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
        
        container.append(newRow);
        newRow.find('.select2').select2({
            placeholder: "Sélectionner",
            allowClear: true
        });
        
        index++;
    }

    function supprimerProduit(button) {
        $(button).closest('tr').remove();
        calculerTotalGeneral();
    }

    function updateStock(select) {
        const row = $(select).closest('tr');
        const selectedOption = $(select).find('option:selected');
        const stock = selectedOption.data('stock') || 0;
        
        row.find('.stock-display').text(stock);
    }

    function verifierStock(input) {
        const row = $(input).closest('tr');
        const quantite = parseInt($(input).val()) || 0;
        const stock = parseInt(row.find('.stock-display').text()) || 0;
        
        if (quantite > stock) {
            $(input).addClass('is-invalid');
            row.find('.stock-display').addClass('stock-warning');
        } else {
            $(input).removeClass('is-invalid');
            row.find('.stock-display').removeClass('stock-warning');
        }
    }

    function calculerTotal(input) {
        const row = $(input).closest('tr');
        const quantite = parseFloat(row.find('.quantite').val()) || 0;
        const prix = parseFloat(row.find('.prix').val()) || 0;
        const total = quantite * prix;
        
        row.find('.total').text(total.toFixed(2) + ' MAD');
        calculerTotalGeneral();
    }

    function calculerTotalGeneral() {
        let totalHT = 0;
        
        $('.produit-item').each(function() {
            const totalText = $(this).find('.total').text();
            const total = parseFloat(totalText) || 0;
            totalHT += total;
        });
        
        const tva = totalHT * 0.2; // Assuming 20% VAT
        const totalTTC = totalHT + tva;
        
        $('#totalHT').text(totalHT.toFixed(2) + ' MAD');
        $('#totalTVA').text(tva.toFixed(2) + ' MAD');
        $('#totalTTC').text(totalTTC.toFixed(2) + ' MAD');
    }
</script>
@stop