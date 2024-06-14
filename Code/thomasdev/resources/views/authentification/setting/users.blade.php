<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@extends('authentification/setting/home')
@section('contenu')
    <section class="container mt-2 mb-2">
        @if(count($users)>0)
        <div class="frame-containner">
            <div class="frame-inner">
                <header class="frame-header">
                    <div class="sec-title-one text-left">
                        <div class="titleh barre">
                            Les utilisateurs
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="card">
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th >ID</th>
                        <th >Nom utilisateur</th>
                        <th >Nom</th>
                        <th >Prenom</th>
                        <th >email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user )
                    <tr>
                        <td>{{$user->id}} </td>
                        <td>{{$user->username}} </td>
                        <td>{{$user->nom}} </td>
                        <td>{{$user->prenom}}</td>
                        <td>{{$user->email}}</td>
                        <td></td>
                        <td class="text-end">
                            <div  class="d-flex gap-2 w-100 justify-content-end">
                                <a href="#" style="font-size: 20px" class="text-primary" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}">Delete</a>
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression définitive</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <h4 class="alert alert-danger text-center mt-2">Attention vous êtes en train de supprimer l'utilisateur!!!</span></h4>
                                                    <hr>
                                                    <section class="container mt-5" >
                                                        <form method="POST" action="{{url('/admin/users/'.$user->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                            @csrf
                                                            @method('delete')
                                                            <div >
                                                                <p class="text-center">Voulez-vous supprimer l'utilisateur ?</p>
                                                            </div>
                                                            <div class="text-center mt-4 mb-2">
                                                                <button class="btn btn-danger mr-5">Oui</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" style="font-size: 20px" data-bs-toggle="modal" data-bs-target="#user{{ $user->id }}" class="text-danger">Edit</a>
                                <div class="modal fade" id="user{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <form method="POST" action="{{url('/admin/user/'.$user->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-md-4">
                                                                <label for="name" class="form-label">Nom utilisateur<strong style="color: red"> *</strong></label>
                                                                <input type="text" class="form-control" id="name" name="name"  value="{{ $user->username }}" required autofocus autocomplete="name">
                                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                            <label for="telephone" class="form-label">Telephone <strong style="color: red"> *</strong></label>
                                                            <input type="number" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}" required autofocus autocomplete="telephone">
                                                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required autocomplete="email">
                                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                            </div>
                                                            <div class="col-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="document" class="form-label">Document</label>
                                                                <input type="file"  id="document" name="document" autofocus autocomplete="document">
                                                                @if ($user->documentUrl() != null)
                                                                    <p>{{ $user->documentUrl() }}</p>
                                                                @endif
                                                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="contrat" class="form-label">contrat</label>
                                                                <input type="file"  id="contrat" name="contrat" autofocus autocomplete="contrat">
                                                                @if ($user->contratUrl()!= null)
                                                                    <p>{{ $user->contratUrl() }}</p>
                                                                @endif
                                                                <x-input-error :messages="$errors->get('contrat')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="cv" class="form-label">cv</label>
                                                                <input type="file"  id="cv" name="cv" autofocus autocomplete="cv">
                                                                @if ($user->cvUrl() != null)
                                                                    <p>{{ $user->cvUrl() }}</p>
                                                                @endif
                                                                <x-input-error :messages="$errors->get('cv')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-6 mt-4 text-start mb-2">
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
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </section>
    <script>
        $('delete{{ $user->id }}').on('shown.bs.modal', function () {
        var modal = $(this);
        var modalContentHeight = modal.find('.modal-content').height();
        var modalContentWidth = modal.find('.modal-content').width();

        modal.find('.modal-dialog').css({
            'max-height': modalContentHeight,
            'max-width': modalContentWidth
        });
        });
        $('user{{ $user->id }}').on('shown.bs.modal', function () {
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
