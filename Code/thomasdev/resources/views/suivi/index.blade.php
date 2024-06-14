@extends('base')
@section('content')
<div id="content" class="p-4 " style="overflow-x: auto;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #ffb606!important; margin-left:40px ">
      <div class="container-fluid">
        <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
            <ul class="nav navbar-nav ml-auto " >
                @if (auth('membre')->check())
                    @if(auth()->guard('membre')->user()->is_superuser && auth()->guard('membre')->user()->is_expert)
                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="création d'une équipe de recherche">
                            <a class="nav-link " href="{{Route('equipeDeRecherche1')}}">Créer une équipe de recherche</a>
                        </li>
                    @endif
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="liste des équipes de recherche">
                        <a class="nav-link " href="{{Route('allequipeDeRecherche1')}}">Liste d'équipe de recherche</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="dropdown-toggle">État d'avancement</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(auth()->guard('membre')->user()->is_expert)
                                <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('verification1')}}">Vérification</a></li>
                                <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('validation')}}">Valider une solution</a></li>
                            @endif
                            @if(auth()->guard('membre')->user()->is_superuser && !auth()->guard('membre')->user()->is_expert)
                                <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('resultatForm')}}">Soumettre une solution</a></li>
                                <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('verification1')}}">Vérification</a></li>
                            @endif
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="dropdown-toggle">{{auth()->guard('membre')->user()->prenom_m}}</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                        </ul>
                    </li>
                @elseif (auth()->check())
                    @if(auth()->user()->is_superuser)
                        <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="liste des équipes de recherche">
                            <a class="nav-link " href="{{Route('allequipeDeRecherche')}}">Liste d'équipe de recherche</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="dropdown-toggle">État d'avancement</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('verification')}}">Vérification</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (auth()->user()->image)
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{Auth::user()->imageUrl()}}" style="height: 20px; width:20px; border-radius:50%;" alt="">
                                <span class="dropdown-toggle">{{Auth::user()->username}}</span>
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="dropdown-toggle">{{Auth::user()->username}}</span>
                            </a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
      </div>
    </nav>
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    @yield('contenu')
</div>
@endsection
