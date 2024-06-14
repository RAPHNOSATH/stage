@extends('home')
@section('contenu')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenue sur GS_PRO!</h1>
                                </div>
                                <form class="user" method="POST" action="{{Route('login2')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" required name="email" :value="old('email')" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" autocomplete="email" placeholder="Votre adresse e-mail...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" required name="password" class="form-control form-control-user" id="exampleInputPassword" autocomplete="new-password" placeholder="Votre mot de passe">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Se souvenir de moi</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Se connecter
                                    </button>
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a style="color: #4e73df;" class="small" href="#">Mot de passe oublié?</a>
                                </div>
                                <div class="text-center">
                                    <a style="color: #4e73df;" class="small" href="{{Route('register1')}}">Créer un compte!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
