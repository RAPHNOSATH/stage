<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Projet;
use App\Models\TypeEquipe;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class EquipeController extends Controller
{
    public function create1(){
        $user = Auth::user();
        if ($user->is_superuser) {
            $type = TypeEquipe::find(1);
            return view('authentification.setting.equipeExperteRegister',compact('type'));
        }else{
            return redirect()->route('home');
        }

    }
    public function create2(){
        $user = Auth::user();
        $membre = Auth::guard('membre');
        if ($user->is_superuser || $membre->user()->is_superuser) {
            $projets = Projet::where('en_recherche','false')->where( 'est_accepte','true')->get();
            $type = TypeEquipe::find(2);
            return view('authentification.setting.equipeRechercheRegister',compact('projets','type'));
        }else{
            return redirect()->route('home');
        }
    }

    public function create3(){
        $user = Auth::user();
        if ($user->is_superuser) {
            return view('authentification.setting.typeEquipeForm');
        }else{
            return redirect()->route('home');
        }

    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store1(Request $request)
    {
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'effectif' => ['required', 'integer'],
                'document'=>['required','max:50000'],
                'type'=>['required','max:150'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            ]);
            /** @var UploadedFile|null $document */
            $document = $request->document;
            if($document !=null && !$document->getError()){
                $file = $request->file('document');
                $filename = $file->getClientOriginalName();
                $documentPath = $file->storeAs('equipes/document', $filename,'public');
                $user=Equipe::create([
                    'nom_equipe' => $request->name,
                    'effectif'=>$request->effectif,
                    'document_equipe'=>$documentPath,
                    'email_equipe' => $request->email,
                    'type_equipe_id'=>$request->type
                ]);
                return redirect()->route('equipe')->with('success','équipe créée avec success');
            }else{
                return back()->withErrors([
                    'document'=> 'Le champ vide ou fichier érroné'
                ]);
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function store2(Request $request)
    {
        $user = Auth::user();
        $membre = Auth::guard('membre');
        if($membre->user()->is_superuser){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'effectif' => ['required', 'integer'],
                'document'=>['required','max:50000'],
                'type'=>['required','max:150'],
                'projet' => ['required'],
                'delai' => ['required'],
                'startdate' => ['required'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            ]);
            $dateAujourdhui = Carbon::now();
            $datestart = Carbon::parse($request->startdate);
            $dateend= Carbon::parse($request->delai);
            $nombreJours = $datestart->diffInDays($dateend);
            /** @var UploadedFile|null $document */
            $document = $request->document;
            if($document !=null && !$document->getError()){
                $projet = Projet::find($request->projet);
                $projet1 = Projet::find($request->projet);
                $file = $request->file('document');
                $filename = $file->getClientOriginalName();
                $documentPath = $file->storeAs('equipes/document', $filename,'public');
                $equipe=Equipe::create([
                    'nom_equipe' => $request->name,
                    'effectif'=>$request->effectif,
                    'document_equipe'=>$documentPath,
                    'email_equipe' => $request->email,
                    'type_equipe_id'=>$request->type,
                    'delai'=>$request->delai,
                    'date_start'=> $request->startdate,
                    'number_day'=>$nombreJours,
                    'number_day_rest'=>$nombreJours,
                ]);
                $projet->equipe_id= $equipe->id;
                $projet->save();
                $projet1->en_recherche = true;
                $projet1->save();
                return redirect()->route('allequipeDeRecherche1')->with('success','équipe créée avec success');
            }else{
                return redirect()->back()->withErrors([
                    'document'=> 'champ vide ou fichier erroné'
                ]);
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function store3(Request $request)
    {
        $user = Auth::user();
        if($user->is_superuser){
            $request->validate([
                'nom' => ['required', 'string', 'max:255'],
            ]);
            TypeEquipe::create([
                'nom_type' => $request->nom,
            ]);
            return redirect()->route('equipe')->with('success','type ajouter avec success!!!');
        }else{
            return redirect()->route('home');
        }
    }


    public function store4(Request $request,$id)
    {
        $user = Auth::user();
        $membre = Auth::guard('membre');
        if($user->is_superuser || $membre->user()->is_superuser){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string'],
                'profession'=>['required','string'],
                'cv'=>['required','max:10000'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required','min:8', Rules\Password::defaults()],
                'password_confirmation' => ['required','min:8'],
            ]);
            /** @var UploadedFile|null $cv */
            $cv = $request->cv;
            if($cv !=null && !$cv->getError()){
                $file = $request->file('cv');
                $filename = $file->getClientOriginalName();
                $cvPath = $file->storeAs('membres/cv', $filename,'public');
                if($request->password == $request->password_confirmation){
                    $n = 0;
                    $membre = Membre::where('email', $request->email)->first();
                    if($membre != null){
                        return redirect()->back()->with('error','Votre adresse email existe déjà!!!');
                    }else{
                        $me = Membre::all();
                        if($me->count()>0){
                            foreach($me as $m){
                                if(Hash::check($request->password, $m->password)){
                                    $n = $n +1;
                                }
                            }
                            if($n != 0){
                                return redirect()->back()->with('error','Votre  mot de passe existe déjà, veuillez changer!');
                            }else{
                                $equipe = Equipe::findOrFail($id);
                                $type_equipe_id = $equipe->type_equipe()->value("id");
                                $effectif_min = $equipe->effectif_min;
                                if($type_equipe_id == 1){
                                    if($equipe->statut_equipe == 'Actif' || $equipe->statut_equipe == 'En pause'){
                                        if($effectif_min <= $equipe->effectif){
                                            Membre::create([
                                                'nom_m' => strtoupper($request->name),
                                                'prenom_m'=>strtoupper($request->prenom),
                                                'profession_m'=>$request->profession,
                                                'cv_m' => $cvPath,
                                                'password' => Hash::make($request->password),
                                                'equipe_id' =>$id,
                                                'email'=> $request->email,
                                                'is_expert'=>true,
                                            ]);
                                            $equipe->effectif_min = $effectif_min +1;
                                            $equipe->save();
                                            return redirect()->back()->with('success','Membre ajouté avec success!!!');
                                        }else{
                                            return redirect()->back()->with('error',"L'éffectif prévu est atteint; impossible d'ajouter un membre!!!");
                                        }
                                    }else{
                                        return redirect()->back()->with('error','Cette équipe est inactif ou en pause');
                                    }
                                }elseif($type_equipe_id == 2){
                                    if($equipe->statut_equipe == 'Actif' || $equipe->statut_equipe == 'En pause'){
                                        if($effectif_min <= $equipe->effectif){
                                            Membre::create([
                                                'nom_m' => strtoupper($request->name),
                                                'prenom_m'=>strtoupper($request->prenom),
                                                'profession_m'=>$request->profession,
                                                'cv_m' => $cvPath,
                                                'password' => Hash::make($request->password),
                                                'equipe_id' =>$id,
                                                'email'=> $request->email,
                                            ]);
                                            $equipe->effectif_min = $effectif_min +1;
                                            $equipe->save();
                                            return redirect()->back()->with('success','Membre ajouté avec success!!!');
                                        }else{
                                            return redirect()->back()->with('error',"L'éffectif prévu est atteint; impossible d'ajouter un membre!!!");
                                        }
                                    }else{
                                        return redirect()->back()->with('error','Cette équipe est inactif ou en pause');
                                    }
                                }
                            }
                        }else{
                            $equipe = Equipe::findOrFail($id);
                            $type_equipe_id = $equipe->type_equipe()->value("id");
                            $effectif_min = $equipe->effectif_min;
                            if($type_equipe_id == 1){
                                if($equipe->statut_equipe == 'Actif' || $equipe->statut_equipe == 'En pause'){
                                    if($effectif_min <= $equipe->effectif){
                                        Membre::create([
                                                'nom_m' => strtoupper($request->name),
                                                'prenom_m'=>strtoupper($request->prenom),
                                                'profession_m'=>$request->profession,
                                                'cv_m' => $cvPath,
                                                'password' => Hash::make($request->password),
                                                'equipe_id' =>$id,
                                                'email'=> $request->email,
                                                'is_expert'=>true,
                                        ]);
                                        $equipe->effectif_min = $effectif_min +1;
                                        $equipe->save();
                                        return redirect()->back()->with('success','Membre ajouté avec success!!!');
                                    }else{
                                        return redirect()->back()->with('error',"L'éffectif prévu est atteint; impossible d'ajouter un membre!!!");
                                    }
                                }else{
                                    return redirect()->back()->with('error','Cette équipe est inactif ou en pause');
                                }
                            }elseif($type_equipe_id == 2){
                                if($equipe->statut_equipe == 'Actif' || $equipe->statut_equipe == 'En pause'){
                                    if($effectif_min <= $equipe->effectif){
                                        Membre::create([
                                                'nom_m' => strtoupper($request->name),
                                                'prenom_m'=>strtoupper($request->prenom),
                                                'profession_m'=>$request->profession,
                                                'cv_m' => $cvPath,
                                                'password' => Hash::make($request->password),
                                                'equipe_id' =>$id,
                                                'email'=> $request->email,
                                        ]);
                                        $equipe->effectif_min = $effectif_min +1;
                                        $equipe->save();
                                        return redirect()->back()->with('success','Membre ajouté avec success!!!');
                                    }else{
                                        return redirect()->back()->with('error',"L'éffectif prévu est atteint; impossible d'ajouter un membre!!!");
                                    }
                                }else{
                                    return redirect()->back()->with('error','Cette équipe est inactif ou en pause');
                                }
                            }
                        }
                    }
                }else{
                    return redirect()->back()->withErrors([
                        'password_confirmation'=> 'Mot de passe confirmé ne correspond pas '
                    ]);
                }
            }else{
                return redirect()->back()->withErrors([
                    'document'=> 'champ vide ou fichier erroné '
                ]);
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function equipeDeRecherche(){
        $dateAujourdhui = Carbon::now();
        $date = Carbon::parse($dateAujourdhui);
        $equipes1 = Equipe::where('type_equipe_id',2)->get();
        for($i = 0; $i < $equipes1->count(); $i++){
            $delai= Carbon::parse($equipes1[$i]->delai);
            $nombreJoursRestant = $date->diffInDays($delai);
            $equipes1[$i]->number_day_rest= $nombreJoursRestant;
            if( $equipes1[$i]->number_day_rest == 0){
                $equipes1[$i]->statut_delai = "Terminé";
            }else if($equipes1[$i]->number_day_rest <0){
                $equipes1[$i]->statut_delai = "En retard";
            }
            $equipes1[$i]->save();
        }
        $projets = Projet::where('est_accepte',true)->get();
        $equipes = Equipe::where('type_equipe_id',2)->paginate(10);
        return view('suivi/equipe', compact('equipes','projets'));
    }
    public function equipeExperte1(){
        $equipes = Equipe::where('type_equipe_id',1)->paginate(3);
        return view('authentification/setting/equipe', compact('equipes'));
    }
    public function equipeExperte2(){
        $equipes = Equipe::where('type_equipe_id',1)->paginate(3);
        return view('suivi/equipeexperte', compact('equipes'));
    }
    public function type(){
        $types = TypeEquipe::all();
        return view('authentification.setting.type',compact('types'));
    }
    public function activer($id){
        $equipe = Equipe::findorFail($id);
        $equipe->statut_equipe = 'Actif';
        $equipe->statut_delai = 'En cours';
        $equipe->save();
        return redirect()->back()->with('success','équipe activé avec succès');
    }
    public function desactiver($id){
        $equipe = Equipe::findorFail($id);
        $equipe->statut_equipe = 'Inactif';
        $equipe->statut_delai = 'En attente';
        $equipe->save();
        return redirect()->back()->with('success','équipe désactivé avec succès');
    }
    public function pause($id){
        $equipe = Equipe::findorFail($id);
        $equipe->statut_equipe = 'En pause';
        $equipe->save();
        return redirect()->back()->with('success','équipe mise en pause avec succès');
    }

    public function edit($id)
    {
        $equip = Equipe::findOrFail($id);
        return view('suivi.equipe', compact('equip'));
    }
    public function update(Request $request, $id)
    {
        $equipe = Equipe::findOrFail($id);
        $type_equipe_id = $equipe->type_equipe()->value("id");
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'effectif' => ['required', 'integer'],
            'projet' => ['required', 'integer'],
            'document'=>['nullable','max:50000'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);
        if($type_equipe_id == 1){
            $equipe->nom_equipe = $request->input('name');
            $equipe->effectif = $request->input('effectif');
            $equipe->email_equipe = $request->input('email');
            if ($request->hasFile('document')) {
                Storage::disk('public')->delete($equipe->document_equipe);
                $file = $request->file('document');
                $filename = $file->getClientOriginalName();
                $documentPath = $file->storeAs('equipes/document', $filename,'public');
                $equipe->document_equipe = $documentPath;
            }
        }else if($type_equipe_id == 2){
            $project = Projet::where('equipe_id',$id)->first();
            $project1 = Projet::where('equipe_id',$id)->first();
            $projet = Projet::findOrFail($request->projet);
            $projet1 = Projet::findOrFail($request->projet);
            if($projet->equipe_id == $id){
                $equipe->nom_equipe = $request->input('name');
                $equipe->effectif = $request->input('effectif');
                $equipe->email_equipe = $request->input('email');
                if ($request->hasFile('document')) {
                    Storage::disk('public')->delete($equipe->document_equipe);
                    $file = $request->file('document');
                    $filename = $file->getClientOriginalName();
                    $documentPath = $file->storeAs('equipes/document', $filename,'public');
                    $equipe->document_equipe = $documentPath;
                }
            }else{
                if($request->hasFile('document')){
                    $equipe->nom_equipe = $request->input('name');
                    $equipe->effectif = $request->input('effectif');
                    $equipe->email_equipe = $request->input('email');
                    $project->en_recherche = false;
                    $project1->equipe_id = null;
                    $projet->en_recherche =true;
                    $projet1->equipe_id = $id;
                    Storage::disk('public')->delete($equipe->document_equipe);
                    $file = $request->file('document');
                    $filename = $file->getClientOriginalName();
                    $documentPath = $file->storeAs('equipes/document', $filename,'public');
                    $equipe->document_equipe = $documentPath;
                    $projet->save();
                    $projet1->save();
                    $project->save();
                    $project1->save();
                }else{
                    return redirect()->back()->with('error', 'Le projet a été changé; le cahier de charge doit changer obligatoirement!!!');
                }
            }
        }
        $equipe->save();
        return redirect()->back()->with('success', 'Équipe mise à jour avec succès!!!');
    }

    public function delete($id){
        $equipe = Equipe::findOrFail($id);
        foreach($equipe->membres as $membre){
            Storage::disk('public')->delete($membre->cv_m);
        }
        $equipe->membres()->delete();
        $projets = Projet::where('equipe_id',$equipe->id)->get();
        for($i = 0;$i<$projets->count();$i++){
            $projets[$i]->equipe_id= null;
            $projets[$i]->en_recherche = false;
            $projets[$i]->save();
        }
        Storage::disk('public')->delete($equipe->document_equipe);
        $equipe->delete();
        return redirect()->back()->with('success', 'Équipe supprimer avec succès!!!');
    }

    public function membre($id){
        $membres = Membre::where('equipe_id','=',$id)->get();
        if(auth()->guard('membre')->check()){
            return view('suivi.listeMembre',compact('membres'));
        }elseif(auth()->check() ){
            return view('authentification.setting.listeMembre',compact('membres'));
        }
    }
    public function deleted($id){
        $membre = Membre::findOrFail($id);
        $equipe_id = $membre->equipe_id;
        $equipe = Equipe::findOrFail($equipe_id);
        $equipe->effectif_min = $equipe->effectif_min -1;
        $equipe->save();
        Storage::disk('public')->delete($membre->cv_m);
        $membre->delete();
        return redirect()->back()->with('success', 'Membre supprimé avec succès!!!');
    }

    public function role(Request $request, $id){
        $membre = Membre::findOrFail($id);
        $request->validate([
            'role' => ['required', 'string', 'max:255'],
        ]);
        if($request->role == "Chef de projet"){
            $membre->is_superuser = true;
            $membre->is_staff = false;
            $membre->save();
        }elseif($request->role =="Adjoint du chef de projet"){
            $membre->is_staff = true;
            $membre->is_superuser = false;
            $membre->save();
        }elseif($request->role =="Participant"){
            $membre->is_staff = false;
            $membre->is_superuser = false;
            $membre->save();
        }
        return redirect()->back()->with('success', 'Role changé avec succès!!!');
    }

}
