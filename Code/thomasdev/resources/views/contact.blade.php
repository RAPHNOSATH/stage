@extends('home')
@section('contenu')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h4>A propos</h4>
                <div class="comment mt-4 text-justify float-left">

                    <h4>GS_PRO</h4>
                    <span> vit le jour le 5 Avril 2024</span>
                    <br>
                    <p>est un outil disponible pour tous les chercheurs, étudiants, étudiants des cycles supérieurs et postuniversitaires de l’Afrique de l’ouest.</p>
                    <p>Ils peuvent consulter la partie description (le résumé ou un petit plus de détails si disponibles) de toutes les recherches et celles décidées par les auteurs et/ou les institutions, ils sont publics.
                        Les recherches qui sont d'une manière ou d'une autre sensées pour des questions de sécurité ou d'autres raisons pour lesquelles les auteurs et/ou les institutions ont trouvé des critiques, leurs contenus sont disponibles pour un groupe de chercheurs ou d'institutions.</p>
                    <p>C'est un outil pour les partenaires du développement. Ils peuvent l'utiliser comme source pour trouver des projets stratégiques de développement et soumettre des sujets de recherche pouvant conduire à un réel développement.</p>
                </div>

            </div>
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="algin-form" method="POST" action="{{Route('contact')}}">
                    @csrf
                    <div class="form-group">
                        <h4>Contactez-nous</h4>
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                        <label for="message">Message</label>
                        <textarea name="msg" id="msg" cols="30" rows="5" class="form-control"></textarea>

                    </div>
                    <div class="form-inline">
                        <input type="checkbox" name="check" id="checkbx" class="mr-1">
                        <label for="subscribe">e-mail</label>
                    </div>
                    <div class="form-group justify-content-between">
                        <button type="submit" id="post" class="btn">Envoyé</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
