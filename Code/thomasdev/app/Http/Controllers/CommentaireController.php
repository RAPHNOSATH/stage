<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Communique;
use App\Models\Membre;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function projet(){
        $projets = Projet::all();
        $communique = Communique::all();
        return view('commentaire.projet',compact('projets','communique'));
    }
    public function detail($id){
        $projet = Projet::find($id);
        $communique = Communique::all();
        $users = User::all();
        $membres = Membre::all();
        return view('commentaire.detail',compact('projet','communique','users','membres'));
    }
    public function comment(Request $request,$id){
        $projet = Projet::findOrFail($id);
        $nombres = $projet->commentaires->count();
        if(auth('membre')->check()){
            $membre =$request->user('membre');
            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
            ]);

            if($nombres > 0){
                $membre->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => $nombres +1]);
            }
            else{
                $membre->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => 1]);
            }
        }else if(auth()->check()){
            $user = $request->user();
            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
            ]);

            if($nombres > 0){
                $user->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => $nombres +1]);
            }
            else{
                $user->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => 1]);
            }
        }
        return redirect()->back()->with('success','commentaire envoyé avec succès');
    }

    public function repondre(Request $request,$id){
        $projet = Projet::findOrFail($id);
        $nombres = $projet->commentaires->count();
        if(auth('membre')->check()){
            $membre =$request->user('membre');
            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
            ]);

            if($nombres > 0){
                $membre->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => $nombres +1]);
            }
            else{
                $membre->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => 1]);
            }
        }else if(auth()->check()){
            $user = $request->user();
            $request->validate([
                'comment' => ['required', 'string', 'max:255'],
            ]);

            if($nombres > 0){
                $user->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => $nombres +1]);
            }
            else{
                $user->projets()->attach($id, ['commentaire' => $request->comment,'nombre_c' => 1]);
            }
        }
        return redirect()->back()->with('success','commentaire envoyé avec succès');
    }



}
