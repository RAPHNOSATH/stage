@extends('authentification/setting/home')
@section('contenu')
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">Soumission d'un communiqué</h4>
        <h4 class="alert alert-info text-center mt-2"><span><strong style="color: red"> *</strong> indique champ obligatoire</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('communique')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-6">
                <label for="document" class="form-label">Fichier <strong style="color: red"> *</strong></label>
                <input type="file" id="document" name="document" :value="old('document')" required autofocus autocomplete="document">
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
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

