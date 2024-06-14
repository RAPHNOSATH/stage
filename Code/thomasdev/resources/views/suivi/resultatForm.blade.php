@extends('suivi/index')
@section('contenu')
<div id="type" style="display:block" class="d-flex w-100 justify-content-center">
    <div>
        <label class="form-label" for=""> Choisir un type de solution</label>
        <select id="choix" class="form-control">
            <option selected value="0"></option>
            <option value="1">Rapport</option>
            <option value="2">Business model</option>
            <option value="3">Solution complete</option>
        </select>
    </div>
</div>
<div class="container mt-4" >
    <h4 id="indication" style="display:none" class="text-center" ><span class="alert alert-primary"> <span style="color: red">*</span> indique un champ obligatoire</span></h4>
</div>
<div class="container mt-4">
    <form id="rapportForm"  method="POST" action="{{Route('resultatForm')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ;display:none">
        @csrf
        <div class="col-md-4">
            <label for="rapport" class="form-label">Rapport du projet <span style="color: red">*</span></label>
            <input type="file" required  id="rapport" name="rapport" >
            <x-input-error :messages="$errors->get('rapport')" class="mt-2" />
        </div>
        <div class="col-12 mt-4 mb-2">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
    <form id="businessForm"  method="POST" action="{{Route('resultatForm')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ; display:none ">
        @csrf
        <div class="col-md-4">
            <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
            <input type="file" required  id="business" name="business" >
            <x-input-error :messages="$errors->get('business')" class="mt-2" />
        </div>
        <div class="col-12 mt-4 mb-2">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
    <form id="solutionForm"  method="POST" action="{{Route('resultatForm')}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ; visibility:hidden ">
        @csrf
        <div class="col-md-4">
            <label for="rapport" class="form-label">Rapport du projet <span style="color: red">*</span></label>
            <input type="file" required  id="rapport" name="rapport" >
            <x-input-error :messages="$errors->get('rapport')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
            <input type="file" required  id="business" name="business" >
            <x-input-error :messages="$errors->get('business')" class="mt-2" />
        </div>
        <div class="col-md-4">
            <label for="document" class="form-label">Autre document</label>
            <input type="file"  id="document" name="document">
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>
        <div class="col-12 mt-4 mb-2">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>
<script>
    // Fonction pour afficher le formulaire approprié en fonction de la sélection
    function afficherFormulaire() {
      var choix = document.getElementById("choix").value;
      if(choix == 0){
        document.getElementById("type").style.display = "block ";
        document.getElementById("indication").style.display = "none ";
        document.getElementById("rapportForm").style.display = "none ";
        document.getElementById("businessForm").style.display = "none ";
        document.getElementById("solutionForm").style.visibility = "hidden ";
        document.getElementById("solutionForm").innerHTML = '';
        document.getElementById("solutionForm").innerHTML = initialFormContent;
      }else if (choix == 1) {
        document.getElementById("type").style.display = "none ";
        document.getElementById("indication").style.display = "block ";
        document.getElementById("rapportForm").style.display = "block ";
        document.getElementById("businessForm").style.display = "none ";
        document.getElementById("solutionForm").style.visibility = "hidden ";
        document.getElementById("solutionForm").innerHTML = '';
        document.getElementById("solutionForm").innerHTML = initialFormContent;

      } else if (choix == 2) {
        document.getElementById("type").style.display = "none ";
        document.getElementById("indication").style.display = "block ";
        document.getElementById("businessForm").style.display = "block ";
        document.getElementById("rapportForm").style.display = "none ";
        document.getElementById("solutionForm").style.visibility = "hidden ";
        document.getElementById("solutionForm").innerHTML = '';
        document.getElementById("solutionForm").innerHTML = initialFormContent;

      } else if (choix == 3){
        document.getElementById("type").style.display = "none";
        document.getElementById("indication").style.display = "block ";
        document.getElementById("solutionForm").style.visibility = "visible ";
        document.getElementById("rapportForm").style.display = "none ";
        document.getElementById("businessForm").style.display = "none ";
      }
    }
    var initialFormContent = document.getElementById("solutionForm").innerHTML;

    // Ajouter un gestionnaire d'événements sur le select pour détecter les changements
    document.getElementById("choix").addEventListener("change", afficherFormulaire);

    // Appel initial pour afficher le formulaire initial
    afficherFormulaire();
    </script>
@endsection
