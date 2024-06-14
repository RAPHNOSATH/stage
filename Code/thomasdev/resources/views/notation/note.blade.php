@extends('notation/index')
@section('contenu')
<div class="frame-containner">
    <div class="frame-inner">
        <header class="frame-header">
            <div class="sec-title-one text-left">
                <div class="titleh barre">
                    Donner votre notre
                </div>
            </div>
        </header>
    </div>
</div>
<div class="container-fluid">
    <h4 class=" text-center mt-2"><span class="alert alert-primary"><strong style="color: red"> *</strong> indique champ obligatoire</span></h4>
    @if (auth('membre')->check())
    <form method="POST" action="/note/utilisateur1/{{$resultat->id}}"  class="row g-3 mt-4" style="background: #3333; margin-left:40px ">
        @csrf
        <div class="col-md-4">
            <label for="note" class="form-label">Note de la solution / 100 <strong style="color: red"> *</strong></label>
            <input type="number" class="form-control" id="note" name="note" :value="old('note')" required autofocus autocomplete="note">
            <x-input-error :messages="$errors->get('note')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="remarque" class="form-label">Votre remarque <strong style="color: red"> *</strong></label>
            <input type="text" class="form-control" id="remarque" name="remarque" :value="old('remarque')" required autofocus autocomplete="remarque">
            <x-input-error :messages="$errors->get('remarque')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="mention" class="form-label">Mention de la solution <strong style="color: red"> *</strong></label>
            <select class="form-control" name="mention" id="mention" required>
                <option selected value=""></option>
                <option value="Très mauvaise">Très mauvaise</option>
                <option value="Mauvaise">Mauvaise</option>
                <option value="Passable">Passable</option>
                <option value="Assez bien">Assez bien</option>
                <option value="Bien">Bien</option>
                <option value="Très bien">Très bien</option>
                <option value="Excellente">Excellente</option>
            </select>
            <x-input-error :messages="$errors->get('mention')" class="mt-2" />
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12 mt-2 mb-2">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
    @elseif (auth()->check())
    <form method="POST" action="/note/utilisateur/{{$resultat->id}}"  class="row g-3 mt-4" style="background: #3333; margin-left:40px ">
        @csrf
        <div class="col-md-4">
            <label for="note" class="form-label">Note de la solution / 100 <strong style="color: red"> *</strong></label>
            <input type="number" class="form-control" id="note" name="note" :value="old('note')" required autofocus autocomplete="note">
            <x-input-error :messages="$errors->get('note')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="remarque" class="form-label">Votre remarque <strong style="color: red"> *</strong></label>
            <input type="text" class="form-control" id="remarque" name="remarque" :value="old('remarque')" required autofocus autocomplete="remarque">
            <x-input-error :messages="$errors->get('remarque')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="mention" class="form-label">Mention de la solution <strong style="color: red"> *</strong></label>
            <select class="form-control" name="mention" id="mention" required>
                <option selected value=""></option>
                <option value="Très mauvaise">Très mauvaise</option>
                <option value="Mauvaise">Mauvaise</option>
                <option value="Passable">Passable</option>
                <option value="Assez bien">Assez bien</option>
                <option value="Bien">Bien</option>
                <option value="Très bien">Très bien</option>
                <option value="Excellente">Excellente</option>
            </select>
            <x-input-error :messages="$errors->get('mention')" class="mt-2" />
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-12 mt-2 mb-2">
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
    @endif
</div>
@endsection
