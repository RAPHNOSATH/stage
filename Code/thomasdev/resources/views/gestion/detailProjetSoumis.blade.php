@extends('gestion/index')
@section('contenu')
    <div class="container">
        <div class="frame-inner">
            <header class="frame-header">
                <div class="sec-title-one text-left">
                    <div class="titleh barre">
                         Détails du projet
                    </div>
                </div>
            </header>
        </div>
        <div class="card">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >Intitulé</th>
                        <th >Domaine</th>
                        <th >Sous domaine</th>
                        <th >Description</th>
                        <th class="text-end">Document descriptif</th>
                    </tr>
                </thead>
                <tbody>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
