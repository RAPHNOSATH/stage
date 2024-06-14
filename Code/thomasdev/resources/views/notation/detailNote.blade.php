<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('notation/index')
@section('contenu')
    <div class="container">
        <div class="card">
            <div class="frame-inner">
                <header class="frame-header">
                    <div class="sec-title-one text-left">
                        <div class="titleh barre">
                             Détails des notes
                        </div>
                    </div>
                </header>
            </div>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Note</th>
                            <th>Remarque</th>
                            <th>mention</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultat->notes as $note )
                        <tr>
                            @if($note->membre != null)
                            <td>{{$note->membre->nom_m}} {{$note->membre->prenom_m}}</td>
                            @elseif ($note->user != null)
                            <td>{{$note->user->nom}} {{$note->user->prenom}}</td>
                            @endif
                            <td>{{$note->note}} % </td>
                            <td>{{$note->remarque}} </td>
                            <td>{{$note->mention}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
