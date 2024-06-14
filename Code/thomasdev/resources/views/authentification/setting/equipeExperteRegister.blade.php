@extends('authentification/setting/home')
@section('contenu')
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">création d'une équipe experte</h4>
        <div class="row justify-content-center">
            <div class="col-auto">
                <img class="img-fluid" src="{{asset('images/signUp.jpg')}}" alt="">
            </div>
        </div>

        <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('equipeExperte')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
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
                <label for="document" class="form-label">Document du contrat <strong style="color: red"> *</strong></label>
                <input type="file"  id="document" name="document" required autofocus autocomplete="document">
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6">
                <label for="type" class="form-label">Type d'équipe <strong style="color: red"> *</strong></label>
                <select id="type" class="form-control" name="type" required autofocus autocomplete="type">
                  <option selected value="{{$type->id}}">{{$type->nom_type}} </option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
              <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </form>
    </section>
@endsection

