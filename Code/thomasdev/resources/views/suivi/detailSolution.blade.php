<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('suivi/index')
@section('contenu')
    <div class="container">
        <div class="card">
            <div class="frame-inner">
                <header class="frame-header">
                    <div class="sec-title-one text-left">
                        <div class="titleh barre">
                            Détails de la solution
                        </div>
                    </div>
                </header>
            </div>

                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Équipe</th>
                            <th>Projet</th>
                            <th>Début du projet</th>
                            <th>Fin du projet</th>
                            <th>État d'avancement</th>
                            <th>Delai restant</th>
                            <th>statut sur le délai</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            @foreach ($equipes as $equipe)
                                @if($equipe->id == $resultat->equipe_id)
                                    <td>{{$equipe->date_start}} </td>
                                @endif
                            @endforeach
                            @foreach ($equipes as $equipe)
                                @if($equipe->id == $resultat->equipe_id)
                                    <td>{{$equipe->delai}} </td>
                                @endif
                            @endforeach
                            <td class="text-danger">{{$resultat->etat}} % </td>
                            @foreach ($equipes as $equipe)
                                @if($equipe->id == $resultat->equipe_id)
                                    <td>{{$equipe->number_day_rest}} jours </td>
                                @endif
                            @endforeach
                            @foreach ($equipes as $equipe)
                                @if($equipe->id == $resultat->equipe_id)
                                    <td>{{$equipe->statut_delai}} </td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
@endsection
