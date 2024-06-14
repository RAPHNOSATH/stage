@extends('gestion/index')
@section('contenu')
    @if (count($sousdomaines)>0)
    <div class="container">
        <h4 class="text-center" style="text-transform: uppercase">Ajout d'un projet</h4>

        <h4 class="alert alert-info text-center mt-4"><span><strong style="color: red"> *</strong> indique champ obligatoire</span></h4>
        <hr>
    </div>
    <section class="container mt-5" >
        <form method="POST" action="{{Route('ajout')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ">
            @csrf
            <div class="col-md-6">
                <label for="intitule" class="form-label">Intitulé du projet <strong style="color: red"> *</strong></label>
                <input type="text" class="form-control" id="intitule" name="intitule" :value="old('intitule')" required autofocus autocomplete="intitule">
                <x-input-error :messages="$errors->get('intitule')" class="mt-2" />
            </div>
            <div class="col-md-6">
                <label for="sousdomaine" class="form-label">Sous domaine du projet <strong style="color: red"> *</strong></label>
                <select id="sousdomaine" class="form-control" name="sousdomaine" required autofocus autocomplete="sousdomaine">
                  <option selected></option>
                  @forEach($sousdomaines as $sousdomaine)
                      <option value="{{$sousdomaine->id}}">{{$sousdomaine->nom_s}} </option>
                  @endforEach
                </select>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Descrption de votre projet <strong style="color: red"> *</strong></label>
                <textarea type="text" class="form-control" id="description" name="description" :value="old('description')" required autofocus autocomplete="description"></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12">
                <label for="document" class="form-label">Document descriptif</label>
                <input type="file"  id="document" name="document"  autofocus autocomplete="document">
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 mt-2 mb-2">
              <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </section>
    @else
    <h4 class="alert alert-danger text-center">Pas de sous domaines existants!!!</h4>
    @endif
@endsection
<script>
/*function updateSecondSelect() {
    var premierSelect = document.getElementById("domaine");
    var secondSelect = document.getElementById("sousdomaine");
    var choix = premierSelect.value;

    // Effacer les options précédentes
    secondSelect.innerHTML = "";

    // Ajouter de nouvelles options en fonction du choix
    if (choix === " Santé") {
        var options = [" ", "Développement et conception des applications", "Gestion de réseaux","Intégration de systèmes"];
    } else{
        var options = [" "];
    }
    // Ajouter les nouvelles options au second select
    options.forEach(function(option) {
        var newOption = document.createElement("option");
        newOption.text = option;
        newOption.value = option;
        secondSelect.add(newOption);
    });
}
*/
</script>

