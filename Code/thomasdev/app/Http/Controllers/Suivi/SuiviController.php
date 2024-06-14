<?php

namespace App\Http\Controllers\Suivi;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\Membre;
use App\Models\Projet;
use App\Models\Resultat;
use Carbon\Carbon;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuiviController extends Controller
{
    public function create(){
        $id = Auth::guard('membre')->user()->equipe_id;
        $resultats = Resultat::where('equipe_id',$id)->get();
        if($resultats->count() == 0){
            return view('suivi.resultatForm');
        }else{
            return view('suivi.resultatFormUpdate', compact('resultats'));
        }
    }
    public function store(Request $request){
        $id = Auth::guard('membre')->user()->equipe_id;
        $equipe = Equipe::find($id);
        if($equipe->statut_equipe == "Inactif" || $equipe->statut_equipe == "En pause"){
            return redirect()->back()->with("error","L'équipe est inactif ou en pause!!!");
        }else{
            $request->validate([
                'rapport' => ['max:50000'],
                'business' => ['max:50000'],
                'document'=> ['max:50000'],
            ]);
            /** @var UploadedFile|null $rapport */
            /** @var UploadedFile|null $business*/
            /** @var UploadedFile|null $document */
            $rapport = $request->rapport;
            $business = $request->business;
            $document = $request->document;
            $rapportPath = null;
            $businessPath = null;
            $documentPath = null;
            if($rapport!=null && !$rapport->getError()){
                $file = $request->file('rapport');
                $filename = $file->getClientOriginalName();
                $rapportPath = $file->storeAs('resultats/rapport', $filename,'public');
            }
            if($business!=null && !$business->getError()){
                $file = $request->file('business');
                $filename = $file->getClientOriginalName();
                $businessPath = $file->storeAs('resultats/business', $filename,'public');
            }
            if($document!=null && !$document->getError()){
                $file = $request->file('document');
                $filename = $file->getClientOriginalName();
                $documentPath = $file->storeAs('resultats/document', $filename,'public');
            }
            Resultat::create([
                'rapport' => $rapportPath,
                'business_model' => $businessPath,
                'autre_document' => $documentPath,
                'equipe_id'=>$id
            ]);
            return redirect()->route('verification1')->with('success','Solution envoyé avec succès!!!');
        }
    }
    public function resultat(){
        $resultats = Resultat::where("is_public",false)->paginate(2);
        $projets= Projet::where("en_recherche",true)->get();
        $equipes = Equipe::all();
        return view('suivi.resultatListe', compact('resultats','projets','equipes'));
    }

    public function updateSolution(Request $request, $id){
        $resultat = Resultat::findOrFail($id);
        $id1 = Auth::guard('membre')->user()->equipe_id;
        $equipe = Equipe::find($id1);
        $request->validate([
            'rapport' => ['nullable', 'max:50000'],
            'business' => ['nullable','max:50000'],
            'document'=> ['nullable','max:50000'],
        ]);
        if($equipe->statut_equipe == "Inactif" || $equipe->statut_equipe == "En pause"){
            return redirect()->back()->with("error","L'équipe est inactif ou en pause!!!");
        }else{
            if($resultat->is_valid){
                return redirect()->back()->with("error","Toutes les étapes ont été validés!!!");
            }else{
                if(!$resultat->is_rapport_valid){
                    if ($request->hasFile('rapport')) {
                        if($resultat->rapport == null){
                            $file = $request->file('rapport');
                            $filename = $file->getClientOriginalName();
                            $rapportPath = $file->storeAs('resultats/rapport', $filename,'public');
                            $resultat->rapport = $rapportPath;
                        }else{
                            Storage::disk('public')->delete($resultat->rapport);
                            $file = $request->file('rapport');
                            $filename = $file->getClientOriginalName();
                            $rapportPath = $file->storeAs('resultats/rapport', $filename,'public');
                            $resultat->rapport = $rapportPath;
                        }
                    }
                }
                if(!$resultat->is_business_valid){
                    if ($request->hasFile('business')) {
                        if($resultat->business_model == null){
                            $file = $request->file('business');
                            $filename = $file->getClientOriginalName();
                            $businessPath = $file->storeAs('resultats/business', $filename,'public');
                            $resultat->business_model = $businessPath;
                        }else{
                            Storage::disk('public')->delete($resultat->business_model);
                            $file = $request->file('business');
                            $filename = $file->getClientOriginalName();
                            $businessPath = $file->storeAs('resultats/business', $filename,'public');
                            $resultat->business_model = $businessPath;
                        }
                    }
                }
                if(!$resultat->is_document_valid){
                    if ($request->hasFile('document')) {
                        if($resultat->autre_document == null){
                            $file = $request->file('document');
                            $filename = $file->getClientOriginalName();
                            $documentPath = $file->storeAs('resultats/document', $filename,'public');
                            $resultat->autre_document = $documentPath;
                        }else{
                            Storage::disk('public')->delete($resultat->autre_document);
                            $file = $request->file('document');
                            $filename = $file->getClientOriginalName();
                            $documentPath = $file->storeAs('resultats/document', $filename,'public');
                            $resultat->autre_document = $documentPath;
                        }
                    }
                }
                $resultat->save();
                return redirect()->route('verification1')->with('success','Solution envoyé avec succès!!!');
            }
        }
    }

    public function desactiver($id){
        $membre = Membre::findorFail($id);
        $membre->statut_membre = 'Inactif';
        $membre->save();
        return redirect()->back()->with('success','Membre désactivé avec succès');
    }
    public function activer($id){
        $membre = Membre::findorFail($id);
        $membre->statut_membre = 'Actif';
        $membre->save();
        return redirect()->back()->with('success','Membre activé avec succès');
    }
    public function validation(){
        if(Auth::guard('membre')->check()){
            $resultats = Resultat::where("is_public",false)->paginate(2);
            $projets= Projet::where("en_recherche",true)->get();
            $equipes = Equipe::all();
            return view('suivi.validationSolution', compact('resultats','projets','equipes'));
        }else{
            return redirect()->route('home');
        }
    }
    public function validationStore(Request $request, $id){
        if(Auth::guard('membre')->check()){
            $resultat = Resultat::findOrFail($id);
            $resultat1 = Resultat::findOrFail($id);
            $request->validate([
                'name' => ['required', 'string','max:255'],
            ]);
            if($request->name == "Valider le rapport"){
                if($resultat->rapport != null){
                    if(!$resultat->is_rapport_valid){
                        $etat = $resultat1->etat;
                        $resultat->is_rapport_valid = true;
                        $resultat1->etat = $etat + 15;
                        $resultat->save();
                        $resultat1->save();
                        return redirect()->back()->with('success','Rapport validé avec succès');
                    }else{
                        return redirect()->back()->with('error','Rapport déjà validé');
                    }
                }else{
                    return redirect()->back()->with('error','Pas de rapport pour cette solution');
                }
            }else if($request->name == "Valider le business_model"){
                if($resultat->business_model != null){
                    if(!$resultat->is_business_valid){
                        $resultat->is_business_valid = true;
                        $etat = $resultat1->etat;
                        $resultat1->etat = $etat + 25;
                        $resultat->save();
                        $resultat1->save();
                        return redirect()->back()->with('success','Business_model validé avec succès');
                    }else{
                        return redirect()->back()->with('error','Business model déjà validé');
                    }
                }else{
                    return redirect()->back()->with('error','Pas de business model pour cette solution');
                }
            }else if($request->name == "Valider le document supplémentaire"){
                if($resultat->autre_document != null){
                    if(!$resultat->is_document_valid){
                        $resultat->is_document_valid = true;
                        $etat = $resultat1->etat;
                        $resultat1->etat = $etat + 10;
                        $resultat->save();
                        $resultat1->save();
                        return redirect()->back()->with('success','Document supplémentaire validé avec succès');
                    }else{
                        return redirect()->back()->with('error','Document supplémentaire déjà validé');
                    }
                }else{
                    return redirect()->back()->with('error','Pas de document supplémentaire pour cette solution');
                }
            }else if($request->name == "Valider le projet sur le terrain"){
                if($resultat->is_rapport_valid){
                    if($resultat->is_business_valid){
                        if(!$resultat->is_visite_terrain_valid){
                            $resultat->is_visite_terrain_valid = true;
                            $etat = $resultat1->etat;
                            $resultat1->etat = $etat + 25;
                            $resultat->save();
                            $resultat1->save();
                            return redirect()->back()->with('success','Projet validé avec succès après la visite sur le terrain');
                        }else{
                            return redirect()->back()->with('error','Projet déjà validé sur le terrain');
                        }
                    }else{
                        return redirect()->back()->with('error','Business_model non validé');
                    }
                }else{
                    return redirect()->back()->with('error','Rapport non validé');
                }
            }else if($request->name == "Valider complètement la solution"){
                if($resultat->is_rapport_valid){
                    if($resultat->is_business_valid){
                        if($resultat->is_visite_terrain_valid){
                            if(!$resultat->is_valid){
                                $resultat->is_valid = true;
                                $etat = $resultat1->etat;
                                $resultat1->etat = $etat + 25;
                                $resultat->save();
                                $resultat1->save();
                                return redirect()->back()->with('success','Toutes les étapes validées avec succès');
                            }else{
                                return redirect()->back()->with('error','Toutes les étapes sont déjà validées');
                            }
                        }else{
                            return redirect()->back()->with('error','Projet non validé sur le terrain');
                        }
                    }else{
                        return redirect()->back()->with('error','Business_model non validé');
                    }
                }else{
                    return redirect()->back()->with('error','Rapport non validé');
                }
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function publier($id)
    {
        $resultat = Resultat::findOrFail($id);
        if($resultat->is_valid){
            $resultat->is_public = true;
            $resultat->save();
            return redirect()->back()->with('success','Solution publiée avec succès!!!');
        }else{
            return redirect()->back()->with('error','Impossible de publier une solution non validée!!!');
        }
    }
    public function detailSolution($id){
        $resultat = Resultat::findOrFail($id);
        $dateAujourdhui = Carbon::now();
        $date = Carbon::parse($dateAujourdhui);
        $equipes1 = Equipe::where('type_equipe_id',2)->get();
        for($i = 0; $i < $equipes1->count(); $i++){
            if($equipes1[$i]->id == $resultat->equipe_id){
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
        }
        $projets = Projet::where('en_recherche',true)->get();
        $equipes = Equipe::where('type_equipe_id',2)->get();
        return view('suivi.detailSolution', compact('resultat','projets','equipes'));
    }
}
