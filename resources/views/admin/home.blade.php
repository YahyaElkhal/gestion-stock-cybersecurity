@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tableau de bord</h1>
@stop

@section('content')
<div class="row">
    
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $total_clients }}</h3>
                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            @if(auth()->user()->hasAnyRole(['admin', 'Manager','Vendeur']))
                <a href="{{ route('clients.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            @else
                <span class="small-box-footer" style="cursor: not-allowed; background-color: black">
                    <i class="fas fa-lock text-muted" ></i> Accès restreint
                </span>
            @endif
        </div>
    </div>
    
    <!-- Box Produits -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $total_produits }}</h3>
                <p>Produits</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            @if(auth()->user()->hasAnyRole(['admin', 'Manager']))
                <a href="{{ route('produits.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            @else
                <span class="small-box-footer" style="cursor: not-allowed; background-color: black">
                    <i class="fas fa-lock text-muted"></i> Accès restreint
                </span>
            @endif
        </div>
    </div>

    <!-- Box Ventes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $total_ventes }}</h3>
                <p>Ventes</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            @if(auth()->user()->hasAnyRole(['admin', 'Manager', 'Vendeur']))
                <a href="{{ route('ventes.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            @else
                <span class="small-box-footer" style="cursor: not-allowed; background-color: black">
                    <i class="fas fa-lock text-muted"></i> Accès restreint
                </span>
            @endif
        </div>
    </div>

    <!-- Box Achats -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $total_achats }}</h3>
                <p>Achats</p>
            </div>
            <div class="icon">
                <i class="fas fa-truck-loading"></i>
            </div>
            @if(auth()->user()->hasAnyRole(['admin', 'Manager', 'Magasinier']))
                <a href="{{ route('achats.index') }}" class="small-box-footer">
                    Plus d'infos <i class="fas fa-arrow-circle-right"></i>
                </a>
            @else
                <span class="small-box-footer" style="cursor: not-allowed; background-color: black">
                    <i class="fas fa-lock text-muted"></i> Accès restreint
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
   
</div>


<div class="row mt-3">
    
    <div class="col-md-6">
        <div class="card bg-gradient-info">
            <div class="card-body text-center">
                <h4><i class="fas fa-quote-left mr-2"></i>Motivation du Jour<i class="fas fa-quote-right ml-2"></i></h4>
                <p class="mt-3 font-italic">"Le succès n'est pas final, l'échec n'est pas fatal : c'est le courage de continuer qui compte."</p>
                <footer class="blockquote-footer">Winston Churchill</footer>
                <button class="btn btn-sm btn-light mt-2" onclick="changeQuote()">
                    <i class="fas fa-sync-alt"></i> Nouvelle citation
                </button>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Votre Progression</h3>
            </div>
            <div class="card-body">
                <div class="progress mb-3">
                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 65%" 
                         aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                        65%
                    </div>
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-trophy mr-2"></i>
                    <strong>Bravo !</strong> Vous êtes sur la bonne voie pour atteindre vos objectifs mensuels.
                </div>
                <div class="text-center">
                    <i class="fas fa-medal fa-2x text-warning"></i>
                    <p class="text-muted mt-2">Prochain badge: Star du mois (80% de performance)</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-3">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Vos Récompenses</h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4 col-md-2">
                        <i class="fas fa-star fa-3x text-warning"></i>
                        <p class="text-muted mb-0">Débutant</p>
                        <small>Première vente</small>
                    </div>
                    <div class="col-4 col-md-2">
                        <i class="fas fa-bolt fa-3x text-success"></i>
                        <p class="text-muted mb-0">Rapide</p>
                        <small>5 ventes/jour</small>
                    </div>
                    <div class="col-4 col-md-2">
                        <i class="fas fa-thumbs-up fa-3x text-info"></i>
                        <p class="text-muted mb-0">Satisfaction</p>
                        <small>95% de satisfaction</small>
                    </div>
                    <div class="col-4 col-md-2">
                        <i class="fas fa-lock fa-3x text-secondary"></i>
                        <p class="text-muted mb-0">Expert</p>
                        <small>À débloquer</small>
                    </div>
                    <div class="col-4 col-md-2">
                        <i class="fas fa-lock fa-3x text-secondary"></i>
                        <p class="text-muted mb-0">Champion</p>
                        <small>À débloquer</small>
                    </div>
                    <div class="col-4 col-md-2">
                        <i class="fas fa-lock fa-3x text-secondary"></i>
                        <p class="text-muted mb-0">Légende</p>
                        <small>À débloquer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('js')
<script>
// Fonction pour changer la citation 
function changeQuote() {
    const quotes = [
        {
            text: "La seule limite à notre réalisation de demain sera nos doutes d'aujourd'hui.",
            author: "Franklin D. Roosevelt"
        },
        {
            text: "Le succès c'est d'aller d'échec en échec sans perdre son enthousiasme.",
            author: "Winston Churchill"
        },
        {
            text: "Ne regardez pas en arrière avec colère, ni vers l'avant avec peur, mais autour de vous avec attention.",
            author: "James Thurber"
        },
        {
            text: "Le travail acharné bat le talent quand le talent ne travaille pas dur.",
            author: "Tim Notke"
        }
    ];
    
    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    document.querySelector('.card-body p.font-italic').textContent = `"${randomQuote.text}"`;
    document.querySelector('.card-body footer').textContent = randomQuote.author;
}

// Animation pour la barre de progression
$(document).ready(function() {
    $('.progress-bar').each(function() {
        const width = $(this).attr('aria-valuenow');
        $(this).css('width', '0%').animate({
            width: width + '%'
        }, 1500);
    });
});
</script>
@stop

@section('css')
<style>
    .card.bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #1f6fb2 100%);
        color: white;
    }
    .progress-bar-striped {
        background-image: linear-gradient(45deg, rgba(255,255,255,.15) 25%, transparent 25%, 
                          transparent 50%, rgba(255,255,255,.15) 50%, 
                          rgba(255,255,255,.15) 75%, transparent 75%, transparent);
        background-size: 1rem 1rem;
    }
    .fa-lock {
        opacity: 0.5;
    }
    .fa-medal {
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@stop