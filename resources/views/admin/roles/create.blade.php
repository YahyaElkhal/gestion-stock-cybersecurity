@extends('adminlte::page')

@section('title', 'Créer un nouveau rôle')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-user-tag"></i> Créer un nouveau rôle
    </h1>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="icon fas fa-exclamation-triangle"></i>
            <strong>Erreurs dans le formulaire :</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST" id="role-form">
        @csrf
        
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Informations du rôle
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nom du rôle <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" 
                           placeholder="Ex: Administrateur, Éditeur, etc." 
                           required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label>Permissions <span class="text-danger">*</span></label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label class="custom-control-label" for="select-all">Tout sélectionner</label>
                        </div>
                    </div>
                    
                    <div class="permissions-container" style="max-height: 400px; overflow-y: auto;">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4 mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" 
                                               class="custom-control-input" 
                                               id="permission-{{ $permission->id }}" 
                                               name="permissions[]" 
                                               value="{{ $permission->name }}"
                                               {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="permission-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error('permissions')
                        <span class="text-danger" style="font-size: 0.875em;">
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
        </div>
    </form>
</div>
@stop

@section('css')
<style>
    .card-outline {
        border-top: 3px solid #007bff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .permissions-container {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 1rem;
        background-color: #f8f9fa;
    }
    
    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #28a745;
        background-color: #28a745;
    }
    
    .invalid-feedback {
        display: block;
    }
    
    #select-all {
        cursor: pointer;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Sélectionner/désélectionner toutes les permissions
    $('#select-all').change(function() {
        $('input[name="permissions[]"]').prop('checked', $(this).prop('checked'));
    });

    // Vérifier si toutes les permissions sont cochées
    $('input[name="permissions[]"]').change(function() {
        var allChecked = $('input[name="permissions[]"]:checked').length === $('input[name="permissions[]"]').length;
        $('#select-all').prop('checked', allChecked);
    });

    // Désactiver la soumission du formulaire si aucune permission n'est sélectionnée
    $('#role-form').submit(function(e) {
        if ($('input[name="permissions[]"]:checked').length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins une permission');
        }
    });
});
</script>
@stop