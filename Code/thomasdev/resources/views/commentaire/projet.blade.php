@extends('home')
@section('contenu')
@if(count($projets)>0)
<section class="container mt-2">
    <div class="frame-containner">
        <div class="frame-inner">
            <header class="frame-header">
                <div class="sec-title-one text-left">
                    <div class="titleh barre">
                         Les projets non validés
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th >Intitulé</th>
                    <th >Domaine</th>
                    <th >Sous domaine</th>
                    <th>Description</th>
                    <th>Document descriptif</th>
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projets as $projet)
                    @if(!$projet->est_accepte)
                        <tr>
                            <td>{{$projet->intitule_projet}}</td>
                            <td>{{$projet->sous_domaine->domaine->nom_d}}</td>
                            <td>{{$projet->sous_domaine->nom_s}}</td>
                            <td>{{$projet->description_projet}}</td>
                            @if($projet->document_descriptif!=null)
                                <td><a href="{{$projet->documentUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a></td>
                                @else
                                <td></td>
                            @endif
                            <td class="text-end">
                                @if ( auth('membre')->check())
                                    @if ($projet->commentaires->isNotEmpty())
                                        @if ($projet->commentaires->last()->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->commentaires->last()->nombre_c}} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{$projet->commentaires->last()->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @elseif (auth()->check())
                                    @if ($projet->commentaires->isNotEmpty())
                                        @if ($projet->commentaires->last()->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->commentaires->last()->nombre_c }} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{$projet->commentaires->last()->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<section class="container mt-5">
    <div class="frame-containner">
        <div class="frame-inner">
            <header class="frame-header">
                <div class="sec-title-one text-left">
                    <div class="titleh barre">
                         Les projets validés
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th >Intitulé</th>
                    <th >Domaine</th>
                    <th >Sous domaine</th>
                    <th>Description</th>
                    <th>Document descriptif</th>
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projets as $projet)
                    @if($projet->est_accepte && !$projet->en_recherche)
                        <tr>
                            <td>{{$projet->intitule_projet}}</td>
                            <td>{{$projet->sous_domaine->domaine->nom_d}}</td>
                            <td>{{$projet->sous_domaine->nom_s}}</td>
                            <td>{{$projet->description_projet}}</td>
                            @if($projet->document_descriptif!=null)
                                <td><a href="{{$projet->documentUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a></td>
                            @else
                                <td></td>
                            @endif
                            <td class="text-end">
                                @if ( auth('membre')->check())
                                    @if ($projet->users->isNotEmpty() && $projet->users->last()->pivot)
                                        @if ($projet->users->last()->pivot->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @elseif (auth()->check())
                                    @if ($projet->users->isNotEmpty() && $projet->users->last()->pivot)
                                        @if ($projet->users->last()->pivot->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<section class="container mt-5">
    <div class="frame-containner">
        <div class="frame-inner">
            <header class="frame-header">
                <div class="sec-title-one text-left">
                    <div class="titleh barre">
                         Les projets en cours de recherche
                    </div>
                </div>
            </header>
        </div>
    </div>
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th >Intitulé</th>
                    <th >Domaine</th>
                    <th >Sous domaine</th>
                    <th>Description</th>
                    <th>Document descriptif</th>
                    <th>Commentaires</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projets as $projet)
                    @if($projet->en_recherche)
                        <tr>
                            <td>{{$projet->intitule_projet}}</td>
                            <td>{{$projet->sous_domaine->domaine->nom_d}}</td>
                            <td>{{$projet->sous_domaine->nom_s}}</td>
                            <td>{{$projet->description_projet}}</td>
                            @if($projet->document_descriptif!=null)
                                <td><a href="{{$projet->documentUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a></td>
                                @else
                                <td></td>
                            @endif
                            <td class="text-end">
                                @if ( auth('membre')->check())
                                    @if ($projet->users->isNotEmpty() && $projet->users->last()->pivot)
                                        @if ($projet->users->last()->pivot->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet1/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @elseif (auth()->check())
                                    @if ($projet->users->isNotEmpty() && $projet->users->last()->pivot)
                                        @if ($projet->users->last()->pivot->nombre_c <= 1)
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comment</a>
                                        @else
                                            <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">{{ $projet->users->last()->pivot->nombre_c }} comments</a>
                                        @endif
                                    @else
                                        <a href="{{ url('/commentaire/projet/'.$projet->id) }}" class="commentProject text-primary">0 comment</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endif
@endsection
