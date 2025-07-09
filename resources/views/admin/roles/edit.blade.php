@extends('adminlte::page')

@section('title', 'Modifier un Rôle')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-user-tag"></i> Modifier le rôle : {{ $role->name }}
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

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf @method('PUT')
        
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i> Informations du rôle
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nom du rôle <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $role->name) }}" 
                           placeholder="Entrez le nom du rôle" 
                           required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Permissions <span class="text-danger">*</span></label>
                    <div class="permissions-container" style="max-height: 300px; overflow-y: auto;">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" 
                                               class="custom-control-input" 
                                               id="permission-{{ $permission->id }}" 
                                               name="permissions[]" 
                                               value="{{ $permission->name }}"
                                               {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
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
    }
    
    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #007bff;
        background-color: #007bff;
    }
    
    .invalid-feedback {
        display: block;
    }
    
    .btn {
        padding: 0.375rem 1rem;
    }
</style>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Sélectionner/désélectionner toutes les permissions
    $('#select-all').click(function() {
        $('input[name="permissions[]"]').prop('checked', $(this).prop('checked'));
    });
});
</script>
@stop