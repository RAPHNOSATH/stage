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
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="validation des projets">
                        <a class="nav-link " href="{{Route('validateProject1')}}">Valider un projet</a>
                    </li>
                    @endif
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="validation des projets">
                        <a class="nav-link " href="{{Route('resultats1')}}">Liste des solutions</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="dropdown-toggle">Liste des projets</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  style="color: #f0e6ec !important;" href="{{Route('projetSoumis1')}}">Projets non validés</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('ProjetAccepte1')}}">Projets validés</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('projetEnRecherche1')}}">Projets en cours d'exécution</a></li>
                        <li><hr class="dropdown-divider" style="color: #f0e6ec !important;"></li>
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
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="soumettez vos projets">
                        <a class="nav-link " href="{{Route('ajout')}}">Soumettre un projet</a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="validation des projets">
                        <a class="nav-link " href="{{Route('resultats')}}">Liste des solutions</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="dropdown-toggle">Liste des projets</span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item"  style="color: #f0e6ec !important;" href="{{Route('projetSoumis')}}">Projets non validés</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('ProjetAccepte')}}">Projets validés</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('projetEnRecherche')}}">Projets en cours d'exécution</a></li>
                        <li><hr class="dropdown-divider" style="color: #f0e6ec !important;"></li>
                        </ul>
                    </li>
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
