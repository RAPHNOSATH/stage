<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('suivi/index')
@section('contenu')
    <div class="container">
        <div class="card">
            @if(count($resultats)>0)
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <h4>Validation des solutions</h4>
                </div>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Équipe</th>
                            <th>Projet</th>
                            <th>Rapport</th>
                            <th>Business model</th>
                            <th>Autre documemnt</th>
                            <th>État d'avancement</th>
                            <th class="text-end">Actions</th>
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
                                <td>#</td>
                            @endif
                            @if ($resultat->business_model!=null)
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
                            <td>{{$resultat->etat}} % </td>
                            <td>
                                <div class="d-flex gap-2 w-100 justify-content-center">
                                    <div>
                                        <a data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Valider cette solution" data-bs-toggle="modal" data-bs-target="#validated{{ $resultat->id }}" class="btn btn-primary" href="#">Valider</a>
                                        <div class="modal fade" id="validated{{ $resultat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Validation de la solution</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <section class="container mt-2" >
                                                                <form method="POST" action="{{url('/suivi/validation/resultats/'.$resultat->id)}}" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                                    @csrf
                                                                    <div class="d-flex gap-2 w-100 justify-content-center">
                                                                        <div>
                                                                            <select name="name" id="name" required>
                                                                                <option selected value=""></option>
                                                                                <option value="Valider le rapport">Valider le rapport</option>
                                                                                <option value="Valider le business_model">Valider le business_model</option>
                                                                                <option value="Valider le document supplémentaire">Valider le document supplémentaire</option>
                                                                                <option value="Valider le projet sur le terrain">Valider le projet sur le terrain</option>
                                                                                <option value="Valider complètement la solution">Valider complètement la solution</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 w-100 justify-content-center">
                                                                        <div class="mt-4 mb-2">
                                                                            <button type="submit" class="btn btn-primary text-start">Valider</button>
                                                                            <button type="button" class="btn btn-secondary text-end" data-bs-dismiss="modal">Annuler</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <a data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Publier cette solution"  class="btn btn-primary" href="{{url('/suivi/solution/publier/'.$resultat->id)}}">Publier</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <script>
                            $('validated{{ $resultat->id }}').on('shown.bs.modal', function () {
                            var modal = $(this);
                            var modalContentHeight = modal.find('.modal-content').height();
                            var modalContentWidth = modal.find('.modal-content').width();

                            modal.find('.modal-dialog').css({
                                'max-height': modalContentHeight,
                                'max-width': modalContentWidth
                            });
                            });
                        </script>
                        @endforeach
                    </tbody>
                </table>
                {{$resultats->links('pagination::bootstrap-5')}}
            @else
            <div class="fs-4 text-center text-primary mt-5">Pas de solutions non publiées!!</div>
            @endif
        </div>
    </div>
@endsection
