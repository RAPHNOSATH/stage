@extends('authentification/setting/home')
@section('contenu')
    @if (count($domaines) >0)
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">Ajout d'un sous domaine</h4>
        <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('sousdomaine')}}" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-6">
                <label for="domaine" class="form-label">Domaine <strong style="color: red"> *</strong></label>
                <select id="domaine" class="form-control" name="domaine" required autofocus autocomplete="domaine">
                  <option selected></option>
                  @forEach($domaines as $domaine)
                    <option value="{{$domaine->id}}">{{$domaine->nom_d}} </option>
                  @endforEach
                </select>
            </div>
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom de sous domaine <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="nom" name="nom" :value="old('nom')" required autofocus autocomplete="nom">
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </section>
    @else
    <h4 class="alert alert-info text-center mt-2">Pas de domaine existants</h4>
    @endif
</div>
@endsection

