@extends('authentification/setting/home')
@section('contenu')
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">Ajout d'un type d'équipe</h4>
        <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('typeEquipe')}}" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom du type <strong style="color: red"> *</strong></label>
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
</div>
@endsection

