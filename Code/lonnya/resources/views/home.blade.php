@extends('base')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true" style="margin-right: 0px !important;">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">

            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Page</a></li>
              <li class="breadcrumb-item text-sm text-dark opacity-5" aria-current="page">d'acceuil</li>
            </ol>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 navigation" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                          <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                          </div>
                        </a>
                    </li>

                    <li class="nav-item d-flex align-items-center" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="créer votre compte"><a class="nav-link text-white" href="{{ route('register') }}"><i class="bi bi-person-fill-add material-icons opacity-10"></i><span>S'inscrire</span></a></li>
                    <li class="nav-item d-flex align-items-center" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="connectez-vous à votre compte"><a class="nav-link text-white " href="{{ url('/login') }}"><i class="bi bi-person-check-fill material-icons opacity-10"></i><span>Se connecter</span></a></li>
                    <li class="nav-item d-flex align-items-center" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="votre profile"><a class="nav-link text-white" href="#"><i class="bi bi-person-fill material-icons opacity-10"></i><span>Contact</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<section class="container justify-content-center" style="margin-bottom: 20%">
    <div class="card container">
        <div class="row justify-content-between ">
            <div class="col-lg-3 col-md-4" style="background: #3333;">
                <div class="card-header">
                    <span style="text-transform: uppercase; font-weight:bold; font-size:22px">gouvernement</span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Les ministères gouvernementaux</h5>
                    <p class="card-text">Espace réservé aux diférents ministères du gouvernement.</p>
                    <a href="#" class="btn btn-primary">Connexion</a>
                  </div>
            </div>
            <div class="col-lg-3 col-md-4" style="background: #3333;">
                <div class="card-header">
                    <span style="text-transform: uppercase; font-weight:bold;font-size:22px">partenaire</span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Partenaires et instituts</h5>
                    <p class="card-text">Espace réservé aux différents partenaires et instituts de l'Université Thomas SANKARA.</p>
                    <a href="#" class="btn btn-primary">Connexion</a>
                  </div>
            </div>
            <div class="col-lg-3 col-md-4" style="background: #3333;">
                <div class="card-header">
                    <span style="text-transform: uppercase; font-weight:bold; font-size:22px">équipe experte</span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Equipe suivi/évaluation </h5>
                    <p class="card-text">Espace réservé à l'équipe d'évaluation et de suivi des projets.</p>
                    <a href="#" class="btn btn-primary">Connexion</a>
                  </div>
            </div>
        </div>
      </div>
</section>
@endsection
