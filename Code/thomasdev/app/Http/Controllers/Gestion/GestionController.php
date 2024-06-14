<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Models\Commentaire;
use App\Models\Domaine;
use App\Models\Equipe;
use App\Models\Projet;
use App\Models\Resultat;
use App\Models\SousDomaine;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionController extends Controller
{
    function create():View{
        $sousdomaines = SousDomaine::all();
        return view('gestion.ajout', compact('sousdomaines'));
    }
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $request->validate([
            'intitule' => ['required', 'string', 'max:255'],
            'sousdomaine' => ['required', 'string'],
            'description' => ['required','string'],
            'document' =>['max:30000'],
        ]);
         /** @var UploadedFile|null $document */
        $document= $request->document;
        if($document != null && !$document->getError()){
            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $documentPath = $file->storeAs('projets/document', $filename,'public');
             $user=Projet::create([
                 'intitule_projet' => $request->intitule,
                 'description_projet' =>$request->description,
                 'document_descriptif'=>$documentPath,
                 'sous_domaine_id'=>$request->sousdomaine,
                 'user_id' =>$user,
             ]);
        }else{
             $user=Projet::create([
                 'intitule_projet' => $request->intitule,
                 'description_projet' =>$request->description,
                 'sous_domaine_id'=>$request->sousdomaine,
                 'user_id' =>$user,
             ]);
        }
        return redirect()->route('projetSoumis')->with('success','projet enregistré avec success');
    }
    public function projetSoumis(){
        $projet = Projet::where( 'est_accepte','false')->where('en_recherche','false')->paginate(10);
        return view('gestion.projetSoumis',compact('projet'));
    }
    public function detailProjetSoumis($id){
       $projets = Projet::find($id);
       return view('gestion.detailProjetSoumis',['projet'=>$projets]);
    }
    public function projetAccepte(){
        $projets = Projet::where('est_accepte','true')->where('en_recherche','false')->paginate(10);
        return view('gestion.projetAccepte',compact('projets'));
    }
    public function validateProject(){
        $projets = Projet::where( 'est_accepte','false')->where('en_recherche','false')->paginate(10);
        return view('gestion.validateProject',compact('projets'));
    }
    public function projetEnRecherche(){
        $projets = Projet::where('en_recherche','true')->paginate(10);
        return view('gestion.projetEnRecherche',compact('projets'));
    }
    public function validated($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->est_accepte = true;
        $projet->save();
        return redirect()->back()->with('success','Projet validé avec succès!!!');
    }
    public function resultat(){
        $resultats = Resultat::where("is_public",true)->paginate(10);
        $projets= Projet::where("en_recherche",true)->get();
        $equipes = Equipe::all();
        return view('gestion.resultatListe', compact('resultats','projets','equipes'));
    }

}
