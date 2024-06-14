@extends('suivi/index')
@section('contenu')
@if(count($projets)>0)
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">création d'une équipe de recherche</h4>
        <h4 class="alert alert-info text-center mt-4"><span><strong style="color: red"> *</strong> indique champ obligatoire</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        @if (auth('membre')->check())
        <form method="POST" action="{{Route('equipeDeRecherche1')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Nom <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="col-md-4">
              <label for="effectif" class="form-label">Nombre des membres <strong style="color: red"> *</strong></label>
              <input type="number" class="form-control" id="effectif" name="effectif" :value="old('effectif')" required autofocus autocomplete="effectif">
              <x-input-error :messages="$errors->get('effectif')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="document" class="form-label">Cahier de charge <strong style="color: red"> *</strong></label>
                <input type="file"  id="document" name="document" required autofocus autocomplete="document">
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="projet" class="form-label">Projet <strong style="color: red"> *</strong></label>
                <select id="projet" class="form-control" name="projet" required autofocus autocomplete="projet">
                  <option selected></option>
                  @forEach($projets as $projet)
                    <option value="{{$projet->id}}">{{$projet->intitule_projet}} </option>
                  @endforEach
                </select>
            </div>
            <div class="col-md-4">
                <label for="type" class="form-label">Type d'équipe <strong style="color: red"> *</strong></label>
                <select id="type" class="form-control" name="type" required autofocus autocomplete="type">
                  <option selected value="{{$type->id}}">{{$type->nom_type}} </option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <h4 class="text-center">Délai de réalisation</h4>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="startdate" class="form-label">Début du projet <strong style="color: red"> *</strong></label>
                <input type="date" class="form-control" id="startdate" name="startdate" :value="old('startdate')" required autocomplete="startdate">
                <x-input-error :messages="$errors->get('startdate')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="delai" class="form-label">Fin de réalisation <strong style="color: red"> *</strong></label>
                <input type="date" class="form-control" id="delai" name="delai" :value="old('delai')" required autocomplete="delai">
                <x-input-error :messages="$errors->get('delai')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
              <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
        @elseif (auth()->check())
        <form method="POST" action="{{Route('equipeDeRecherche')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-4">
                <label for="name" class="form-label">Nom <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="name" name="name" :value="old('name')" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="col-md-4">
              <label for="effectif" class="form-label">Nombre des membres <strong style="color: red"> *</strong></label>
              <input type="number" class="form-control" id="effectif" name="effectif" :value="old('effectif')" required autofocus autocomplete="effectif">
              <x-input-error :messages="$errors->get('effectif')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="document" class="form-label">Cahier de charge <strong style="color: red"> *</strong></label>
                <input type="file"  id="document" name="document" required autofocus autocomplete="document">
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="projet" class="form-label">Projet <strong style="color: red"> *</strong></label>
                <select id="projet" class="form-control" name="projet" required autofocus autocomplete="projet">
                  <option selected></option>
                  @forEach($projets as $projet)
                    <option value="{{$projet->id}}">{{$projet->intitule_projet}} </option>
                  @endforEach
                </select>
            </div>
            <div class="col-md-4">
                <label for="type" class="form-label">Type d'équipe <strong style="color: red"> *</strong></label>
                <select id="type" class="form-control" name="type" required autofocus autocomplete="type">
                  <option selected value="{{$type->id}}">{{$type->nom_type}} </option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <h4 class="text-center">Délai de réalisation</h4>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="startdate" class="form-label">Début du projet <strong style="color: red"> *</strong></label>
                <input type="date" class="form-control" id="startdate" name="startdate" :value="old('startdate')" required autocomplete="startdate">
                <x-input-error :messages="$errors->get('startdate')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="delai" class="form-label">Fin de réalisation <strong style="color: red"> *</strong></label>
                <input type="date" class="form-control" id="delai" name="delai" :value="old('delai')" required autocomplete="delai">
                <x-input-error :messages="$errors->get('delai')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
              <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
        @endif
    </section>
@else
<div class="container">
    <h4 class="alert alert-info text-center mt-2">Pas de projets validés, Impossible de créer une équipe!!!</h4>
</div>
@endif
@endsection

