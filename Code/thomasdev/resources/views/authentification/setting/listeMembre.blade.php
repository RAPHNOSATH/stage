<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('suivi/index')
@section('contenu')
    <div class="container">
        <div class="card">

                <div class="d-flex gap-2 w-100 justify-content-between">
                    <h4>Liste des membres</h4>
                </div>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom (s)</th>
                            <th>Profession</th>
                            <th>Role</th>
                            @if (auth('membre')->check())
                                @if(auth()->guard('membre')->user()->is_superuser  && auth()->guard('membre')->user()->is_expert)
                                    <th>Chef du projet ou Adjoint ?</th>
                                    <th>Actions</th>
                                @endif
                            @elseif (auth()->check() && auth()->user()->is_superuser)
                                <th>Chef du projet ou Adjoint ?</th>
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($membres as $membre)
                            <tr>
                                <td>{{$membre->nom_m}} </td>
                                <td>{{$membre->prenom_m}} </td>
                                <td>{{$membre->profession_m}} </td>
                                @if($membre->is_superuser)
                                    <td>Chef de projet</td>
                                @elseif($membre->is_staff)
                                    <td>Adjoint de chef de projet</td>
                                @else
                                    <td>Participant</td>
                                @endif
                                @if (auth('membre')->check())
                                @if(auth()->guard('membre')->user()->is_superuser && auth()->guard('membre')->user()->is_expert)
                                <td>
                                    <button style="font-size:20px" class="modalbutton text-primary" type="button" data-bs-toggle="modal" data-bs-target="#role{{ $membre->id }}">Changer son role</button>
                                    <div class="modal fade" id="role{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Changement de role</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <section class="container mt-2" >
                                                            <form method="POST" action="{{url('/suivi/role1/'.$membre->id)}}" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                                @csrf
                                                                <div class="d-flex gap-2 w-100 justify-content-center">
                                                                    <div>
                                                                        <select name="role" id="role" required>
                                                                            <option selected value=""></option>
                                                                            <option value="Chef de projet">Chef de projet</option>
                                                                            <option value="Adjoint du chef de projet">Adjoint du chef de projet</option>
                                                                            <option value="Participant">Participant</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 w-100 justify-content-center">
                                                                    <div class="mt-4 mb-2">
                                                                        <button type="submit" class="btn btn-primary text-start">Changer</button>
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
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div class="form-check form-switch">
                                            @if ($membre->statut_membre == 'Inactif')
                                                <a class="form-check-input" href="{{url('/suivi/membre/activation1/'.$membre->id)}}"></a>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer</label>
                                            @elseif($membre->statut_membre == 'Actif')
                                                <a class="form-check-input checkeds" href="{{url('/suivi/membre/desactivation1/'.$membre->id)}}"></a>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Désactiver</label>
                                            @endif
                                        </div>
                                        <button data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Rétirer ce membre de l'équipe" class="modalbutton" type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $membre->id }}"><span class="badge bg-danger rounded-pill" style=" font-size:20px"><i class="bi bi-trash"></i></span></button>
                                        <div class="modal fade" id="delete{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression définitive</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <h4 class="alert alert-danger text-center mt-2">Attention vous êtes en train de supprimer ce membre!!!</span></h4>
                                                            <hr>
                                                            <section class="container mt-5" >
                                                                <form method="POST" action="{{url('/suivi/equipe/membre1/'.$membre->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="d-flex justify-content-center">
                                                                        <div>
                                                                            <h4 class="ml-5">Voulez-vous supprimer ce membre ?</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 w-100 justify-content-center">
                                                                        <div class="mt-4 mb-2">
                                                                            <button class="btn btn-danger">Oui</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
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
                                </td>
                                @endif
                                @elseif (auth()->check() && auth()->user()->is_superuser)
                                <td>
                                    <button style="font-size:20px!important" class="modalbutton text-primary" type="button" data-bs-toggle="modal" data-bs-target="#role{{ $membre->id }}">Changer son role</button>
                                    <div class="modal fade" id="role{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Changement de role</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <section class="container mt-2" >
                                                            <form method="POST" action="{{url('/suivi/role/'.$membre->id)}}" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                                @csrf
                                                                <div class="d-flex gap-2 w-100 justify-content-center">
                                                                    <div>
                                                                        <select name="role" id="role" required>
                                                                            <option selected value=""></option>
                                                                            <option value="Chef de projet">Chef de projet</option>
                                                                            <option value="Adjoint du chef de projet">Adjoint du chef de projet</option>
                                                                            <option value="Participant">Participant</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex gap-2 w-100 justify-content-center">
                                                                    <div class="mt-4 mb-2">
                                                                        <button type="submit" class="btn btn-primary text-start">Changer</button>
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
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 w-100 justify-content-end">
                                        <div class="form-check form-switch">
                                            @if ($membre->statut_membre == 'Inactif')
                                                <a class="form-check-input" href="{{url('/suivi/membre/activation/'.$membre->id)}}"></a>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Activer</label>
                                            @elseif($membre->statut_membre == 'Actif')
                                                <a class="form-check-input checkeds" href="{{url('/suivi/membre/desactivation/'.$membre->id)}}"></a>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Désactiver</label>
                                            @endif
                                        </div>
                                        <button data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Rétirer ce membre de l'équipe" class="modalbutton" type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $membre->id }}"><span class="badge bg-danger rounded-pill" style="font-size:20px!important"><i class="bi bi-trash"></i></span></button>
                                        <div class="modal fade" id="delete{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression définitive</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <h4 class="alert alert-danger text-center mt-2">Attention vous êtes en train de supprimer ce membre!!!</span></h4>
                                                            <hr>
                                                            <section class="container mt-5" >
                                                                <form method="POST" action="{{url('/suivi/equipe/membre/'.$membre->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="d-flex justify-content-center">
                                                                        <div>
                                                                            <h4 class="ml-5">Voulez-vous supprimer ce membre ?</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 w-100 justify-content-center">
                                                                        <div class="mt-4 mb-2">
                                                                            <button class="btn btn-danger">Oui</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
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
                                </td>
                                @endif
                            </tr>
                            <script>
                                $('delete{{ $membre->id }}').on('shown.bs.modal', function () {
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

        </div>
    </div>

@endsection

