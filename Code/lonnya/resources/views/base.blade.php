<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/images.jpg')}}">
    <link rel="icon" type="image/png" href="{{asset('images/images.jpg')}}">
    <link rel="stylesheet" href="{{asset('css/material-dashboard.min.css')}}">


    <link rel="stylesheet" href="{{asset('css/nucleo-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts/icofont.woff2')}}">
    <link rel="stylesheet" href="{{asset('css/fonts/icofont.woff')}}">
    <link rel="stylesheet" href="{{asset('build/assets/app-82c87407.css')}}">
    <link rel="stylesheet" href="{{asset('build/assets/app-87faaf6e.css')}}">
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}">


    <title>Lonnya</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="...">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script>
        function onAClick(event){
            $('.nav-link').removeClass("active");
            $(this).addClass("active");
        }
        document.querySelectorAll('a').forEach(a =>{
            a.addEventListenner('click',onAClick())
        });
    </script>

</head>
<body class="g-sidenav-show bg-gray-100" style="  max-width: 100%; overflow-x: hidden;">

    <aside class="antialiased sidenav  navbar navbar-vertical navbar-expand-xs border-0 fixed-start "  style="background-color: #C50A1F !important; height:100% !important;" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times " id="iconSidenav"></i>
            <a class="navbar-brand m-0 d-flex align-items-center" href=" https://www.uts.bf "
                target="_blank">
                <img style="height: 50px !important; width:50px !important" src="{{asset('images/images.jpg')}}" class="navbar-brand-img h-100" alt="main_logo">
                <span class=" font-weight-bold text-white" style="font-size: 35px" >Lonnya</span>
            </a>
        </div>
        <hr class="horizontal light mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="créer votre compte">
                    <a class="nav-link text-white scroll active"  href="{{ route('/') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-house-fill material-icons opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Acceuil</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white scroll" href="{{ route('gestion.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-layers-fill material-icons opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gestion des projets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white scroll" href="{{ route('suivi.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-book material-icons opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Suivi des projets</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link text-white scroll" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-bookmark-plus-fill material-icons opacity-10"></i>
                        </div>
                        <span  class="nav-link-text ms-1">Notations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white scroll " href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-messenger material-icons opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Commentaires</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white scroll" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="bi bi-bell-fill material-icons opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Notifications</span>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="horizontal light mb-2">
        <footer>
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="copyright-content">
                                <p>© <script>
                                    document.write(new Date().getFullYear())
                                  </script>  |  <a href="https://www.uts.bf" target="_blank">uts.bf</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </aside>
    <main class="main-content border-radius-lg ">
        @yield('content')
        <div class="container-fluid fixed-end" >
            <footer id="footer" class="footer  " style=" background: #02440c;">
                <!-- Footer Top -->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 ">
                                <div class="single-footer">
                                    <h2>A propos</h2>
                                    <p class="text-justify" style="font-weight: bold; font-family:Roboto; text-transform:uppercase" >LONNIYA est source pour trouver et gérer des projets stratégiques de développement et soumettre des sujets de recherche pouvant conduire à un réel développement.</p>
                                    <!-- Social -->
                                    <ul class="social">
                                        <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                        <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                                        <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                        <li><a href="#"><i class="icofont-vimeo"></i></a></li>
                                        <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                                    </ul>
                                    <!-- End Social -->
                                </div>
                            </div>
                            <div class="col-lg-4 ">
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
                            <div class="col-lg-4 ">
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

                <!--/ End Footer Top -->
                <!-- Copyright -->
                <div class="copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="copyright-content">
                                    <p>© <script>
                                        document.write(new Date().getFullYear())
                                      </script>  |  All Rights Reserved by <a href="https://www.uts.bf" target="_blank">uts.bf</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Copyright -->
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{asset('js/material-dashboard.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

</body>
</html>
