@extends('authentification/setting/home')
@section('contenu')
    <div class="container">
        <h2 class="text-center" style="text-transform: uppercase">création du compte bailleur de fond</h2>
        <div class="row justify-content-center">
            <div class="col-auto">
                <img class="img-fluid" src="{{asset('images/signUp.jpg')}}" alt="">
            </div>
        </div>

        <h4 class="alert alert-info text-center mt-2"><span>Tous les champs marqués <strong style="color: red"> *</strong> sont obligatoires</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('bailleurdefond')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-4">
                <label for="username" class="form-label">Nom utilisateur <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="username" name="username" :value="old('username')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>
            <div class="col-md-4">
              <label for="intitule" class="form-label">Nom <strong style="color: red"> *</strong></label>
              <input type="text" class="form-control" id="intitule" name="intitule" :value="old('intitule')" required autofocus autocomplete="intitule">
              <x-input-error :messages="$errors->get('intitule')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="telephone" class="form-label">Téléphone <strong style="color: red"> *</strong></label>
                <input type="number" class="form-control" id="telephone" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone">
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="adresse" class="form-label">Adresse <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="adresse" name="adresse" :value="old('adresse')" required autofocus autocomplete="adresse">
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="country" class="form-label">Pays <strong style="color: red"> *</strong></label>
                <select id="country" class="form-control" name="country" required autofocus autocomplete="country">
                    <option selected></option>
                    <option>Benin</option>
                    <option>Burkina Faso</option>
                    <option>Côte d'ivoire</option>
                    <option>Ghana</option>
                    <option>Mali</option>
                    <option>Niger</option>
                    <option>Nigeria</option>
                    <option>Togo</option>
                    <option>Autre pays</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="domaine" class="form-label">Domaine intervention <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="domaine" name="domaine" :value="old('domaine')" required autofocus autocomplete="domaine">
                <x-input-error :messages="$errors->get('domaine')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6">
                <label for="contrat" class="form-label">Document du contrat <strong style="color: red"> *</strong></label>
                <input type="file"  id="contrat" name="contrat" required autofocus autocomplete="contrat">
                <x-input-error :messages="$errors->get('contrat')" class="mt-2" />
            </div>
            <div class="col-md-6">
                <label for="image" class="form-label">    Votre    image de profile </label>
                <input type="file"  id="image" name="image" autofocus autocomplete="image">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email <strong style="color: red"> *</strong></label>
                <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autocomplete="email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Mot de passe <strong style="color: red"> *</strong></label>
                <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="col-md-4">
                <label for="password_confirmation" class="form-label">Confirmation du mot de passe <strong style="color: red"> *</strong></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="col-12 mt-2 mb-2">
              <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
    </section>
</div>
@endsection

