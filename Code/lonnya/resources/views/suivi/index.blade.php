@extends('base')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true" style="margin-right: 0px !important;">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Page</a></li>
              <li class="breadcrumb-item text-sm text-dark opacity-5" aria-current="page">suivi des projets</li>
            </ol>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 navigation" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav  justify-content-end d-flex align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Rapport de projet
                        </a>
                        <ul class="dropdown-menu" style="color: #f0e6ec !important">
                          <li><a class="dropdown-item" href="#">Soumettre un rapport de projet</a></li>
                          <li><a class="dropdown-item" href="#">Demander un rapport de projet</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Consulter un rapport de projet</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Planifier une recherche
                        </a>
                        <ul class="dropdown-menu" style="color: #f0e6ec !important">
                          <li><a class="dropdown-item" href="#">Désigner un chef de projet</a></li>
                          <li><a class="dropdown-item" href="#">Contacter un chef de projet</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Constituer l'équipe de projet</a></li>
                          <li><a class="dropdown-item" href="#">Mettre à jour l'équipe de projet</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('images/img1.jpg')}}" style="height: 20px; width:20px; border-radius:50%;" alt="">
                            <span class="dropdown-toggle">Thomas</span>
                        </a>
                        <ul class="dropdown-menu" style="color: #f0e6ec;">
                          <li><a class="dropdown-item" href="#">Mon Profile</a></li>
                          <li><a class="dropdown-item" href="#">édition</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                        </ul>
                    </li>
                    <li class="nav-item d-flex align-items-center"><a class="nav-link text-white" href="#"></a></li>
                    <li class="nav-item d-flex align-items-center"><a class="nav-link text-white" href="#"></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<section class="container" style="margin-bottom: 15%">
    <div class="card">
        <ul class="list-group list-group-horizontal-xxl">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                projet 1
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                projet 2
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                projet 3
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                projet 4
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">projet 5</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">projet 6</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">projet 7</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">projet 8</li>
            <li class="list-group-item d-flex justify-content-between align-items-center">projet 9</li>
        </ul>
    </div>
</section>
@endsection
