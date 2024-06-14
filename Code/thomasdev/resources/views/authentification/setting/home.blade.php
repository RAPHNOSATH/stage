@extends('base')
@section('content')
<div id="content" class="p-4 " style="overflow-x: auto;">
    @if (auth()->check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #ffb606!important; margin-left:40px ">
        <div class="container-fluid">
          <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
              <ul class="nav navbar-nav ml-auto " >
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">Gestion des comptes utilisateurs</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('users')}}">Consulter les profils utilisateurs</a></li>
                        <li style="color: #ffed !important;"><hr class="dropdown-divider" style="color: #f0e6ec !important;">Espace de création des comptes</li>
                        <li><a class="dropdown-item"  style="color: #f0e6ec !important;" href="{{Route('ministere')}}">Ministère</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('bailleurdefond')}}">Bailleur de fond</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('partenaire')}}">Partenaire</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('chercheur')}}">Chercheur</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">Gestion d'équipe </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('typeEquipe')}}">Ajouter un type d'équipe</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('equipeExperte')}}">Créer une équipe experte</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('alltype')}}">Les types d'équipe</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('equipe')}}">L'Équipe experte</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">Gestion domaine/sous domaine </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('domaine')}}">Ajouter un domaine</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('sousdomaine')}}">Ajouter un sous domaine</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('alldomaine')}}">Liste domaine/sous domaine</a></li>

                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">Actualités</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('annonce')}}">Faire une annonce</a></li>
                        <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('communique')}}">Envoyé un communiqué</a></li>
                    </ul>
                </li>
                @if (auth()->user()->image)
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{Auth::user()->imageUrl()}}" style="height: 20px; width:20px; border-radius:50%;" alt="">
                        <span class="dropdown-toggle">{{Auth::user()->username}}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item"  style="color: #f0e6ec !important;" href="#">Mon Profile</a></li>
                      <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="#">édition</a></li>
                      <li><hr class="dropdown-divider" style="color: #f0e6ec !important;"></li>
                      <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">{{Auth::user()->username}}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item"  style="color: #f0e6ec !important;" href="#">Mon Profile</a></li>
                      <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="#">édition</a></li>
                      <li><hr class="dropdown-divider" style="color: #f0e6ec !important;"></li>
                      <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                    </ul>
                </li>
                @endif

              </ul>
          </div>
        </div>
      </nav>
    @else
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #ffb606!important; margin-left:40px ">
      <div class="container-fluid">
        <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
            <ul class="nav navbar-nav ml-auto " >
                <li class="nav-item active" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="communiqués et actualités disponibles">
                    <a class="nav-link" href="{{Route('allAnnonce')}}">Annonces</a>
                </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="créer votre compte">
                  <a class="nav-link " href="{{Route('register1')}}">S'inscrire</a>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="connectez vous">
                  <a class="nav-link" href="{{Route('login1')}}">Se connecter</a>
              </li>
              <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="contactez nous">
                  <a class="nav-link" href="#">Contact</a>
              </li>

            </ul>
        </div>
      </div>
    </nav>
    @endif
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
