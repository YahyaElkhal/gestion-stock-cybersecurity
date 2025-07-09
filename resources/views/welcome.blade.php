<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Manager</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
            font-size: 2.5rem;
            font-weight: bold;
        }

        .btn-login {
            background-color: #ffc107;
            border: none;
        }

        .btn-login:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card mx-auto" style="max-width: 500px;">
            <h1>Bienvenue sur <span class="text-warning">Stock Manager</span></h1>
            <p class="mt-3" style="color: white">Gérez vos produits, vos ventes et vos achats en toute simplicité.</p>

            @if (Route::has('login'))
                <div class="mt-4">
                    @auth
                        <a href="{{ url('/admin') }}" class="btn btn-success px-4">Accéder au Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-login px-4">Se connecter</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>
