<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('notation/index')
@section('contenu')
    <div class="container">
        <div class="card">
            @if(count($resultats)>0)
            <div class="frame-inner">
                <header class="frame-header">
                    <div class="sec-title-one text-left">
                        <div class="titleh barre">
                            Liste de solution non validée
                        </div>
                    </div>
                </header>
            </div>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Équipe</th>
                            <th>Projet</th>
                            <th>Rapport</th>
                            <th>Business model</th>
                            <th>Autre documemnt</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultats as $resultat)
                        <tr>
                            @foreach ($equipes as $equipe)
                                @if($equipe->id == $resultat->equipe_id)
                                    <td>{{$equipe->nom_equipe}} </td>
                                @endif
                            @endforeach
                            @foreach ($projets as $projet)
                                @if($projet->equipe_id == $resultat->equipe_id)
                                    <td>{{$projet->intitule_projet}}</td>
                                @endif
                            @endforeach
                            @if($resultat->rapport!=null)
                                <td>
                                    <a href="{{$resultat->rapportUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a>
                                </td>
                            @else
                                <td></td>
                            @endif
                            @if($resultat->business_model!=null)
                                <td>
                                    <a href="{{$resultat->businessUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a>
                                </td>
                            @else
                                <td>#</td>
                            @endif
                            @if($resultat->autre_document!=null)
                                <td>
                                    <a href="{{$resultat->documentUrl()}}" target="_blank"><i class="bi bi-download btn btn-primary" style="padding: 0.375rem 0.75rem"></i></a>
                                </td>
                            @else
                                <td>#</td>
                            @endif
                            <td>{{$resultat->created_at}} </td>
                            <td>
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    @if (auth('membre')->check())
                                        <a class="btn btn-secondary" href="/gestion/dps1/{{$projet->id}}">détail du projet</a>
                                        <a class="btn btn-primary" href="/note/utilisateur1/{{$resultat->id}}">Noter</a>
                                    @elseif (auth()->check())
                                        <a class="btn btn-secondary" href="/gestion/dps/{{$projet->id}}"> détail du projet</a>
                                        <a class="btn btn-primary" href="/note/utilisateur/{{$resultat->id}}">Noter</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$resultats->links('pagination::bootstrap-5')}}
            @else
            <div class="fs-4 text-center text-primary mt-5">Pas de solutions!!</div>
            @endif
        </div>
    </div>
@endsection
