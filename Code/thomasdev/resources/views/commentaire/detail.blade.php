@extends('home')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contenu')
    <section class="container mt-2">
        <div class="frame-containner">
            <div class="frame-inner">
                <header class="frame-header">
                    <div class="sec-title-one text-left">
                        <div class="titleh barre">
                             Les commentaires
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <ul class="list-group list-group-horizontal-xxl">
            @if ( auth('membre')->check())
                <a href="{{Route('projet1')}}"><li class="list-group-item active" aria-current="true"><span style="font-size: 30px" class="mr-2"><i class="bi bi-arrow-left"></i></span> <span style="font-size: 30px">{{$projet->intitule_projet}}</span></li></a>
                @if ($projet->users != null)
                @foreach ($projet->users as $user )
                <li class="list-group-item mt-3">
                    <div> <span class="text-primary mr-2"><i class="bi bi-person-bounding-box"></i></span>
                        <span style="font-size: 15px">{{$user->nom}} {{$user->prenom}}</span>
                        <span> <i class="bi bi-arrow-right"></i></span>
                        <span class="text-success mr-2"><i class="bi bi-chat-dots"></i></span>{{$user->pivot->commentaire}}
                        <span class="ml-4">{{$user->pivot->created_at}}</span>
                        <span class=" ml-4"><button type="button" data-bs-toggle="modal" data-bs-target="#users{{ $user->id }}" class="modalbutton text-success">Repondre</button></span>
                        <div class="modal fade" id="users{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Repondre à {{$user->nom}} {{$user->prenom}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <h4 class="alert alert-primary text-center mt-2">Mon commentaire</span></h4>
                                            <hr>
                                            <section class="container mt-5" >
                                                <form method="POST" action="" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                    @csrf
                                                    <div class="col-12">
                                                        <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-4 mb-2">
                                                        <button class="btn btn-primary">Envoyer</button>
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
                </li>
                <script>
                    $('users{{ $user->id }}').on('shown.bs.modal', function () {
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
                @endif
                @if ($projet->membres != null)
                @foreach ($projet->membres as $membre )
                <li class="list-group-item mt-3">
                    <div> <span class="text-primary mr-2"><i class="bi bi-person-bounding-box"></i></span>
                        <span style="font-size: 15px">{{$membre->nom_m}} {{$membre->prenom_m}}</span>
                        <span> <i class="bi bi-arrow-right"></i></span>
                        <span class="text-success mr-2"><i class="bi bi-chat-dots"></i></span>{{$membre->pivot->commentaire}}
                        <span class="ml-4">{{$membre->pivot->created_at}}</span>
                        <span class=" ml-4"><button type="button" data-bs-toggle="modal" data-bs-target="#membres{{ $membre->id }}" class="modalbutton text-success">Repondre</button></span>
                            <div class="modal fade" id="membres{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Repondre à {{$membre->nom_m}} {{$membre->prenom_m}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <h4 class="alert alert-primary text-center mt-2">Mon commentaire</span></h4>
                                                <hr>
                                                <section class="container mt-5" >
                                                    <form method="POST" action="" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                        @csrf
                                                        <div class="col-12">
                                                            <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                                        </div>
                                                        <div class="col-md-6 mt-4 mb-2">
                                                            <button class="btn btn-primary">Envoyer</button>
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
                </li>
                <script>
                    $('membres{{ $membre->id }}').on('shown.bs.modal', function () {
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
                @endif
                <div class="container mt-2">
                    <li class="bg-white">
                        <form class="form-outline" method="POST" action="{{url('/commentaire/projet1/'.$projet->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <button style="border-radius: 10rem;" type="submit" class="btn btn-info btn-rounded mt-4">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </div>
            @elseif (auth()->check())
                <a href="{{Route('projet')}}"><li class="list-group-item active" aria-current="true"><span style="font-size: 30px" class="mr-2"><i class="bi bi-arrow-left"></i></span> <span style="font-size: 30px">{{$projet->intitule_projet}}</span></li></a>
                @if ($projet->users != null)
                @foreach ($projet->users as $user )
                <li class="list-group-item mt-3">
                    <div> <span class="text-primary mr-2"><i class="bi bi-person-bounding-box"></i></span>
                        <span style="font-size: 15px">{{$user->nom}} {{$user->prenom}}</span>
                        <span> <i class="bi bi-arrow-right"></i></span>
                        <span class="text-success mr-2"><i class="bi bi-chat-dots"></i></span>{{$user->pivot->commentaire}}
                        <span class="ml-4">{{$user->pivot->created_at}}</span>
                        <span class=" ml-4"><button type="button" data-bs-toggle="modal" data-bs-target="#users{{ $user->id }}" class="modalbutton text-success">Repondre</button></span>
                        <div class="modal fade" id="users{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Repondre à {{$user->nom}} {{$user->prenom}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <h4 class="alert alert-primary text-center mt-2">Mon commentaire</span></h4>
                                            <hr>
                                            <section class="container mt-5" >
                                                <form method="POST" action="" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                    @csrf
                                                    <div class="col-12">
                                                        <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-4 mb-2">
                                                        <button class="btn btn-primary">Envoyer</button>
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

                </li>
                <script>
                    $('users{{ $user->id }}').on('shown.bs.modal', function () {
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
                @endif
                @if ($projet->membres != null)
                @foreach ($projet->membres as $membre )
                <li class="list-group-item mt-3">
                    <div> <span class="text-primary mr-2"><i class="bi bi-person-bounding-box"></i></span>
                        <span style="font-size: 15px">{{$membre->nom_m}} {{$membre->prenom_m}}</span>
                        <span> <i class="bi bi-arrow-right"></i></span>
                        <span class="text-success mr-2"><i class="bi bi-chat-dots"></i></span>{{$membre->pivot->commentaire}}
                        <span class="ml-4">{{$membre->pivot->created_at}}</span>
                        <span class=" ml-4"><button type="button" data-bs-toggle="modal" data-bs-target="#membres{{ $membre->id }}" class="modalbutton text-success">Repondre</button></span>
                        <div class="modal fade" id="membres{{ $membre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Repondre à {{$membre->nom_m}} {{$membre->prenom_m}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <h4 class="alert alert-primary text-center mt-2">Mon commentaire</span></h4>
                                            <hr>
                                            <section class="container mt-5" >
                                                <form method="POST" action="" class="row g-3 " style="background: #3333; margin-left:40px ">
                                                    @csrf
                                                    <div class="col-12">
                                                        <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                                    </div>
                                                    <div class="col-md-6 mt-4 mb-2">
                                                        <button class="btn btn-primary">Envoyer</button>
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
                </li>
                <script>
                    $('membres{{ $membre->id }}').on('shown.bs.modal', function () {
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
                @endif
                <div class="container mt-2">
                    <li class="bg-white">
                        <form class="form-outline" method="POST" action="{{url('/commentaire/projet/'.$projet->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <textarea required name="comment" style="border-radius: 20px" placeholder="Votre commentaire" class="form-control" id="comment" rows="3"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <button style="border-radius: 10rem;" type="submit" class="btn btn-info btn-rounded mt-4">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </div>
            @endif
        </ul>
    </section>

@endsection
