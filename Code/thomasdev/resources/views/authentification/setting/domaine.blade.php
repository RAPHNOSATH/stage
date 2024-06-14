@extends('authentification/setting/home')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contenu')
    <div class="container">
        <div class="card">
            @if(count($domaines)>0)
            <div class="d-flex gap-2 w-100 justify-content-end">
                <a href="{{Route('domaine')}}" class="btn btn-success">Ajouter un domaine</a>
            </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th >Domaine</th>
                            <th >Sous domaine</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($domaines as $domaine)
                        <tr>
                            <td>{{$domaine->nom_d}}</td>
                            <td>
                                @foreach($domaine->sous_domaines as $domain)
                                    <ul>
                                        <li class="d-flex gap-2 ">{{$domain->nom_s}}</li>
                                    </ul>
                                    <div class="mt-2"></div>

                                @endforeach
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 w-100 justify-content-end">
                                    <a href="{{Route('sousdomaine')}}" class="btn btn-success">Ajouter un sous domaine</a>
                                    <form action="" style="padding: 0px !important">
                                        @csrf
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="fs-4 text-center text-primary mt-5">Pas de domaine!!</div>
            @endif
        </div>
    </div>
@endsection
