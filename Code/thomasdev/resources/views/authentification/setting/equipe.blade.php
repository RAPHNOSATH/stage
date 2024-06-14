<!-- equipes -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('authentification/setting/home')
@section('contenu')
<div class="container">
    <div class="card">
        @if(count($equipes) > 0)
            <h4>Gestion de l'équipe experte</h4>
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th >Nom</th>
                        <th >Effectif des membres</th>
                        <th >statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipes as $equipe)
                    <tr>
                        <td style="padding: 30px !important">{{$equipe->nom_equipe}}</td>
                        @if($equipe->effectif_min > 0)
                            <td style="padding: 30px !important">{{$equipe->effectif_min}} <a class="btn btn-primary ml-2" href="{{url('/suivi/equipe/membre/'.$equipe->id)}}">Consulter la liste</a></td>
                        @else
                            <td style="padding: 30px !important">{{$equipe->effectif_min}}</td>
                        @endif
                        <td style="padding: 30px !important">{{$equipe->statut_equipe}}</td>
                        <td>
                            <div class="d-flex gap-2 w-100 justify-content-end">
                                <div class="form-check form-switch" style="padding: 20px !important">
                                    @if ($equipe->statut_equipe == 'Inactif'|| $equipe->statut_equipe == 'En pause')
                                        <a class="form-check-input" href="{{url('/suivi/activation/'.$equipe->id)}}"></a>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Activer</label>
                                    @elseif($equipe->statut_equipe == 'Actif')
                                        <a class="form-check-input checkeds" href="{{url('/suivi/desactivation/'.$equipe->id)}}"></a>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Désactiver</label>
                                    @endif
                                </div>
                                @if($equipe->statut_equipe == 'Actif')
                                    <a data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Mettre en pause l'équipe" href="{{url('/suivi/enpause/'.$equipe->id)}}"><span class="badge bg-info rounded-pill" style="margin-top:5px; padding: 20px !important; font-size:20px"><i class="bi bi-pause-circle"></i></span></a>
                                @endif
                                <button data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Suppression l'équipe avec ses membres" class="modalbutton" type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $equipe->id }}"><span class="badge bg-danger rounded-pill" style="padding: 20px !important; font-size:20px"><i class="bi bi-trash"></i></span></button>
                                <div class="modal fade" id="delete{{ $equipe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression définitive</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <h4 class="alert alert-danger text-center mt-2">Attention vous êtes en train de supprimer l'équipe avec ses membres!!!</span></h4>
                                                    <hr>
                                                    <section class="container mt-5" >
                                                        <form method="POST" action="{{url('/suivi/equipe/'.$equipe->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="col-12">
                                                                <p>Voulez-vous supprimer cette équipe ?</p>
                                                            </div>
                                                            <div class="col-md-6 mt-4 mb-2">
                                                                <button class="btn btn-danger">Oui</button>
                                                            </div>
                                                            <div class="col-md-6 mt-4 mb-2 text-end">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Éditer et modifier les informations de l'équipe" class="modalbutton" type="button" data-bs-toggle="modal" data-bs-target="#equipe{{ $equipe->id }}"><span class="badge bg-primary rounded-pill" style="padding: 20px !important; font-size:20px"><i class="bi bi-pencil-square"></i></span></button>
                                <div class="modal fade" id="equipe{{ $equipe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modification des données</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
                                                    <hr>
                                                    <section class="container mt-5" >
                                                        <form method="POST" action="{{url('/suivi/equipe/'.$equipe->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-md-4">
                                                                <label for="name" class="form-label">Nom <strong style="color: red"> *</strong></label>
                                                                <input type="text" class="form-control" id="name" name="name"  value="{{ $equipe->nom_equipe }}" required autofocus autocomplete="name">
                                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                            <label for="effectif" class="form-label">Nombre des membres <strong style="color: red"> *</strong></label>
                                                            <input type="number" class="form-control" id="effectif" name="effectif" value="{{ $equipe->effectif }}" required autofocus autocomplete="effectif">
                                                            <x-input-error :messages="$errors->get('effectif')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{$equipe->email_equipe}}" required autocomplete="email">
                                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                            </div>
                                                            <div class="col-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="document" class="form-label">Cahier de charge</label>
                                                                <input type="file"  id="document" name="document" autofocus autocomplete="document">
                                                                <p>{{ $equipe->documentUrl() }}</p>
                                                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-6 mt-4 mb-2">
                                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                                            </div>
                                                            <div class="col-md-6 mt-4 mb-2 text-end">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button data-bs-custom-class="tooltip" data-bs-placement="bottom" data-bs-title="Ajouter un membre à l'équipe" class="modalbutton" type="button" data-bs-toggle="modal" data-bs-target="#membre{{ $equipe->id }}"><span class="badge bg-success rounded-pill" style="padding: 20px !important; font-size:20px"><i class="bi bi-person-fill-add"></i></span></button>
                                <!-- Modal -->
                                <div class="modal fade" id="membre{{ $equipe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout d'un membre</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
                                                    <hr>
                                                </div>
                                                <section class="container mt-5" >
                                                    <form method="POST" action="{{url('/suivi/equipe/'.$equipe->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                        @csrf
                                                        <div class="col-md-4">
                                                            <label for="name" class="form-label">Nom<strong style="color: red"> *</strong></label>
                                                            <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
                                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                        </div>
                                                        <div class="col-md-4">
                                                        <label for="prenom" class="form-label">Prénom (s)<strong style="color: red"> *</strong></label>
                                                        <input type="text" class="form-control" id="prenom" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom">
                                                        <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="profession" class="form-label">Profession <strong style="color: red"> *</strong></label>
                                                            <input type="text" class="form-control" id="profession" name="profession" :value="old('profession')" required autofocus autocomplete="profession">
                                                            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <label for="cv" class="form-label">CV <strong style="color: red"> *</strong></label>
                                                            <input type="file"  id="cv" name="cv" :value="old('cv')" required autofocus autocomplete="cv">
                                                            <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                                                        </div>

                                                        <div class="col-md-4 mt-4">
                                                            <label for="email" class="form-label">E-mail <strong style="color: red"> *</strong></label>
                                                            <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                        </div>
                                                        <div class="col-md-4 mt-4">
                                                            <label for="password" class="form-label">Mot de passe <strong style="color: red"> *</strong></label>
                                                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                                        </div>
                                                        <div class="col-md-4 mt-4">
                                                            <label for="password_confirmation" class="form-label">Confirmation du mot de passe <strong style="color: red"> *</strong></label>
                                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                        </div>
                                                        <div class="col-md-6 mt-4 mb-2">
                                                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                                                        </div>
                                                        <div class="col-md-6 mt-4 mb-2 text-end">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        </div>
                                                    </form>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$equipes->links('pagination::bootstrap-5')}}
        @else
            <div class="fs-4 text-center text-primary mt-5">Pas d'équipe experte!!</div>
        @endif
    </div>
</div>
<script>
    $('membre{{ $equipe->id }}').on('shown.bs.modal', function () {
    var modal = $(this);
    var modalContentHeight = modal.find('.modal-content').height();
    var modalContentWidth = modal.find('.modal-content').width();

    modal.find('.modal-dialog').css({
        'max-height': modalContentHeight,
        'max-width': modalContentWidth
    });
    });

    $('equipe{{ $equipe->id }}').on('shown.bs.modal', function () {
    var modal = $(this);
    var modalContentHeight = modal.find('.modal-content').height();
    var modalContentWidth = modal.find('.modal-content').width();

    modal.find('.modal-dialog').css({
        'max-height': modalContentHeight,
        'max-width': modalContentWidth
    });
    });

    $('delete{{ $equipe->id }}').on('shown.bs.modal', function () {
    var modal = $(this);
    var modalContentHeight = modal.find('.modal-content').height();
    var modalContentWidth = modal.find('.modal-content').width();

    modal.find('.modal-dialog').css({
        'max-height': modalContentHeight,
        'max-width': modalContentWidth
    });
    });
</script>

@endsection
