@extends('adminlte::page')

@section('title', 'Nouvel Achat')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-cart-plus"></i> Nouvel Achat
    </h1>
    <div>
        <a href="{{ route('achats.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i> Formulaire d'achat
            </h3>
        </div>

        <form action="{{ route('achats.store') }}" method="POST" id="achatForm">
            @csrf
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fournisseur_id" class="font-weight-bold">Fournisseur <span class="text-danger">*</span></label>
                            <select name="fournisseur_id" id="fournisseur_id" class="form-control select2" required>
                                <option value="">-- Sélectionner un fournisseur --</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }} ({{ $fournisseur->contact ?? 'N/C' }})
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_achat" class="font-weight-bold">Date d'achat <span class="text-danger">*</span></label>
                            <div class="input-group date" >
                                <input type="date" name="date_achat" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-weight-bold mb-0">
                        <i class="fas fa-boxes"></i> Produits achetés
                    </h5>
                    <button type="button" class="btn btn-sm btn-success" onclick="ajouterProduit()">
                        <i class="fas fa-plus"></i> Ajouter un produit
                    </button>
                </div>

                <div id="produits-container">
                    <div class="produit-item card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Produit <span class="text-danger">*</span></label>
                                        <select name="produits[0][produit_id]" class="form-control select2 produit-select" required>
                                            <option value="">-- Sélectionner un produit --</option>
                                            @foreach($produits as $produit)
                                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_achat ?? 0 }}">
                                                    {{ $produit->nom }} ({{ $produit->reference ?? 'N/R' }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quantité <span class="text-danger">*</span></label>
                                        <input type="number" name="produits[0][quantite]" 
                                               class="form-control quantite" 
                                               placeholder="Qte" 
                                               min="1" 
                                               required
                                               onchange="calculerTotal(this)">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Prix unitaire <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" name="produits[0][prix_unitaire]" 
                                                   class="form-control prix" 
                                                   placeholder="Prix" 
                                                   min="0" 
                                                   step="0.01" 
                                                   required
                                                   onchange="calculerTotal(this)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">MAD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control total" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">MAD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-end justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <i class="fas fa-save"></i> Enregistrer l'achat
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
        border-left: 3px solid #007bff;
    }
    
    .produit-item:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .input-group-text {
        min-width: 40px;
        justify-content: center;
    }
    
    .datepicker {
        z-index: 9999 !important;
    }
    
    @media (max-width: 768px) {
        .produit-item .col-md-5,
        .produit-item .col-md-2 {
            margin-bottom: 15px;
        }
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js"></script>

<script>
    $(document).ready(function() {
        
        

        // Set default price when product is selected
        $(document).on('change', '.produit-select', function() {
            const selectedOption = $(this).find('option:selected');
            const defaultPrice = selectedOption.data('prix');
            const prixInput = $(this).closest('.row').find('.prix');
            
            if (defaultPrice && prixInput.val() === '') {
                prixInput.val(defaultPrice.toFixed(2));
                calculerTotal(prixInput[0]);
            }
        });
    });

    let index = 1;
    function ajouterProduit() {
        const container = $('#produits-container');
        const newItem = $(`
            <div class="produit-item card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Produit <span class="text-danger">*</span></label>
                                <select name="produits[${index}][produit_id]" class="form-control select2 produit-select" required>
                                    <option value="">-- Sélectionner un produit --</option>
                                    @foreach($produits as $produit)
                                        <option value="{{ $produit->id }}" data-prix="{{ $produit->prix_achat ?? 0 }}">
                                            {{ $produit->nom }} ({{ $produit->reference ?? 'N/R' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Quantité <span class="text-danger">*</span></label>
                                <input type="number" name="produits[${index}][quantite]" 
                                       class="form-control quantite" 
                                       placeholder="Qte" 
                                       min="1" 
                                       required
                                       onchange="calculerTotal(this)">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Prix unitaire <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="produits[${index}][prix_unitaire]" 
                                           class="form-control prix" 
                                           placeholder="Prix" 
                                           min="0" 
                                           step="0.01" 
                                           required
                                           onchange="calculerTotal(this)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MAD</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Total</label>
                                <div class="input-group">
                                    <input type="text" class="form-control total" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">MAD</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="supprimerProduit(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);
        
        container.append(newItem);
        newItem.find('.select2').select2({
            placeholder: "Sélectionner",
            allowClear: true
        });
        
        index++;
    }

    function supprimerProduit(button) {
        $(button).closest('.produit-item').remove();
        calculerTotalGeneral();
    }

    function calculerTotal(input) {
        const row = $(input).closest('.row');
        const quantite = parseFloat(row.find('.quantite').val()) || 0;
        const prix = parseFloat(row.find('.prix').val()) || 0;
        const total = quantite * prix;
        
        row.find('.total').val(total.toFixed(2));
        calculerTotalGeneral();
    }

    function calculerTotalGeneral() {
        let totalHT = 0;
        
        $('.produit-item').each(function() {
            const total = parseFloat($(this).find('.total').val()) || 0;
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