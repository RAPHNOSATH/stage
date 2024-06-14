@extends('suivi/index')
@section('contenu')
<div class="container mt-4" >
    <h4 class="text-center" ><span class="alert alert-primary"> Changer ou Ajouter un document </span></h4>
</div>
<div class="container mt-4">
    @foreach ($resultats as $resultat)
    @if(!$resultat->is_valid)
        @if($resultat->is_rapport_valid && $resultat->is_business_valid && $resultat->is_document_valid)
            <div class="fs-4 text-center text-primary mt-5">Tous vos documents sont validés!!!</div>f
        @else
            <form method="POST" action="{{url('/suivi/update/solution/'.$resultat->id)}}" enctype="multipart/form-data" class="row g-3 " style="background: #3333; margin-left:40px ; ">
                @csrf
                @method('PUT')
                @if($resultat->is_rapport_valid)
                    @if(!$resultat->is_business_valid && !$resultat->is_document_valid)
                        <div class="col-md-4">
                            <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
                            <input type="file" id="business1" name="business" >
                            @if($resultat->business_model != null)
                                <p>{{ $resultat->businessUrl() }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('business')" class="mt-2" />
                        </div>
                        <div class="col-md-4">
                            <label for="document" class="form-label">Autre document</label>
                            <input type="file"  id="document1" name="document">
                            @if($resultat->autre_document != null)
                                <p>{{ $resultat->documentUrl() }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>
                    @else
                        @if ($resultat->is_business_valid)
                            <div class="col-md-4">
                                <label for="document" class="form-label">Autre document</label>
                                <input type="file"  id="document1" name="document">
                                @if($resultat->autre_document != null)
                                    <p>{{ $resultat->documentUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                            </div>
                        @endif
                        @if ($resultat->is_document_valid)
                            <div class="col-md-4">
                                <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
                                <input type="file" id="business1" name="business" >
                                @if($resultat->business_model != null)
                                    <p>{{ $resultat->businessUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('business')" class="mt-2" />
                            </div>
                        @endif
                    @endif
                @else
                    @if(!$resultat->is_business_valid && !$resultat->is_document_valid)
                        <div class="col-md-4">
                            <label for="rapport" class="form-label">Rapport du projet <span style="color: red">*</span></label>
                            <input type="file"  id="rapport1" name="rapport" >
                            @if($resultat->rapport != null)
                                <p>{{ $resultat->rapportUrl() }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('rapport')" class="mt-2" />
                        </div>
                        <div class="col-md-4">
                            <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
                            <input type="file" id="business1" name="business" >
                            @if($resultat->business_model != null)
                                <p>{{ $resultat->businessUrl() }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('business')" class="mt-2" />
                        </div>
                        <div class="col-md-4">
                            <label for="document" class="form-label">Autre document</label>
                            <input type="file"  id="document1" name="document">
                            @if($resultat->autre_document != null)
                                <p>{{ $resultat->documentUrl() }}</p>
                            @endif
                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                        </div>
                    @else
                        @if ($resultat->is_business_valid)
                            <div class="col-md-4">
                                <label for="rapport" class="form-label">Rapport du projet <span style="color: red">*</span></label>
                                <input type="file"  id="rapport1" name="rapport" >
                                @if($resultat->rapport != null)
                                    <p>{{ $resultat->rapportUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('rapport')" class="mt-2" />
                            </div>
                            <div class="col-md-4">
                                <label for="document" class="form-label">Autre document</label>
                                <input type="file"  id="document1" name="document">
                                @if($resultat->autre_document != null)
                                    <p>{{ $resultat->documentUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                             </div>
                        @endif
                        @if ($resultat->is_document_valid)
                            <div class="col-md-4">
                                <label for="rapport" class="form-label">Rapport du projet <span style="color: red">*</span></label>
                                <input type="file"  id="rapport1" name="rapport" >
                                @if($resultat->rapport != null)
                                    <p>{{ $resultat->rapportUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('rapport')" class="mt-2" />
                            </div>
                            <div class="col-md-4">
                                <label for="business" class="form-label">Business model du projet <span style="color: red">*</span></label>
                                <input type="file" id="business1" name="business" >
                                @if($resultat->business_model != null)
                                    <p>{{ $resultat->businessUrl() }}</p>
                                @endif
                                <x-input-error :messages="$errors->get('business')" class="mt-2" />
                            </div>
                        @endif
                    @endif
                @endif
                <div class="col-12 mt-4 mb-2">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        @endif
    @else
        <div class="fs-4 text-center text-primary mt-5">Toutes les étapes ont été validés!!!</div>
    @endif
    @endforeach
</div>
@endsection
