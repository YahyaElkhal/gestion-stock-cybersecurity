@extends('adminlte::page')

@section('title', 'Modifier Utilisateur')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="m-0 text-dark">
        <i class="fas fa-user-edit"></i> Modifier Utilisateur #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
    </h1>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    

    <form action="{{ route('users.update', $user->id) }}" method="POST" id="user-update-form">
        @csrf
        @method('PUT')
        
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i> Informations de base
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role">Rôle <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control select2 @error('role') is-invalid @enderror" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" 
                                {{ old('role', $user->roles->first()->name ?? null) == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary" id="submit-btn">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </div>
    </form>
</div>
@stop

@section('css')
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        padding: 0.375rem 0.75rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
    
    .card-outline {
        border-top: 3px solid;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .card-outline.card-primary {
        border-top-color: #007bff;
    }
    
    .invalid-feedback {
        display: block;
    }
    
    #submit-btn.loading {
        position: relative;
        padding-right: 35px;
    }
    
    #submit-btn.loading:after {
        content: "\f110";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        animation: fa-spin 1s infinite linear;
    }
</style>
@endsection

@section('js')
<script>
$(document).ready(function() {
    // Initialize Select2 with better configuration
    $('.select2').select2({
        width: '100%',
        theme: 'bootstrap4',
        placeholder: "Sélectionnez un rôle",
        allowClear: true
    });

    // Form submission handler
    $('#user-update-form').on('submit', function(e) {
        const btn = $('#submit-btn');
        btn.prop('disabled', true);
        btn.addClass('loading');
        btn.html('<i class="fas fa-spinner fa-spin"></i> Enregistrement...');
    });

    // Input validation on blur
    $('input[required], select[required]').on('blur', function() {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
@endsection