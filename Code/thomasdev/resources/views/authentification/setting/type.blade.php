@extends('authentification/setting/home')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contenu')
    <div class="container">
        <div class="card">
            @if(count($types)>0)
                <div class="d-flex gap-2 w-100 justify-content-end">
                    <a href="{{Route('typeEquipe')}}" class="btn btn-success">Ajouter un type</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th >Nom</th>
                            <th >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                        <tr>
                            <td>{{$type->nom_type}}</td>
                            <td class="text-end">
                                <div class="d-flex gap-2 w-100 justify-content-end">
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
                <div class="fs-4 text-center text-primary mt-5">Pas de type d'équipe!!</div>
            @endif
        </div>
    </div>
@endsection
