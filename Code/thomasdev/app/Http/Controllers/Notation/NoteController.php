<?php

namespace App\Http\Controllers\Notation;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Note;
use App\Models\Projet;
use App\Models\Resultat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function acceuil(){
        $resultats = Resultat::where("is_public",false)->paginate(2);
        $projets= Projet::where("en_recherche",true)->get();
        $equipes = Equipe::all();
        return view('notation.acceuil',compact('resultats','projets','equipes'));
    }
    public function create($id){
        $resultat = Resultat::find($id);
        return view('notation.note',compact('resultat'));
    }
    public function resultat(){
        $resultats = Resultat::where("is_public",false)->paginate(2);
        $projets= Projet::where("en_recherche",true)->get();
        $equipes = Equipe::all();
        return view('notation.resultatListe', compact('resultats','projets','equipes'));
    }

    public function store(Request $request,$id){
        $request->validate([
            'note' => ['required', 'integer'],
            'remarque' =>['required','string','max:255'],
            'mention' =>['required','string','max:255'],
        ]);
        if(auth('membre')->check()){
            $membre =$request->user('membre');
            $notes = $membre->resultats()->where('resultat_id', $id)->get();
            $nombre = $notes->count();
            if($nombre <= 4){
                $membre->resultats()->attach($id, ['note' => $request->note,'remarque' => $request->remarque,'mention' => $request->mention]);
                return redirect()->route('acceuil1')->with('success','Note validée avec succès');
            }
            else{
                return redirect()->back()->with('error','Vous avez déjà noté cette solution');
            }
        }else if(auth()->check()){
            $user = $request->user();
            $notes = $user->resultats()->where('resultat_id', $id)->get();
            $nombre = $notes->count();
            if($nombre <= 4){
                $user->resultats()->attach($id, ['note' => $request->note,'remarque' => $request->remarque,'mention' => $request->mention]);
                return redirect()->route('acceuil')->with('success','Note validée avec succès');
            }
            else{
                return redirect()->back()->with('error','Vous avez déjà noté cette solution');
            }
        }

    }
    public function detailSolution($id)
    {
        $resultat = Resultat::findOrFail($id);
        $equipes = Equipe::all();
        $projets= Projet::where("en_recherche",true)->get();
        return view('notation.detailSolution',compact('resultat','equipes','projets'));
    }
    public function detailNote($id)
    {
        $resultat = Resultat::findOrFail($id);
        $equipes = Equipe::all();
        $projets= Projet::where("en_recherche",true)->get();
        return view('notation.detailNote',compact('resultat','equipes','projets'));
    }
}
