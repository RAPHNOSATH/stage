<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Domaine;
use App\Models\SousDomaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomaineController extends Controller
{
    public function create1(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.domaineForm');
        }else{
            return redirect()->route('home');
        }
    }
    public function create2(){
        $user = Auth::user();
        if ($user->is_superuser) {
            $domaines = Domaine::all();
            return view('authentification.setting.sousdomaineForm',compact('domaines'));
        }else{
            return redirect()->route('home');
        }
    }

    public function store1(Request $request){
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
            ]);
            Domaine::create([
                'nom_d' => $request->nom,
            ]);
            return redirect()->route('allAnnonce')->with('success','Domaine ajouter avec success!!!');
        }else{
            return redirect()->route('home');
        }
    }
    public function store2(Request $request){
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'domaine' => ['required', 'string', 'max:255'],
                'nom' => ['required', 'string', 'max:255'],
            ]);
            SousDomaine::create([
                'nom_s' => $request->nom,
                'domaine_id'=>$request->domaine
            ]);
            return redirect()->route('equipe')->with('success','Domaine ajouter avec success!!!');
        }else{
            return redirect()->route('home');
        }
    }

    public function domaine(){
        $domaines = Domaine::all();
        return view('authentification.setting.domaine',compact('domaines'));
    }
}
