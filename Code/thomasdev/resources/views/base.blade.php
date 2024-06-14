<!doctype html>
<html lang="en">
  <head>
  	<title>GS_PRO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/comment.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Inclure Tailwind CSS -->
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    @livewireStyles
  </head>
  <body style="overflow-x: hidden;">
	    <div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>
                <h1><a href="#" class="logo my-5">GS_PRO</a></h1>
                <hr>
                <ul class="list-unstyled components mb-5">
                    @if (auth('membre')->check())
                        <li>
                            <a href="{{Route('home')}}"><span class="fa fa-home mr-3"></span> Acceuil</a>
                        </li>
                        <li>
                            <a href="{{Route('projetSoumis1')}}"><span><i class="bi bi-kanban-fill"></i></span> Gestion des projets</a>
                        </li>
                        <li>
                            <a href="{{Route('allequipeDeRecherche1')}}"><span class="bi bi-pc-display-horizontal mr-3"></span> Suivi des des projets</a>
                        </li>
                        <li>
                            <a href="{{Route('projet1')}}"><span class="bi bi-chat-dots-fill mr-3"></span> Commentaires</a>
                        </li>
                        <li>
                            <a href="{{Route('acceuil1')}}"><span><i class="bi bi-layers-fill"></i></span> Notations</a>
                        </li>

                    @elseif (auth()->check())
                        <li>
                            <a href="{{Route('home')}}"><span class="fa fa-home mr-3"></span> Acceuil</a>
                        </li>
                        <li>
                            <a href="{{Route('projetSoumis')}}"><span><i class="bi bi-kanban-fill"></i></span> Gestion des projets</a>
                        </li>
                        @if(auth()->user()->is_staff || auth()->user()->is_superuser)
                            <li>
                                <a href="{{Route('allequipeDeRecherche')}}"><span class="bi bi-pc-display-horizontal mr-3"></span> Suivi des des projets</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{Route('projet')}}"><span class="bi bi-chat-dots-fill mr-3"></span> Commentaires</a>
                        </li>
                        @if(auth()->user()->is_staff || auth()->user()->is_superuser)
                            <li>
                                <a href="{{Route('acceuil')}}"><span><i class="bi bi-layers-fill"></i></span> Notations</a>
                            </li>
                        @endif

                        @if(auth()->user()->is_superuser)
                            <li>
                                <a href="{{Route('equipe')}}"><span class="bi bi-gear mr-3"></span> Paramètres</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{Route('home')}}"><span class="fa fa-home mr-3"></span> Acceuil</a>
                        </li>

                        <li class="mt-3 mb-3 "> <a href="#"><span style="color: #ffed !important;" class=" text-start">Espace compte</span></a></li>
                        <li>
                            <a href="{{Route('register1')}}">
                                <i class="bi bi-person-circle"></i>
                                <span>S'inscrire</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{Route('login1')}}">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Se connecter</span>
                            </a>
                        </li>
                    @endif
                </ul>
    	    </nav>
            @yield('content')
        </div>
        <div class="container-fluid" style=" background: #02440c">
            <footer id="footer" class="footer">
                <!-- Footer Top -->
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 col-sm-4">
                                <div class="single-footer f-link">
                                    <h2>A propos</h2>
                                    <ul>
                                        <li><a href="#" style="text-transform: uppercase"><i class="fa fa-caret-right" aria-hidden="true"></i>LONNIYA est source pour conduire à un réel développement</a></li>
                                        <li><a href="#" style="text-transform: uppercase"><i class="fa fa-caret-right" aria-hidden="true"></i>gérer et suivi des projets stratégiques de développement</a></li>
                                        <li><a href="#" style="text-transform: uppercase" ><i class="fa fa-caret-right" aria-hidden="true"></i>soumettre des sujets de recherche</a></li>
                                     </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="single-footer f-link">
                                    <h2>Liens utiles</h2>
                                    <ul>
                                        <li><a href="https://www.mesrsi.gov.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Mesrsi</a></li>
                                        <li><a href="https://www.campusfaso.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>CampusFAso</a></li>
                                        <li><a href="https://www.lecames.org" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Cames</a></li>
                                        <li><a href="https://www.cenou.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>cenou</a></li>
                                        <li><a href="https://www.foner.gov.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Foner</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <div class="single-footer f-link">
                                    <h2>Universités publics</h2>
                                    <ul>
                                        <li><a href="https://www.uv.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Université virtuelle</a></li>
                                        <li><a href="https://www.ujkz.net" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Université Joseph ki zerbo</a></li>
                                        <li><a href="https://www.univ-bobo.gov.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Université Nazi boni</a></li>
                                        <li><a href="https://www.unz.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Université norbert zongo</a></li>
                                        <li><a href="https://www.uts.bf" style="text-transform: uppercase" target="_blank"><i class="fa fa-caret-right" aria-hidden="true"></i>université thomas sankara</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <div class="copyright-content">
                                        <p>
                                            ©<script>document.write(new Date().getFullYear())</script>
                                            | All Rights Reserved by <a href="https://www.uts.bf" target="_blank">uts.bf</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </footer>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-custom-class="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })


    /// Sélectionnez le sidebar en fonction de son ID ou de sa classe
const sidebar = document.getElementById('sidebar'); // Si l'ID du sidebar est "sidebar"
// Ou
// const sidebar = document.querySelector('.sidebar'); // Si le sidebar a une classe "sidebar"

// Sélectionnez les liens à l'intérieur du sidebar
const links = sidebar.querySelectorAll('nav ul li a');

// Ajoutez l'écouteur d'événement à chaque lien du sidebar
links.forEach(link => {
    link.addEventListener('click', () => {
        // Supprimez la classe 'active' de tous les liens du sidebar
        links.forEach(l => {
            l.classList.remove('actives');
        });
        // Ajoutez la classe 'active' au lien actuellement cliqué
        link.classList.add('actives');
    });
});

// Vérifiez l'URL lors du chargement de la page
window.addEventListener('DOMContentLoaded', () => {
    links.forEach(link => {
        // Vérifiez si l'URL de la page correspond à l'attribut href du lien
        if (window.location.href.includes(link.href)) {
            // Ajoutez la classe 'active' au lien correspondant à l'URL de la page
            link.classList.add('actives');
        }
    });
});

// Ajoutez un écouteur d'événement au document pour détecter les clics
document.addEventListener('click', event => {
    const target = event.target;
    // Vérifiez si le clic est sur un lien en dehors du sidebar
    if (sidebar.contains(target) && target.closest('#sidebar')) {
        // Si le clic est en dehors du sidebar, ne rien faire
        return;
    }
    // Supprimez la classe 'active' de tous les liens du sidebar sauf celui cliqué
    links.forEach(link => {
        if (link != target && !target.closest('#sidebar')) {
            link.classList.remove('actives');
        }
    });
});
    </script>
     @livewireScripts
  </body>
</html>
