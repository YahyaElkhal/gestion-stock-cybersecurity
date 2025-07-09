@extends('adminlte::page')

@section('title', 'Ajouter un nouveau produit')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-box-open"></i> Ajouter un nouveau produit
    </h1>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="icon fas fa-exclamation-triangle"></i>
            <strong>Erreurs dans le formulaire :</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-info-circle"></i> Informations du produit
            </h3>
        </div>
        
        <form action="{{ route('produits.store') }}" method="POST" id="product-form">
            @csrf
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom du produit <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   value="{{ old('nom') }}" 
                                   placeholder="Entrez le nom du produit"
                                   required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categorie_id">Catégorie <span class="text-danger">*</span></label>
                            <select name="categorie_id" id="categorie_id" 
                                    class="form-control select2 @error('categorie_id') is-invalid @enderror" 
                                    required>
                                <option value="">-- Sélectionnez une catégorie --</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="3" 
                              placeholder="Décrivez le produit...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantite_en_stock">Quantité en stock <span class="text-danger">*</span></label>
                            <input type="number" name="quantite_en_stock" id="quantite_en_stock" 
                                   class="form-control @error('quantite_en_stock') is-invalid @enderror" 
                                   value="{{ old('quantite_en_stock', 0) }}" 
                                   min="0" 
                                   required>
                            @error('quantite_en_stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prix">Prix (MAD) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="prix" id="prix" 
                                       class="form-control @error('prix') is-invalid @enderror" 
                                       value="{{ old('prix') }}" 
                                       step="0.01" 
                                       min="0" 
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text">MAD</span>
                                </div>
                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-danger mr-2">
                    <i class="fas fa-undo"></i> Réinitialiser
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
<style>
    .card-outline {
        border-top: 3px solid #007bff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px);
    }
    
    .invalid-feedback {
        display: block;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Initialiser Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Sélectionnez une catégorie',
        allowClear: false
    });

    // Formater le prix lors de la saisie
    $('#prix').on('blur', function() {
        let value = parseFloat($(this).val());
        if (!isNaN(value)) {
            $(this).val(value.toFixed(2));
        }
    });
});
</script>
@stop