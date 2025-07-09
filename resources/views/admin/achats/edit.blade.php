@extends('adminlte::page')

@section('title', 'Modifier un achat')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-edit"></i> Modifier l'achat #{{ str_pad($achat->id, 5, '0', STR_PAD_LEFT) }}
    </h1>
    <a href="{{ route('achats.index') }}" class="btn btn-secondary btn-flat">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
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

    <form action="{{ route('achats.update', $achat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Informations de base
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fournisseur_id">Fournisseur <span class="text-danger">*</span></label>
                            <select name="fournisseur_id" id="fournisseur_id" class="form-control select2" required>
                                <option value="">-- Sélectionnez --</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ $achat->fournisseur_id == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date_achat">Date d'achat <span class="text-danger">*</span></label>
                            <input type="date" name="date_achat" id="date_achat" 
                                   class="form-control" 
                                   value="{{ $achat->date_achat }}" 
                                   required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-boxes"></i> Produits achetés
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="produits-table">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 40%">Produit</th>
                                <th style="width: 20%">Quantité</th>
                                <th style="width: 20%">Prix unitaire</th>
                                <th style="width: 15%">Total</th>
                                <th style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($achat->achatproduits as $produit)
                            <tr>
                                <td>
                                    <select name="produits[{{ $loop->index }}][produit_id]" class="form-control select2" required>
                                        @foreach($produits as $p)
                                            <option value="{{ $p->id }}" {{ $produit->produit_id == $p->id ? 'selected' : '' }}>
                                                {{ $p->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="produits[{{ $loop->index }}][quantite]" 
                                           class="form-control quantity" 
                                           value="{{ $produit->quantite }}" 
                                           min="1" 
                                           required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" 
                                           name="produits[{{ $loop->index }}][prix_unitaire]" 
                                           class="form-control price" 
                                           value="{{ $produit->prix_unitaire }}" 
                                           required>
                                </td>
                                <td class="total text-right font-weight-bold">
                                    {{ number_format($produit->quantite * $produit->prix_unitaire, 2) }} MAD
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <td colspan="3" class="text-right font-weight-bold">Total Général</td>
                                <td id="grandTotal" class="text-right font-weight-bold text-success">
                                    {{ number_format($achat->achatproduits->sum(function($item) { 
                                        return $item->quantite * $item->prix_unitaire; 
                                    }), 2) }} MAD
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <button type="button" class="btn btn-success mt-2" id="add-row">
                    <i class="fas fa-plus-circle"></i> Ajouter un produit
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('achats.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('css')
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
    
    .table tbody tr td {
        vertical-align: middle !important;
    }
    
    .card-outline {
        border-top: 3px solid;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .card-outline.card-primary {
        border-top-color: #007bff;
    }
    
    .card-outline.card-success {
        border-top-color: #28a745;
    }
    
    .btn-flat {
        border-radius: 0;
        box-shadow: none;
    }
    
    .quantity, .price {
        text-align: right;
    }
    
    .total {
        color: #28a745;
        font-weight: bold;
    }
    
    #grandTotal {
        font-size: 1.1rem;
    }
</style>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        width: '100%'
    });
    
    let index = {{ count($achat->achatproduits) }};
    const produits = @json($produits);
    
    // Add new row
    $('#add-row').click(function() {
        const newRow = `
            <tr>
                <td>
                    <select name="produits[${index}][produit_id]" class="form-control select2" required>
                        <option value="">Sélectionner un produit</option>
                        ${produits.map(p => `<option value="${p.id}">${p.nom}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <input type="number" name="produits[${index}][quantite]" 
                           class="form-control quantity" 
                           min="1" 
                           required>
                </td>
                <td>
                    <input type="number" step="0.01" 
                           name="produits[${index}][prix_unitaire]" 
                           class="form-control price" 
                           required>
                </td>
                <td class="total text-right font-weight-bold">0.00 MAD</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-row">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        
        $('#produits-table tbody').append(newRow);
        $('.select2').select2();
        index++;
    });
    
    // Remove row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculateGrandTotal();
    });
    
    // Calculate row total and grand total
    $(document).on('input', '.quantity, .price', function() {
        const row = $(this).closest('tr');
        const quantity = parseFloat(row.find('.quantity').val()) || 0;
        const price = parseFloat(row.find('.price').val()) || 0;
        const total = quantity * price;
        
        row.find('.total').text(total.toFixed(2) + ' MAD');
        calculateGrandTotal();
    });
    
    // Calculate grand total
    function calculateGrandTotal() {
        let grandTotal = 0;
        
        $('.total').each(function() {
            const value = parseFloat($(this).text().replace(' MAD', '')) || 0;
            grandTotal += value;
        });
        
        $('#grandTotal').text(grandTotal.toFixed(2) + ' MAD');
    }
});
</script>
@endsection