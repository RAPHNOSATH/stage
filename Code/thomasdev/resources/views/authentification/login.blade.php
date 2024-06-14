@extends('home')
@section('contenu')
@if (auth()->check() || auth('membre')->check())
<section class="container mt-5 mb-5">
    @if(count($annonces)>0)
    <div class="frame-containner">
        <div class="frame-inner">
            <header class="frame-header">
                <div class="sec-title-one text-left">
                    <div class="titleh barre">
                         Les annonces
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="row">
        @foreach ( $annonces as $annonce )
        <div class="col-12 col-md-6 col-lg-6">
            <div class="single-news mt-3" style="height: 100% !important">
                <div class="row align-items-center ">
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="ask-box">

                            <div class="ask-circle">
                                <span class="fa fa-bullhorn"></span>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="news-content">
                            <h4 class="news-title mb-2">{{$annonce->title}}</h4>
                            <div class="mb-2">{{$annonce->created_at}}</div>
                            <p class="mt-2"></p>
                            <div class="teaser-text">{{$annonce->content}}.</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4" >
                        <div class="ask-box">
                            <div class="ask-arrow">
                                <a href="#">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                                <a title="" href="#">
                                    <span itemprop="headline">
                                        <span class="fa fa-angle-right"></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="fs-4 text-center text-primary mt-5">Pas d'annonce!!</div>
    @endif
</section>
@else
<section id="possibilities">
    <div class="wrappere ">
        <article style="background-image: url({{asset('images/home.jpg')}});">
            <div class="overlaye">
                <img src="{{asset('images/logo.jpg')}}" alt="">
                <h4>Plateforme de gestion et suivi des projets</h4>
                <form method="POST" action="{{Route('login1')}}" >
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="Votre adresse email" required autocomplete="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 mt-2">
                            <input type="password" class="form-control" id="password" name="password" placeholder=" Votre mot de passe" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>
                     <!-- Remember Me -->
                    <div class="block mt-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>
                    <div class="row justify-content-center ">
                        <div class="col-md-6 mt-2 mb-2">
                            <button type="submit" class="form-control btn btn-primary">Se connecter</button>
                        </div>
                    </div>
                    <div class="row justify-content-between ">
                        <div class="col-12 mt-2 mb-2">
                            <a href="{{ route('password.request') }}" class="text-black ">Mot de passe oublié</a>
                            <a href="{{Route('register1')}}" style="" class="text-primary ">Pas de compte ?</a>
                        </div>
                    </div>
                </form>
            </div>
        </article>
        <div class="clear"></div>
    </div>
</section>
@endif
@endsection

