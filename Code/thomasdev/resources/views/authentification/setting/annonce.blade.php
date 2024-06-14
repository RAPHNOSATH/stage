@extends('authentification/setting/home')
@section('contenu')
<section class="container mt-5 mb-2">
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
            <div class="single-news mt-30" style="height: 100% !important" >
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
                            <h4 class="news-title mb-20">{{$annonce->title}}</h4>
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
@endsection
