@extends('authentification/setting/home')
@section('contenu')
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">Soumission d'une annonce</h4>
        <h4 class="alert alert-info text-center mt-2"><span><strong style="color: red"> *</strong> indique un champ obligatoire</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('annonce')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-6">
                <label for="titre" class="form-label">Titre <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="titre" name="titre" :value="old('titre')" required autofocus autocomplete="titre">
                <x-input-error :messages="$errors->get('titre')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6">
                <label for="contenu" class="form-label">Contenu <strong style="color: red"> *</strong></label>
                <textarea type="text" class="form-control" id="contenu" name="contenu" value="old('contenu')" required autofocus autocomplete="contenu"></textarea>
                <x-input-error :messages="$errors->get('contenu')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <label for="fichier" class="form-label">Image/fichier </label>
                <input type="file"  id="fichier" name="fichier" autofocus autocomplete="fichier">
                <x-input-error :messages="$errors->get('fichier')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </div>
        </form>
    </section>
</div>
@endsection

