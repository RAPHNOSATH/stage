<link href="css/sb-admin-2.min.css" rel="stylesheet">
@extends('notation/index')
@section('contenu')
<div class="frame-containner">
    <div class="frame-inner">
        <header class="frame-header">
            <div class="sec-title-one text-left">
                <div class="titleh barre">
                     Les Statistiques des notes
                </div>
            </div>
        </header>
    </div>
</div>
<div class="container-fluid" style="background: #3333">
    @if(count($resultats) >0)
    @foreach ($resultats as $resultat )
    @if ($resultat->membres->isNotEmpty() || $resultat->users->isNotEmpty())
    <div class="row mt-2">
        <div class="col-lg-6 mb-4 mt-4">
            <div class="card shadow mb-4" style="height: 100% !important">
                @foreach ($projets as $projet )
                    @if ($projet->equipe_id == $resultat->equipe_id)
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Les notes pour la solution du {{$projet->intitule_projet}} </h6>
                        </div>
                    @endif
                @endforeach
                <div class="card-body">
                    @if(auth('membre')->check())
                    @if ($resultat->membres->isNotEmpty())
                    @foreach ( $resultat->membres as $membre)
                        @if($membre->is_expert)
                        <div class="frame-containner">
                            <div class="frame-inner">
                                <header class="frame-header">
                                    <div class="sec-title-one text-left">
                                        <div class="titleh barre">
                                             Les notes des experts
                                        </div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        @if($membre->pivot->note >= 0 && $membre->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}} <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 25 && $membre->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 50 && $membre->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note > 75 && $membre->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                        @endif
                        @if(!$membre->is_expert)
                        <div class="frame-containner">
                            <div class="frame-inner">
                                <header class="frame-header">
                                    <div class="sec-title-one text-left">
                                        <div class="titleh barre">
                                             Les notes des non experts
                                        </div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        @if($membre->pivot->note >= 0 && $membre->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 25 && $membre->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 50 && $membre->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note > 75 && $membre->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                        @endif
                    @endforeach
                    @endif
                    @if($resultat->users->isNotEmpty())
                    <div class="frame-containner">
                        <div class="frame-inner">
                            <header class="frame-header">
                                <div class="sec-title-one text-left">
                                    <div class="titleh barre">
                                        Les notes des non experts
                                    </div>
                                </div>
                            </header>
                        </div>
                    </div>
                    @foreach ( $resultat->users as $user)

                        @if($user->pivot->note >= 0 && $user->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($user->pivot->note > 25 && $user->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($user->pivot->note > 50 && $user->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($user->pivot->note > 75 && $user->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($user->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                    @endforeach
                    @endif
                    @elseif(auth()->check())
                    @if ($resultat->membres->isNotEmpty())
                    @foreach ( $resultat->membres as $membre)
                        @if($membre->is_expert)
                        <div class="frame-containner">
                            <div class="frame-inner">
                                <header class="frame-header">
                                    <div class="sec-title-one text-left">
                                        <div class="titleh barre">
                                             Les notes des experts
                                        </div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        @if($membre->pivot->note >= 0 && $membre->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 25 && $membre->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 50 && $membre->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note > 75 && $membre->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                        @endif
                        @if(!$membre->is_expert)
                        <div class="frame-containner">
                            <div class="frame-inner">
                                <header class="frame-header">
                                    <div class="sec-title-one text-left">
                                        <div class="titleh barre">
                                             Les notes des non experts
                                        </div>
                                    </div>
                                </header>
                            </div>
                        </div>
                        @if($membre->pivot->note >= 0 && $membre->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 25 && $membre->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($membre->pivot->note > 50 && $membre->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note > 75 && $membre->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($membre->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$membre->nom_m}} {{$membre->prenom_m}}  <span class="float-right">{{$membre->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$membre->pivot->note}}%"
                                    aria-valuenow="{{$membre->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                        @endif
                    @endforeach
                    @endif
                    @if($resultat->users->isNotEmpty())
                    <div class="frame-containner">
                        <div class="frame-inner">
                            <header class="frame-header">
                                <div class="sec-title-one text-left">
                                    <div class="titleh barre">
                                        Les notes des non experts
                                    </div>
                                </div>
                            </header>
                        </div>
                    </div>
                    @foreach ( $resultat->users as $user)

                        @if($user->pivot->note >= 0 && $user->pivot->note <=25 )
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($user->pivot->note > 25 && $user->pivot->note <=50)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif($user->pivot->note > 50 && $user->pivot->note <=75)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($user->pivot->note > 75 && $user->pivot->note <=99)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @elseif ($user->pivot->note == 100)
                            <h4 style="font-size: 15px" class="small font-weight-bold">{{$user->nom}} {{$user->prenom}}  <span class="float-right">{{$user->pivot->note}}%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{$user->pivot->note}}%"
                                    aria-valuenow="{{$user->pivot->note}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endif
                    @endforeach
                    @endif
                    @endif
                </div>

                @if (auth('membre')->check())
                    <div class="mb-4">
                        <h4 class="small font-weight-bold"><a class="btn btn-primary ml-4" href="/note/details1/{{$resultat->id}}">Détails des notes</a><span class="float-right"><a class="btn btn-success mr-4" href="{{url('/note/solution/details1/'.$resultat->id)}}">Détails de la solution</a></span></h4>
                    </div>
                @elseif (auth()->check())
                    <div class="mb-4">
                        <h4 class="small font-weight-bold"><a class="btn btn-primary ml-4" href="/note/details/{{$resultat->id}}">Détails des notes</a><span class="float-right"><a class="btn btn-success mr-4" href="{{url('/note/solution/details/'.$resultat->id)}}">Détails de la solution</a></span></h4>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-lg-6 mb-4 mt-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4" style="height: 100% !important">
                <div class="card-header py-3">
                    @foreach ($projets as $projet )
                        @if ($projet->equipe_id == $resultat->equipe_id)
                            <h6 class="m-0 font-weight-bold text-primary">Note générale de la solution du {{$projet->intitule_projet}}</h6>
                        @endif
                    @endforeach
            </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="{{asset('images/undraw_posting_photo.svg')}}" alt="...">
                    </div>
                    @php
                        if ($resultat->membres->isNotEmpty()){
                            $note1 = 0;
                            $note3 = 0;
                            $n = 0;
                            $n1 = 0;
                            foreach ($resultat->membres as $membre) {
                                if(!$membre->is_expert){
                                    $note1 += $membre->pivot->note;
                                    $n = $n + 1;
                                }else{
                                    $note3 += $membre->pivot->note;
                                    $n1 = $n1 +1;
                                }
                            }
                        }
                        if ($resultat->users->isNotEmpty()){
                            $note2 = 0;
                            foreach ($resultat->users as $user) {
                            $note2 += $user->pivot->note;
                            }
                        }
                        if (count($resultat->membres) != 0 && count($resultat->users) != 0) {
                            $notes2 = ($note1 + $note2)/ ($n+count($resultat->users));
                            if($n1 != 0){
                                $notes12 = $note3/ $n1;
                            }else{
                                $notes12 = 0;
                            }
                            $notes = number_format($notes2, 2);
                            $notes1 =  number_format($notes12, 2);
                        }else if (count($resultat->membres) == 0 && count($resultat->users) != 0) {
                            $notes2 = $note2/count($resultat->users);
                            $notes12 =0;
                            $notes = number_format($notes2, 2);
                            $notes1 =  number_format($notes12, 2);
                        }else if(count($resultat->membres) != 0 && count($resultat->users) == 0){

                            if($n != 0){
                                $notes2 = $note1/$n;
                            }else{
                                $notes2 = 0;
                            }
                            if($n1 != 0){
                                $notes12 = $note3/ $n1;
                            }else{
                                $notes12 = 0;
                            }
                            $notes = number_format($notes2, 2);
                            $notes1 =  number_format($notes12, 2);
                        }
                    @endphp
                    @if($notes >= 0 && $notes <=25 )
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des non experts<span class="float-right">{{$notes}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$notes}}%"
                                aria-valuenow="{{$notes}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes >25 && $notes <=50)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des non experts<span class="float-right">{{$notes}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$notes}}%"
                                aria-valuenow="{{$notes}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes >50 && $notes <=75)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des non experts<span class="float-right">{{$notes}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$notes}}%"
                                aria-valuenow="{{$notes}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes >75 && $notes <=99)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des non experts<span class="float-right">{{$notes}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$notes}}%"
                                aria-valuenow="{{$notes}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes == 100)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des non experts<span class="float-right">{{$notes}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$notes}}%"
                                aria-valuenow="{{$notes}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif



                    @if($notes1 >= 0 && $notes1 <=25 )
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des experts<span class="float-right">{{$notes1}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$notes1}}%"
                                aria-valuenow="{{$notes1}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes1 >25 && $notes1 <=50)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des experts<span class="float-right">{{$notes1}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$notes1}}%"
                                aria-valuenow="{{$notes1}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes1 >50 && $notes1 <=75)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des experts<span class="float-right">{{$notes1}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{$notes1}}%"
                                aria-valuenow="{{$notes1}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes1 >75 && $notes1 <=99)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des experts<span class="float-right">{{$notes1}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$notes1}}%"
                                aria-valuenow="{{$notes1}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @elseif ($notes1 == 100)
                        <h4 style="font-size: 15px" class="small font-weight-bold">Note moyenne des experts<span class="float-right">{{$notes1}}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{$notes1}}%"
                                aria-valuenow="{{$notes1}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endif
</div>
@endsection
