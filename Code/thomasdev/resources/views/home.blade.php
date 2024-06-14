@extends('base')
@section('content')
<div id="content" class="p-4 " style="overflow-x: auto;">
    @if ( auth('membre')->check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #ffb606!important; margin-left:40px ">
        <div class="container-fluid">
          <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
              <ul class="nav navbar-nav ml-auto " >
                @if(count($communique)>0)
                @foreach ($communique as $com )
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="communiqués et actualités disponibles">
                        <a class="nav-link" href="{{$com->documentUrl()}}" target="_blank">Communiqués</a>
                    </li>
                @endforeach
                @endif
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="contactez nous">
                    <a class="nav-link" href="{{Route('contact')}}">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="dropdown-toggle">{{auth()->guard('membre')->user()->prenom_m}}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" style="color: #f0e6ec !important;" href="{{Route('logout1')}}">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    @elseif (auth()->check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #ffb606!important; margin-left:40px ">
        <div class="container-fluid">
          <button class="btn btn-primary d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
              <ul class="nav navbar-nav ml-auto " >
                @if(count($communique)>0)
                @foreach ($communique as $com )
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="communiqués et actualités disponibles">
                        <a class="nav-link" href="{{$com->documentUrl()}}" target="_blank">Communiqués</a>
                    </li>
                @endforeach
                @endif
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="contactez nous">
                    <a class="nav-link" href="{{Route('contact')}}">Contact</a>
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
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="ctooltip" data-bs-placement="bottom" data-bs-title="contactez nous">
                    <a class="nav-link" href="{{Route('contact')}}">Contact</a>
                </li>

                <li class="nav-item" data-bs-toggle="tooltip" data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="réserver uniquement aux membres des équipes">
                    <a class="nav-link" href="{{Route('login2')}}"> <i class="bi bi-box-arrow-in-right"></i> <span>Espace équipe</span></a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
    @endif
    @if (session('success'))
        <div>
            <h4 class="alert alert-success text-center">{{session('success')}}</h4>
        </div>
    @endif
    @if (session('error'))
        <div>
            <h4 class="alert alert-danger text-center">{{session('error')}}</h4>
        </div>
    @endif
    @yield('contenu')
</div>
*
@endsection
