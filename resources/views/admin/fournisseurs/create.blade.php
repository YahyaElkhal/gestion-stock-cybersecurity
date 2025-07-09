@extends('adminlte::page')

@section('title', 'Ajouter un fournisseur')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-truck"></i> Ajouter un nouveau fournisseur
    </h1>
    <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
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
                <i class="fas fa-info-circle"></i> Informations du fournisseur
            </h3>
        </div>
        
        <form method="POST" action="{{ route('fournisseurs.store') }}" id="supplier-form">
            @csrf
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">Nom du fournisseur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" 
                                   placeholder="Entrez le nom complet" required>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="exemple@domaine.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
                                   id="telephone" name="telephone" value="{{ old('telephone') }}" 
                                  >
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <textarea class="form-control @error('adresse') is-invalid @enderror" 
                              id="adresse" name="adresse" rows="3" 
                              placeholder="Adresse complète du fournisseur">{{ old('adresse') }}</textarea>
                    @error('adresse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
    
    .invalid-feedback {
        display: block;
    }
    
    .form-control {
        border-radius: 0.25rem;
    }
    
    textarea.form-control {
        min-height: 100px;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Formatage automatique du numéro de téléphone
   
    // Validation avant soumission
    $('#supplier-form').submit(function() {
        // Vous pouvez ajouter ici des validations supplémentaires si nécessaire
        return true;
    });
});
</script>
@stop