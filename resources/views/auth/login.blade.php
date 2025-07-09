@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="card mx-auto" style="max-width: 500px;">
        <h1>Connectez-vous à <span class="text-warning">Stock Manager</span></h1>
        <p class="mt-3" style="color: white">Gérez vos produits, vos ventes et vos achats en toute simplicité.</p>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3 text-start">
                    <label for="email" class="form-label" style="color: white">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label" style="color: white">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="current-password"
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2);">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 form-check text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" style="color: white" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-login">
                        {{ __('Login') }}
                    </button>

                  
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        color: white;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.05);
        border: none;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
    }

    .btn-login {
        background-color: #ffc107;
        border: none;
        color: #000;
        font-weight: 500;
    }

    .btn-login:hover {
        background-color: #e0a800;
    }

    .form-control:focus {
        background-color: rgba(255,255,255,0.1);
        color: white;
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }

    .form-check-input:checked {
        background-color: #ffc107;
        border-color: #ffc107;
    }
</style>
@endsection